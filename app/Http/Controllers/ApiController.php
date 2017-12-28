<?php

	namespace App\Http\Controllers;

	use Illuminate\Http\Request;
	use App\Http\Requests\{SendRequest, LoginRequest};
	use App\Jobs\SendEmail;
	use App\Mail\BasicEmail;

	class ApiController extends Controller
	{
		public function login( LoginRequest $form ) { 
			$credentials = $form->only('email', 'password');
			$token = \JWTAuth::attempt($credentials);

	        if ($token) {
	            return response()->json(['token' => $token]);
	        } else {
	            return response()->json(['code' => 2, 'message' => 'Invalid credentials.'], 401);
	        }
		}

		/**
		 * Send basic email
		 * @param  SendRequest $form Form data
		 * @return 
		 */
	    public function send( SendRequest $form ) { 
	    	
	    	$email = new BasicEmail( $form->all() );
	    	SendEmail::dispatch( $email ); 
	    	
	    	return response()->json(['success'=>true], 200);	    		    	
	    }
	}