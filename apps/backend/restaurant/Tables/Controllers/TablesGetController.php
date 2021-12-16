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
                'code' => $exception->getcode(),
                'message' => $exception->getMessage(),
                'rows' => []
            ],  $exception->getcode());
        }

        return response()->json([
            'code' => JsonResponse::HTTP_OK,
            'rows' => $response->toResponse(),
            'pagination' => $response->pagination(),
        ], JsonResponse::HTTP_OK);
    }
}
