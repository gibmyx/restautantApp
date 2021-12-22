<?php

declare(strict_types=1);

namespace Apps\Backend\restaurant\Reservations\Controllers;

use App\Http\Controllers\Controller;
use AppRestaurant\Restaurant\Reservations\Application\Searcher\ReservationHistorySearcher;
use Illuminate\Http\JsonResponse;

final class ReservationsHistoryGetController extends Controller
{
    public function __construct(
        private ReservationHistorySearcher $searcher
    )
    {
    }

    public function __invoke()
    {
        try {
            $response = ($this->searcher)();
        } catch (\Exception $exception) {
            return response()->json([
                'code' => $exception->getCode(),
                'message' => $exception->getMessage(),
                'rows' => []
            ],  $exception->getCode());
        }

        return response()->json([
            'code' => JsonResponse::HTTP_OK,
            'historyCount' => $response->historyCount(),
            'historyMonths' => $response->historyMonths(),
        ], JsonResponse::HTTP_OK);    }
}
