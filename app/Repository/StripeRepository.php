<?php
namespace App\Repository;

use App\Movie;
use App\Repository\Interfaces\StripeRepositoryInterface;

class StripeRepository implements StripeRepositoryInterface
{
    public function reservationMovie($places, $reservationId, $movieId)
    {
       return (new Movie())->reservationMovie($places, $reservationId, $movieId);
    }
}