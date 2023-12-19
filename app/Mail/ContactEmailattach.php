<?php

namespace App\Mail;
 
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactEmailattach extends Mailable
{
    use Queueable, SerializesModels;
	


    public $contact;

    /**
     * Create a new message instance.
     *
     */
	public function __construct($contact=[])
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
			return $this->from('info@bedigm.com', 'Contact from visit Armenia')
            ->subject('A new email from Visit Armenia')
            ->markdown('mails.demo')
            ->with([
                'name' => '',
				'name2' => '',
				'email' => '',
				'phone' => '',
				'message' => '',
                
            ])
			->attach($this->data['document']->getRealPath(),
                [
                    'as' => $this->data['document']->getClientOriginalName(),
                    'mime' => $this->data['document']->getClientMimeType(),
                ]);
			
			*/
			
	
			return $this
			->from('info@bedigm.com', 'Contact with atatch from visit Armenia')
			->markdown('mails.demo')
			 ->with([
                'name' => '',
				'name2' => '',
				'email' => '',
				'phone' => '',
				'message' => '',
                
            ])
			->subject('A new email from Visit Armenia Main')
			->attach($this->contact->path,
			[
				'as' => $this->contact->filename,
				'mime' => $this->contact->type,
			]);
                    
		
		
		
    }
}
