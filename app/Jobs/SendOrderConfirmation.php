<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\Mail;
use App\Mail\customer_order_confirmation;

class SendOrderConfirmation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order;
    protected $order_status;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($order, $order_status)
    {
        $this->order = $order;
        $this->order_status = $order_status;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
         
        $mail_to = $this->order->user_email;  

        if ($this->order_status) {
            // send 2 emails, for customer and store
            // Mail::to($mail_to)->send(new customer_order_confirmation($this->order));    // send  email to Store
            Mail::to($mail_to)->send(new customer_order_confirmation($this->order)); 
        } else {
            // send 1 emails, for customer only. let them know that payment is unsuccessful
            // Mail::to($mail_to)->send(new customer_order_confirmation($this->order));
        }
         
    }
}
