<?php

declare(strict_types=1);

namespace Tests\Feature\src\Restaurant\Clients;

use App\Models\User;
use AppRestaurant\Restaurant\Shared\Domain\ValueObject\Uuid;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\JsonResponse;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

final class ClientsGetControllerTest extends TestCase
{
    use DatabaseTransactions;

    private $faker;

    protected function setUp(): void
    {
        $this->faker = Factory::create();
        parent::setUp();
    }

    private function authUser(User $user)
    {
        $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get('/');
    }

    private function authUserApi(User $user)
    {
        Sanctum::actingAs(
            $user,
            ['view-tasks']
        );
    }

    /**
     * @test
     */
    public function this_should_get_clients_exists()
    {
        $user = User::factory()->create();
        $this->authUser($user);
        $this->createClient();


        $response = $this->getJson('/clients?origin=mobile');
        $response->assertStatus(JsonResponse::HTTP_OK);
    }

    private function createClient()
    {
        $this->postJson('/register', [
            "name" => "Gibmyx Gomez",
            "email" => "gibmyx@admin.com",
            'password' => 'password',
            "password_confirmation" => "password",
            "origin" => "mobile",
        ]);
    }
}
