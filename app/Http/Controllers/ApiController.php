<?php

	namespace App\Http\Controllers;

	use Illuminate\Http\Request;
	use App\Http\Requests\SendRequest;
	use App\Jobs\SendEmail;
	use App\Mail\BasicEmail;

	class ApiController extends Controller
	{
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