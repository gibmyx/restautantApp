<?php

declare(strict_types=1);

namespace Tests\Feature\src\Restaurant\Clients;

use AppRestaurant\Restaurant\Shared\Domain\ValueObject\Uuid;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\JsonResponse;
use Tests\TestCase;

final class ClientPostControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function this_should_create_a_client_api()
    {
        $email = "gibmyx@admin.com";

        $response = $this->postJson('/api/client', [
            "id" => Uuid::random()->value(),
            "name" => "Gibmyx Gomez",
            "email" => $email,
            'password' => 'password',
            "password_confirmation" => "password",
            "origin" => "mobile"
        ]);

        $response->assertStatus(JsonResponse::HTTP_CREATED);
        $this->assertDatabaseHas('clients', ["email" => $email]);
    }

    /**
     * @test
     */
    public function this_should_validate_an_existing_email_api()
    {
        $email = "gibmyx@admin.com";
        $user = [
            "id" => Uuid::random()->value(),
            "name" => "Gibmyx Gomez",
            "email" => $email,
            'password' => 'password',
            "password_confirmation" => "password",
            "origin" => "mobile"
        ];
        $this->postJson('/api/client', $user);

        $response = $this->postJson('/api/client', $user);

        $response->assertStatus(JsonResponse::HTTP_BAD_REQUEST);
        $response->assertJson([
            "message" => 'The email is already registered'
        ]);
    }

    /**
     * @test
     */
    public function this_should_validate_password_not_confirmation_api()
    {
        $user = [
            "id" => Uuid::random()->value(),
            "name" => "Gibmyx Gomez",
            "email" => "gibmyx@admin.com",
            'password' => 'password',
            "password_confirmation" => "passworda",
            "origin" => "mobile"
        ];

        $response = $this->postJson('/api/client', $user);
        $response->assertJsonFragment(["password" => ["The password confirmation does not match."]]);
    }
}
