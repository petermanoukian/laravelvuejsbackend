<?php

namespace App\Mail;
 
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactEmail extends Mailable
{
    use Queueable, SerializesModels;
	


    public $contact;

    /**
     * Create a new message instance.
     *
     */
    public function __construct( $contact )
    {
        $this->contact = $contact;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
		/*
		return $this->from('info@bedigm.com')
                    ->view('mails.demo')
                    ->text('mails.demo_plain')
                    ->with(
                      [
                            'testVarOne' => '1',
                            'testVarTwo' => '2',
                      ])
                      ;
					  
			*/		  
			return $this->from('info@bedigm.com', 'Contact from visit Armenia')
            ->subject('A new email from Visit Armenia')
            ->markdown('mails.demo')
            ->with([
                'name' => '',
				'name2' => '',
				'email' => '',
				'phone' => '',
				'message' => '',
                
            ]);
                    
		
		
		
    }
}
