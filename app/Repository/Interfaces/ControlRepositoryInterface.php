<?php

namespace App\Repository\Interfaces;

interface ControlRepositoryInterface
{
    public function getAllMovie();
    public function getMovie($id);
    public function getMovieVideo($movieId);
    public function reservation($movieId, $uniqReservation);
    public function getMoviePlaces($movieId);
    public function getPlacesById($movieId, $getMoviePlaces);
    public function deleteReservation($delete);
    public function insertMovie($imgname, $request);
}