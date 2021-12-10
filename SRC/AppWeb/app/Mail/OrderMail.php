<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Customer;
use App\Order;
use Barryvdh\DomPDF\Facade as PDF;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $customer;
    protected $order;
    protected $carts;
    protected $pdf;


    public function __construct(Customer $customer, Order $order, $carts)
    {
        $this->customer = $customer;
        $this->order = $order;
        $this->carts = $carts;
        $this->pdf = PDF::loadView('email.pdf', compact('customer','order','carts'))->output();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('view.name');

        //MENGESET SUBJECT EMAIL, VIEW MANA YANG AKAN DI-LOAD DAN DATA APA YANG AKAN DIPASSING KE VIEW
        return $this->subject('Your order has been confirmed #'.$this->order->invoice)
            ->attachData($this->pdf, 'order_information.pdf', [
                'mime' => 'application/pdf',
            ])
            ->view('email.order')
            ->with([
                'customer' => $this->customer,
                'order' => $this->order,
                'carts' => $this->carts,
            ]);
    }
}
