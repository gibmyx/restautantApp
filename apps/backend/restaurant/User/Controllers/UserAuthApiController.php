<?php

declare(strict_types=1);

namespace Apps\Backend\restaurant\User\Controllers;

use AppRestaurant\Restaurant\User\Application\Auth\UserAuthRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use AppRestaurant\Restaurant\User\Application\Auth\UserAuthApi;

final class UserAuthApiController extends Controller
{
    private $authApi;

    public function __construct(
        UserAuthApi $authApi
    )
    {
        $this->authApi = $authApi;
    }

    public function __invoke(Request $request)
    {
        try {
            $response = ($this->authApi)(new UserAuthRequest(
                (string)$request->email,
                (string)$request->password,
                (string)$request->token
            ));
        } catch (\Exception $exception) {
            return response()->json([
                'code' => $exception->getCode(),
                'message' => $exception->getMessage(),
                'line' => $exception->getLine(),
                'trace' => $exception->getTrace(),
                'auth' => [
                    'message' => 'Unauthorized'
                ]
            ], $exception->getCode());
        }

        return response()->json([
            'code' => JsonResponse::HTTP_OK,
            'message' => 'authenticating',
            'auth' => [
                'token' => $request->user()->createToken($request->token)->plainTextToken,
                'status' => 'authenticating'
            ],
            'user' => $response['user'],
        ], JsonResponse::HTTP_OK);
    }
}
