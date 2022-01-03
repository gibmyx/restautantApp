<?php

declare(strict_types=1);

namespace Apps\Backend\restaurant\Reservations\Controllers;

use App\Http\Controllers\Controller;
use AppRestaurant\Restaurant\Reservations\Application\Searcher\ReservationsLastUserSearcher;
use AppRestaurant\Restaurant\Reservations\Application\Searcher\ReservationsLastUserSearcherRequest;
use Illuminate\Http\JsonResponse;
use function response;

final class ReservationLastUserGetController extends Controller
{

    public function __construct(
        private ReservationsLastUserSearcher $searcher
    )
    {
    }

    public function __invoke(int $userId)
    {

        try {
            $response = ($this->searcher)(new ReservationsLastUserSearcherRequest(
                $userId
            ));
        } catch (\Exception $exception) {
            return response()->json([
                'code' => $exception->getCode(),
                'message' => $exception->getMessage(),
                'rows' => []
            ],  $exception->getCode());
        }

        return response()->json([
            'code' => JsonResponse::HTTP_OK,
            'reservationsTotal' => $response["reservationsTotal"],
            'reservationsCompleted' => $response["reservationsCompleted"],
            'reservationsCanceled' => $response["reservationsCanceled"],
        ], JsonResponse::HTTP_OK);
    }

}
