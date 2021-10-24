<?php

declare(strict_types=1);

namespace Tests\Feature\src\Restaurant\User;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\JsonResponse;
use Tests\TestCase;

final class UserPostControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function this_should_create_a_user()
    {
        $email = "gibmyx@admin.com";

        $response = $this->post('/register', [
            "name" => "Gibmyx Gomez",
            "email" => $email,
            'password' => 'password',
            "password_confirmation" => "123456789"
        ]);

        $response->assertStatus(JsonResponse::HTTP_CREATED);
        $this->assertDatabaseHas('users', ["email" => $email]);
    }

    /**
     * @test
     */
    public function this_should_validate_an_existing_email()
    {
        $email = "gibmyx@admin.com";
        $user = [
            "name" => "Gibmyx Gomez",
            "email" => $email,
            'password' => 'password',
            "password_confirmation" => "123456789"
        ];
        $this->post('/register', $user);

        $response = $this->post('/register', $user);
        $response->assertStatus(JsonResponse::HTTP_BAD_REQUEST);
    }
}
