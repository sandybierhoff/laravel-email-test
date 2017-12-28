<?php

    namespace App\Jobs;

    use Illuminate\Bus\Queueable;
    use Illuminate\Queue\SerializesModels;
    use Illuminate\Queue\InteractsWithQueue;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Foundation\Bus\Dispatchable;
    use Illuminate\Mail\Mailable;

    use Illuminate\Contracts\Mail\Mailer;

    class SendEmail implements ShouldQueue
    {
        use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

        /**
         * Mailable object
         * @var Illuminate\Mail\Mailable
         */
        protected $_email;

        /**
         * Create a new job instance.
         *
         * @return void
         */
        public function __construct( Mailable $email )
        {                 
            $this->_email = $email;
        }

        /**
         * Execute the job.
         * 
         * @param  Mailer $mailer Mailer instance.
         * @return void
         */
        public function handle( Mailer $mailer )
        {
            $mailer->send( $this->_email );        
        }

        /**
         * The job failed to process.
         *
         * @param  Exception  $exception
         * @return void
         */
        public function failed( Exception $exception )
        {
            // send email to the authenticated user.... (!)
        }
    }