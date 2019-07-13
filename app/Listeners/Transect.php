<?php

namespace App\Listeners;

use App\Events\NewTransaction as NewTransactionEvent;
use App\Models\Promotion;
use App\Models\Purchase;
use App\Models\Refund;
use App\Models\Transaction;
use App\Models\Transfer;
use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class Transect
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
     * @param  Transect  $event
     * @return void
     */
    public function handle(NewTransactionEvent $event)
    {
        $model = $event->model;

        if ($model instanceof Promotion) {
            $transaction = new Transaction();
            $transaction->amount = 10;
            $transaction->transactionable_id = $model->id;
            $transaction->transactionable_type = Promotion::class;
            $transaction->user_id = $model->listing->seller_id;
            $transaction->save();
            User::find($transaction->user_id)->updateWallet($transaction->amount);
        }
        if ($model instanceof Transfer) {
            $transaction = new Transaction();
            $transaction->amount = $model->type == 'Deposit' ? $model->amount : (0-$model->amount);
            $transaction->transactionable_id = $model->id;
            $transaction->transactionable_type = Transfer::class;
            $transaction->user_id = $model->user_id;
            $transaction->save();
            User::find($transaction->user_id)->updateWallet($transaction->amount);
        }
        if ($model instanceof Refund) {
            $transaction = new Transaction();
            $transaction->amount = $model->amount;
            $transaction->transactionable_id = $model->id;
            $transaction->transactionable_type = Refund::class;
            $transaction->user_id = $model->to_user_id;
            $transaction->save();
            User::find($transaction->user_id)->updateWallet($transaction->amount);

            $transaction = new Transaction();
            $transaction->amount = 0-$model->amount;
            $transaction->transactionable_id = $model->id;
            $transaction->transactionable_type = Refund::class;
            $transaction->user_id = $model->from_user_id;
            $transaction->save();
            User::find($transaction->user_id)->updateWallet($transaction->amount);
        }
        if ($model instanceof Purchase) {
            if (Transaction::where('transactionable_type', Purchase::class)->where('transactionable_id', $model->id)->exists()) {
                $transaction = new Transaction();
                $transaction->amount = $model->amount;
                $transaction->transactionable_id = $model->id;
                $transaction->transactionable_type = Purchase::class;
                $transaction->user_id = $model->seller_id;
                $transaction->save();
                User::find($transaction->user_id)->updateWallet($transaction->amount);
            } else {
                $transaction = new Transaction();
                $transaction->amount = 0-$model->amount;
                $transaction->transactionable_id = $model->id;
                $transaction->transactionable_type = Purchase::class;
                $transaction->user_id = $model->buyer_id;
                $transaction->save();
                User::find($transaction->user_id)->updateWallet($transaction->amount);
            }
        }
    }
}
