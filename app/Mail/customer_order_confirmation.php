<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue; 
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class customer_order_confirmation extends Mailable
{
    use Queueable, SerializesModels;

    // protected $user;
    protected $order;
    // protected $shipping;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $order)
    {
        $this->order = $order;
     }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this  //->from('info@effectivewing.com')
                ->subject('Thank you for choosing Mabebeza Baby Store')
                ->view('emails.customer_order_confirmation')
                ->with([
                    'order' => $this->order,
                    // other variables you want to pass to the email view
                ]);
    }
}
