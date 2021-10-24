<?php

declare(strict_types=1);

namespace Apps\Backend\restaurant\Tables\Controllers;

use App\Http\Controllers\Controller;
use AppRestaurant\Restaurant\Tables\Application\Searcher\TablesSearcher;
use AppRestaurant\Restaurant\Tables\Application\Searcher\TablesSearcherRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class TablesGetController extends Controller
{
    private $searcher;

    public function __construct(
        TablesSearcher $searcher
    )
    {
        $this->searcher = $searcher;
    }

    public function __invoke(Request $request)
    {
        try {
            $response = ($this->searcher)(new TablesSearcherRequest(
                $request->all()
            ));
        } catch (\Exception $exception) {
            return response()->json([
                'code' => $exception->getCode(),
                'message' => $exception->getMessage(),
                'line' => $exception->getLine(),
                'trace' => $exception->getTrace(),
                'rows' => []
            ],  $exception->getCode());
        }

        return response()->json([
            'code' => JsonResponse::HTTP_OK,
            'rows' => $response->toResponse(),
        ], JsonResponse::HTTP_OK);
    }
}
