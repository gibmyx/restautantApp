<?php

declare(strict_types=1);

namespace Tests\Feature\src\Restaurant\User;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Tests\TestCase;

final class UserAuthApiControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function this_should_authenticar_user_exists()
    {
        $user = User::factory()->create();

        $response = $this->post('/api/user/auth', [
            "email" => $user->email,
            'password' => 'password',
            'token' => Str::random(40),
        ]);

        $this->assertAuthenticated();
        $response->assertStatus(JsonResponse::HTTP_OK);
    }

}
