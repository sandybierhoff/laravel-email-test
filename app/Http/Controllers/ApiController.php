<?php

	namespace App\Http\Controllers;

	use Illuminate\Http\Request;
	use App\Http\Requests\{SendRequest};
	use App\Jobs\SendEmail;
	use App\Mail\BasicEmail;

	class ApiController extends Controller
	{
		public function login( Request $form ) { 
			$this->validateLogin($form);
				
			$credentials = $form->json()->all();
			
			$token = \JWTAuth::attempt($credentials);

	        if ($token) {
				return response()->json( \JWTAuth::user()->toArray() + ['token'=>$token] );				
	        } else {
	            return response()->json(['code' => 2, 'message' => 'Invalid credentials.'], 401);
	        } 
		}

		/**
		 * Validate the user login request.
		 *
		 * @param  \Illuminate\Http\Request  $request
		 * @return void
		 */
		protected function validateLogin(Request $request)
		{
			\Validator::make($request->json()->all(), [
				'email'=> 'required|email|string',
				'password' => 'required|string',
			])->validate();
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