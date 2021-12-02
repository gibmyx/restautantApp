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
            "password_confirmation" => "password",
            "origin" => "web",
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
            "password_confirmation" => "password",
            "origin" => "web",
        ];
        $this->postJson('/register', $user);

        $response = $this->postJson('/register', $user);
        $response->assertJsonFragment(["The email is already registered"]);
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
            "password_confirmation" => "passworda",
            "origin" => "mobile",
        ];

        $response = $this->postJson('/register', $user);
        $response->assertJsonFragment(["password" => ["The password confirmation does not match."]]);
    }
    /**
     * @test
     */
    public function this_should_create_a_user_api()
    {
        $email = "gibmyx@admin.com";

        $response = $this->post('/api/register', [
            "name" => "Gibmyx Gomez",
            "email" => $email,
            'password' => 'password',
            "password_confirmation" => "password",
            "origin" => "mobile",
        ]);

        $response->assertStatus(JsonResponse::HTTP_CREATED);
        $this->assertDatabaseHas('users', ["email" => $email]);
    }

    /**
     * @test
     */
    public function this_should_validate_an_existing_email_api()
    {
        $email = "gibmyx@admin.com";
        $user = [
            "name" => "Gibmyx Gomez",
            "email" => $email,
            'password' => 'password',
            "password_confirmation" => "password",
            "origin" => "web",
        ];
        $this->postJson('/api/register', $user);

        $response = $this->postJson('/api/register', $user);
        $response->assertJsonFragment(["The email is already registered"]);
    }

    /**
     * @test
     */
    public function this_should_validate_password_not_confirmation_api()
    {
        $user = [
            "name" => "Gibmyx Gomez",
            "email" => "gibmyx@admin.com",
            'password' => 'password',
            "password_confirmation" => "passworda",
            "origin" => "mobile",
        ];

        $response = $this->postJson('/api/register', $user);
        $response->assertJsonFragment(["password" => ["The password confirmation does not match."]]);
    }

    /**
     * @test
     */
    public function this_should_create_a_user_for_mobile_and_web_with_same_email()
    {
        $email = "gibmyx@admin.com";
        $user = [
            "name" => "Gibmyx Gomez",
            "email" => $email,
            'password' => 'password',
            "password_confirmation" => "password",
            "origin" => "web"
        ];
        $this->postJson('/register', $user);

        $user['origin'] = "mobile";
        $this->postJson('/api/register', $user);

        $this->assertDatabaseHas('users', ["email" => $email, "origin" => "web"]);
        $this->assertDatabaseHas('users', ["email" => $email, "origin" => "mobile"]);
    }
}
