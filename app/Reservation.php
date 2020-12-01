<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Reservation extends Model
{
    public $timestamps = false;
    /**
     * @var string
     */

    protected $table = 'reservation';

    public function reservation($movieId, $uniqReservation)
    {
        Reservation::insert([
            'number' => $uniqReservation,
            'film_id' => $movieId
        ]);
    }

    public function deleteReservation($uniqReservation)
    {
        Reservation::where(['number' => $uniqReservation])
            ->delete();
    }

    /**
     * @param $movieId
     * @return \Illuminate\Support\Collection
     */
    public function getMoviePlaces($movieId)
    {
        return ReservationPlaces::where('film_id', $movieId)
            ->get(['place_id', 'is_reserved']);
    }
}
