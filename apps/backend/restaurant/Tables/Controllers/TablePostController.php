<?php

declare(strict_types=1);

namespace Apps\Backend\restaurant\Tables\Controllers;

use App\Http\Controllers\Controller;
use AppRestaurant\Restaurant\Tables\Application\Create\TableCreate;
use AppRestaurant\Restaurant\Tables\Application\Create\TableCreateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

final class TablePostController extends Controller
{
    const MESSAJE_CREATE = "Table created successfully";

    private $create;

    public function __construct(
        TableCreate $create
    )
    {
        $this->create = $create;
    }

    public function __invoke(string $id, Request $request)
    {

        try {
            ($this->create)(new TableCreateRequest(
                $id,
                (string)$request->state,
                (int)$request->maxPeople,
                (int)$request->minPeople,
                (string)$request->description
            ));
        } catch (\Exception $exception) {
            return response()->json([
                'code' => $exception->getcode(),
                'message' => $exception->getMessage(),
            ],  $exception->getcode());
        }

        return response()->json([
            'code' => JsonResponse::HTTP_CREATED,
            'message' => self::MESSAJE_CREATE,
        ], JsonResponse::HTTP_CREATED);
    }
}
