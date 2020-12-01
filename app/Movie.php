<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    public $timestamps = false;
    protected $table = 'films';

    public function getAll()
    {
       return Movie::select('id', 'image', 'title', 'video')
           ->get();
    }

    public function getMovie($id)
    {
        return Movie::select()
            ->where('id', $id)
            ->get();
    }

    public function getMovieVideo($id)
    {
        return Movie::select('video')
            ->where('id', $id)
            ->get();
    }

    public function insertMovie($imgname, $request)
    {
       $test = Movie::insertGetId([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'video' => $request->input('video'),
            'image' => $imgname,
            'age' => $request->input('age'),
            'duration' => $request->input('duration'),
            'director' => $request->input('director'),
            'rating' => $request->input('rating'),
            'country' => $request->input('country'),
            'studio' => $request->input('studio'),
            'language' => $request->input('language'),
            'start_hire' => $request->input('start_hire'),
            'end_hire' => $request->input('end_hire'),
            'price' => $request->input('price'),
        ]);

       return $test;
    }

    public function addPlacesToMovie($movieId, $placesId)
    {
        foreach ($placesId as $placeId) {
            ReservationPlaces::insert([
               'film_id' => $movieId,
                'place_id' => $placeId->id
            ]);
        }
    }

    public function reservationMovie($places, $reservationNumber, $movieId)
    {
        $placeId = [];
        $data = [];
        $placesId = (new Places())->getPlaces($places);

        foreach ($placesId as $key => $place) {
            $placeId[$key] = $place[0]['id'];

            $data[$key]['place_id'] = $place[0]['id'];

            $data[$key]['number'] = $reservationNumber;
            $data[$key]['film_id'] = $movieId;

        }

        ReservationPlaces::where('film_id', $movieId)
            ->whereIn('place_id', $placeId)
            ->update(['is_reserved' => 1]);

        Reservation::insert($data);
    }

}
