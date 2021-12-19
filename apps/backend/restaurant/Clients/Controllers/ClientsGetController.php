<?php

declare(strict_types=1);

namespace Apps\Backend\restaurant\Clients\Controllers;

use App\Http\Controllers\Controller;
use AppRestaurant\Restaurant\Clients\Application\Searcher\ClientsSearcher;
use AppRestaurant\Restaurant\Clients\Application\Searcher\ClientsSearcherRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class ClientsGetController extends Controller
{
    public function __construct(
        private ClientsSearcher $searcher
    )
    {
    }

    public function __invoke(Request $request)
    {

        try {
            $response = ($this->searcher)(new ClientsSearcherRequest(
                $request->all()
            ));
        } catch (\Exception $exception) {
            return response()->json([
                'code' => $exception->getCode(),
                'message' => $exception->getMessage(),
                'line' => $exception->getLine(),
                'trace' => $exception->getTrace(),
                'rows' => []
            ], $exception->getCode());
        }

        return response()->json([
            'code' => JsonResponse::HTTP_OK,
            'rows' => $response->toResponse(),
            'pagination' => $response->pagination(),
        ], JsonResponse::HTTP_OK);
    }

}
