<?php

declare(strict_types=1);

namespace Apps\Backend\restaurant\Reservations\Controllers;

use App\Http\Controllers\Controller;
use AppRestaurant\Restaurant\Reservations\Application\Updater\ReservationUpdater;
use AppRestaurant\Restaurant\Reservations\Application\Updater\ReservationUpdaterRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class ReservationPutController extends Controller
{
    const MESSAJE_UPDATE = "Reservation update successfully";

    private $updater;

    public function __construct(
        ReservationUpdater $updater
    )
    {
        $this->updater = $updater;
    }

    public function __invoke(Request $request)
    {
        try {
            ($this->updater)(new ReservationUpdaterRequest(
                (string)$request->id,
                (string)$request->tableId,
                (int)$request->userId,
                (int)$request->people,
                (string)$request->date,
            ));
        } catch (\Exception $exception) {
            return response()->json([
                'code' => $exception->getCode(),
                'message' => $exception->getMessage(),
                'line' => $exception->getLine(),
                'trace' => $exception->getTrace(),
            ], $exception->getCode());
        }

        return response()->json([
            'code' => JsonResponse::HTTP_OK,
            'message' => self::MESSAJE_UPDATE
        ], JsonResponse::HTTP_OK);
    }
}
