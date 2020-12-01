<?php

namespace App\Repository\Interfaces;

interface StripeRepositoryInterface
{
    public function reservationMovie($places, $reservationId, $movieId);
}