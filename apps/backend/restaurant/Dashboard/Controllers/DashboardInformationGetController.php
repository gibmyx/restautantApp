<?php

declare(strict_types=1);

namespace Apps\Backend\restaurant\Dashboard\Controllers;

use App\Http\Controllers\Controller;
use AppRestaurant\Restaurant\Dashboard\Application\Searcher\InformationHeaderSearcher;
use AppRestaurant\Restaurant\Dashboard\Application\Searcher\InformationHeaderSearcherRequest;
use DateInterval;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class DashboardInformationGetController extends Controller
{
    private InformationHeaderSearcher $searcher;

    public function __construct(
        InformationHeaderSearcher $searcher
    )
    {
        $this->searcher = $searcher;
    }

    public function __invoke(Request $request)
    {
        try {
            $response = ($this->searcher)(new InformationHeaderSearcherRequest(
                (new \DateTime())->sub(new DateInterval('P1M'))->format("Y-m-01 00:00:00"),
                (new \DateTime())->sub(new DateInterval('P1M'))->format("Y-m-t 23:59:59"),
                (new \DateTime())->format("Y-m-01 00:00:00"),
                (new \DateTime())->format("Y-m-t 23:59:59"),
            ));
        } catch (\Exception $exception) {
            return response()->json([
                'code' => $exception->getCode(),
                'message' => $exception->getMessage(),
            ], $exception->getCode());
        }

        return response()->json([
            'code' => JsonResponse::HTTP_OK,
            'data' => [
                'newUser' => $response->newUser(),
                'reservation' => $response->reservation(),
                'reservationsCompleted' => $response->reservationsCompleted(),
                'reservationsCanceled' => $response->reservationsCanceled(),
            ]
        ], JsonResponse::HTTP_OK);
    }

}
