@extends('layouts.public')

@section('content')
    <form method="POST" action="/password/reset">
        {!! csrf_field() !!}
        <input type="hidden" name="token" value="{{ $token }}">
            <div class="col-lg-10 col-lg-offset-1">
                <h2>Neues Passwort vergeben</h2>
            </div>
            <div class="row">
            <div class="col-lg-10 col-lg-offset-1 well">
               <div class="form-group">
                   <label for="">Email:</label>
                   <input type="email" class="form-control" name="email" value="{{ old('email') }}">
               </div>

               <div class="form-group">
                   <label for="">Passwort:</label>
                   <input type="password" class="form-control" name="password">
               </div>

               <div class="form-group">
                   <label for="">Bestätigen Passwort:</label>
                   <input type="password" class="form-control" name="password_confirmation">
               </div>

               <div class="form-group">
                   <button type="submit" class="btn btn-lg btn-primary">
                       Neues Passwort vergeben
                   </button>
               </div>
            </div>
        </div>
    </form>
@stop