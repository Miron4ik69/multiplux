<?php

namespace App\Http\Controllers;

use App\Movie;
use App\Places;
use Illuminate\Http\Request;
use App\Repository\Interfaces\ControlRepositoryInterface;

class HomeController extends Controller
{

    private $controlRepository;

    /**
     * HomeController constructor.
     * @param ControlRepositoryInterface $controlRepository
     */
    public function __construct(ControlRepositoryInterface $controlRepository)
    {
        $this->controlRepository = $controlRepository;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addMovie()
    {
        return view('admin.addMovie');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cashbox()
    {
        $movies = $this->controlRepository->getAllMovie();

        return view('admin.cashbox', ["movies" => $movies]);
    }

    public function cashboxReservation(Request $request, $id, $uniqReservation)
    {
        $this->controlRepository->reservation($id, $uniqReservation);

        $movie = $this->controlRepository->getMovie($id);
        $getMoviePlaces = $this->controlRepository->getMoviePlaces($id);
        $getPlaces = $this->controlRepository->getPlacesById($id, $getMoviePlaces);

        $places = [];

        foreach ($getPlaces as $key => $getPlace) {
            $places[$getPlace["row"]][] = [
                "row" => $getPlace["row"],
                "place" => $getPlace["place"],
                "isReserved" => $getPlace["is_reserved"],
                "price" => $getPlace["price"],
            ];
        }

        return view('admin.buy', [
            'movie' => $movie,
            'places' => $places,
            'reservationId' => $uniqReservation,
            'movieId' => $id
        ]);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(Request $request)
    {
        $imgname = $request->file('image')->getClientOriginalName();
        $imgpath = $request->file('image')->storeAs('public', $imgname);

        $movie = $this->controlRepository->insertMovie($imgname, $request);
        $movieId = $movie;

        $places = (new Places())->getPlacesId();

        (new Movie())->addPlacesToMovie($movieId, $places);

        return redirect()->back();
    }
}
