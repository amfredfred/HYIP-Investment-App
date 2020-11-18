<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Kevupton\LaravelCoinpayments\Events\Deposit\DepositComplete;
class CompleteWithdraw
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
   public function handle(DepositComplete $depositComplete)
    {
        dd($depositComplete->deposit->toArray());
    }
}
