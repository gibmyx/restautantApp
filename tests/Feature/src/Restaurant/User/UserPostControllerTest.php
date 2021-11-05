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
            "password_confirmation" => "password"
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
            "password_confirmation" => "password"
        ];
        $this->postJson('/register', $user);

        $response = $this->postJson('/register', $user);
        $response->assertJsonFragment(["email" => ["The email has already been taken."]]);
    }
    /**
     * @test
     */
    public function this_should_validate_password_not_confirmation()
    {
        $user = [
            "name" => "Gibmyx Gomez",
            "email" => "gibmyx@admin.com",
            'password' => 'password',
            "password_confirmation" => "passworda"
        ];

        $response = $this->postJson('/register', $user);
        $response->assertJsonFragment(["password" => ["The password confirmation does not match."]]);
    }
}
