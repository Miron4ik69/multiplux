<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Places extends Model
{
    public $timestamps = false;
    protected $table = 'places';

    public function getPlacesId()
    {
        return Places::select('id')
            ->get();
    }

    public function getPlacesById($movieId, $placesId)
    {
        $place = [];
        foreach ($placesId as $placeId) {
           $place[] = $placeId->place_id;
        }

         return Places::join('reservation_places', 'reservation_places.place_id', '=', 'places.id')
            ->join('films', 'films.id', '=', 'reservation_places.film_id')
            ->whereIn('places.id', $place)
            ->where('reservation_places.film_id', intval($movieId))
            ->select('places.row', 'places.place', 'reservation_places.is_reserved', 'films.price')
            ->get()
            ->toArray();
    }

    public function getPlaces($places)
    {
        $placesId = [];

        foreach ($places as $key => $p) {
            $placesId[] = Places::select('id')->where([
               'row' => (int)$p['row'],
               'place' => (int)$p['place']
            ])->get();
        }

        return $placesId;
    }
}
