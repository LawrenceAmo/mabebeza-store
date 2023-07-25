<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class store_order_confirmation extends Mailable
{
    use Queueable, SerializesModels;

    protected $order;
    protected $store;

    /**
     * Create a new message instance.
     * 
     * @return void
     */
    public function __construct( $order, $store)
    {
        $this->order = $order;
        $this->store = $store;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@mabebeza.com')
                ->subject('New Online Order Alert')
                ->view('emails.customer_order_confirmation')
                ->with([
                    'order' => $this->order,
                    'store' => $this->store,
                ]);
    }
}
