<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;
use Stripe;
use App\Repository\Interfaces\StripeRepositoryInterface;

class StripeController extends Controller
{

    private $stripeRepository;

    public function __construct(StripeRepositoryInterface $stripeRepository)
    {
        $this->stripeRepository = $stripeRepository;
    }

    /**
     * @param Request $request
     * @return string
     * @throws Stripe\Exception\ApiErrorException
     */
    public function userPayment(Request $request)
    {

        $currentPrice = $request->pay / 28 * 100;

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $stripe =  Stripe\Charge::create ([
            "amount" => preg_replace('/\..+$/','',$currentPrice),
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Оплата фильма"
        ]);

        if ($stripe->status = "succeeded") {

            $this->stripeRepository->reservationMovie($request->places, $request->reservationId, $request->movieId);

            $details = [
              'number' => $request->reservationId,
              'places' => $request->places
            ];

            \Mail::to($request->email)->send(new \App\Mail\ConfirmMail($details));

            return route('reservationSuccess', [
                "payment" => $request->reservationId
            ]);
        }
    }

    public function adminPayment(Request $request)
    {
        $this->stripeRepository->reservationMovie($request->places, $request->reservationId, $request->movieId);

        Payment::insert([
           'number' => $request->reservationId,
           'price' =>  $request->pay
        ]);

        return route('reservationSuccess', [
            "payment" => $request->reservationId
        ]);
    }
}
