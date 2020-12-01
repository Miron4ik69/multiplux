<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Repository\Interfaces\ControlRepositoryInterface;

class ControlController extends Controller
{
    private $controlRepository;

    /**
     * ControlController constructor.
     * @param ControlRepositoryInterface $controlRepository
     */
    public function __construct(ControlRepositoryInterface $controlRepository)
    {
        $this->controlRepository = $controlRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function welcomePage()
    {
        $movies = $this->controlRepository->getAllMovie();

        return view('welcome', ['movies' => $movies]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMovie(Request $request)
    {
        $movie = $this->controlRepository->getMovie($request->movieId);
        return response()->json($movie);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMovieVideo(Request $request)
    {
        $movie = $this->controlRepository->getMovieVideo($request->movieId);
        return response()->json($movie);
    }

    /**
     * @param Request $request
     * @param $movieId
     * @param $uniqReservation
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function reservation(Request $request, $movieId, $uniqReservation)
    {

        $this->controlRepository->reservation($movieId, $uniqReservation);
        $movie = $this->controlRepository->getMovie($movieId);
        $getMoviePlaces = $this->controlRepository->getMoviePlaces($movieId);
        $getPlaces = $this->controlRepository->getPlacesById($movieId, $getMoviePlaces);

        $places = [];

        foreach ($getPlaces as $key => $getPlace) {
            $places[$getPlace["row"]][] = [
                "row" => $getPlace["row"],
                "place" => $getPlace["place"],
                "isReserved" => $getPlace["is_reserved"],
                "price" => $getPlace["price"],
            ];
        }

        return view('buy', [
            'movie' => $movie,
            'places' => $places,
            'reservationId' => $uniqReservation,
            'movieId' => $movieId
        ]);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reservationCancel(Request $request)
    {
        $this->controlRepository->deleteReservation($request->delete);
        return redirect()->route('reservationCancelView');
    }
}
