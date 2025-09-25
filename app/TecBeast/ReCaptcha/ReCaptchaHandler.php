<?php

namespace App\TecBeast\ReCaptcha;

use Config;

class ReCaptchaHandler {

	/**
	 * Private Key for the application, has to retrieved from reCaptcha site
	 */
	protected $privateKey;

	/**
	 * Public Key for the application, has to retrieved from reCaptcha site
	 */
	protected $publicKey;

	/**
	 * reCaptcha API URL
	 */
	protected $apiUrl = 'https://www.google.com/recaptcha/api/siteverify';

	public function __construct()
	{
		$this->privateKey = Config::get('services.recaptcha.private');
		$this->publicKey = Config::get('services.recaptcha.public');
	}

	/**
	 * Verifys a Google Recaptcha Request
	 * @return boolean
	 */
	public function verify($token)
	{
		$data = ['secret' => $this->privateKey,'response' => $token];

		$ch = curl_init($this->apiUrl);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = json_decode(curl_exec($ch));
		curl_close($ch);

		return $response->success;
	}
}