<?php

declare(strict_types=1);

namespace Apps\Backend\restaurant\Tables\Controllers;

use App\Http\Controllers\Controller;
use AppRestaurant\Restaurant\Tables\Application\Update\TableUpdate;
use AppRestaurant\Restaurant\Tables\Application\Update\TableUpdateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class TablesPutController extends Controller
{
    const MESSAJE_UPDATE = "Table update successfully";
    private $update;

    public function __construct(
        TableUpdate $update
    )
    {
        $this->update = $update;
    }

    public function __invoke(Request $request)
    {
        try {
            ($this->update)(new TableUpdateRequest(
                (string)$request->id,
                (int)$request->number,
                (int)$request->maxPeople,
                (int)$request->minPeople,
                (string)$request->description
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
            'code' => JsonResponse::HTTP_OK,
            'message' => self::MESSAJE_UPDATE
        ], JsonResponse::HTTP_OK);
    }

}
