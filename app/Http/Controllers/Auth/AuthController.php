<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\SendActivationEmail;
use App\Models\User;
use App\TecBeast\ReCaptcha\ReCaptchaHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    protected $redirectTo = '/account/details';

    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'validateEmail']);
    }

    /**
     * Show login form
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle login
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended($this->redirectTo);
        }

        return back()->withErrors([
            'email' => 'Ungültige Zugangsdaten.',
        ])->withInput($request->only('email'));
    }

    /**
     * Show registration form
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle registration
     */
    public function register(Request $request, ReCaptchaHandler $recaptcha)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
        // dd($validator);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'aktivkey' => Str::random(32),
        ]);

        // dd($user);

        Auth::login($user);

        // Send activation email
        SendActivationEmail::dispatch($user);

        return redirect($this->redirectTo)
            ->with('infoMsg', 'Sie haben eine E-Mail zur Bestätigung Ihrer Adresse erhalten.');
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    /**
     * Validate email confirmation
     */
    public function validateEmail($key)
    {
        $user = User::where('aktivkey', $key)->first();

        if (! $user) {
            return redirect()->route('home')->with('infoMsg', 'Bestätigung nicht erfolgreich');
        }

        if ($user->aktiv) {
            return redirect()->route('home')->with('infoMsg', 'Diese E-Mail-Adresse wurde bereits aktiviert');
        }

        $user->aktiv = true;
        $user->save();

        return redirect()->route('home')->with('infoMsg', 'Ihre E-Mail-Adresse wurde erfolgreich bestätigt');
    }
}
