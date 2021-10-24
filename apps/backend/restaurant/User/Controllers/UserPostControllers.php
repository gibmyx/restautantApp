<?php

declare(strict_types=1);

namespace Apps\Backend\restaurant\User\Controllers;

use App\Http\Controllers\Controller;
use AppRestaurant\Restaurant\User\Application\Create\UserCreate;
use AppRestaurant\Restaurant\User\Application\Create\UserCreateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

final class UserPostControllers extends Controller
{
    const MESSAJE_CREATE = "User created successfully";

    private $create;

    public function __construct(
        UserCreate $create
    )
    {
        $this->create = $create;
    }

    public function __invoke(Request $request)
    {
        try {
            ($this->create)(new UserCreateRequest(
                $request->name,
                $request->email,
                Hash::make($request->password),
                Hash::make($request->password_confirmation),
                $request->origin
            ));
        } catch (\Exception $exception) {
            return response()->json([
                'code' => $exception->getCode(),
                'message' => $exception->getMessage(),
                'line' => $exception->getLine(),
                'trace' => $exception->getTrace(),
            ], JsonResponse::HTTP_BAD_REQUEST);
        }

        return response()->json([
            'code' => JsonResponse::HTTP_CREATED,
            'message' => self::MESSAJE_CREATE,
        ], JsonResponse::HTTP_CREATED);
    }

}
