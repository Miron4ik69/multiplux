<?php

namespace App\Repository;

use App\Places;
use App\Repository\Interfaces\ControlRepositoryInterface;
use App\Movie;
use App\Reservation;

class ControlRepository implements ControlRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getAllMovie()
    {
        return (new Movie())->getAll();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getMovie($id)
    {
       return (new Movie())->getMovie($id);
    }

    public function getMovieVideo($movieId)
    {
       return (new Movie())->getMovieVideo($movieId);
    }

    /**
     * @param $movieId
     * @param $uniqReservation
     */
    public function reservation($movieId, $uniqReservation)
    {
        (new Reservation())->reservation($movieId, $uniqReservation);
    }

    /**
     * @param $movieId
     * @return \Illuminate\Support\Collection
     */
    public function getMoviePlaces($movieId)
    {
       return (new Reservation())->getMoviePlaces($movieId);
    }

    /**
     * @param $movieId
     * @param $getMoviePlaces
     * @return mixed
     */
    public function getPlacesById($movieId, $getMoviePlaces)
    {
        return (new Places())->getPlacesById($movieId, $getMoviePlaces);
    }

    public function deleteReservation($delete)
    {
        unset($_COOKIE[$delete]);
        return (new Reservation())->deleteReservation($delete);
    }

    public function insertMovie($imgname, $request)
    {
       return (new Movie())->insertMovie($imgname, $request);
    }
}