<?php

declare(strict_types=1);

namespace Apps\Backend\restaurant\Clients\Controllers;

use App\Http\Controllers\Controller;
use AppRestaurant\Restaurant\Clients\Application\ClientCreate;
use AppRestaurant\Restaurant\Clients\Application\ClientCreateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

final class ClientPostControllers extends Controller
{

    const MESSAJE_CREATE = "User created successfully";

    private $create;

    public function __construct(
        ClientCreate $create
    )
    {
        $this->create = $create;
    }

    public function __invoke(Request $request)
    {
        $this->validateRequest($request);
        try {
            ($this->create)(new ClientCreateRequest(
                $request->id,
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
            ], JsonResponse::HTTP_BAD_REQUEST);
        }

        return response()->json([
            'code' => JsonResponse::HTTP_CREATED,
            'message' => self::MESSAJE_CREATE,
        ], JsonResponse::HTTP_CREATED);
    }

    private function validateRequest(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:6'],
            'password_confirmation' => ['required', 'min:6']
        ]);
    }

}
