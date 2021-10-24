<?php

declare(strict_types=1);

namespace Apps\Backend\restaurant\Reservations\Controllers;

use App\Http\Controllers\Controller;
use AppRestaurant\Restaurant\Reservations\Application\Create\ReservationCreate;
use AppRestaurant\Restaurant\Reservations\Application\Create\ReservationCreateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class ReservationPostController extends Controller
{
    const MESSAJE_CREATE = "Reservation created successfully";

    private $create;

    public function __construct(
        ReservationCreate $create
    )
    {
        $this->create = $create;
    }

    public function __invoke(string $id, Request $request)
    {
        try {
            ($this->create)(new ReservationCreateRequest(
                $id,
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
            ],  $exception->getCode());
        }

        return response()->json([
            'code' => JsonResponse::HTTP_CREATED,
            'message' => self::MESSAJE_CREATE,
        ], JsonResponse::HTTP_CREATED);
    }
}
