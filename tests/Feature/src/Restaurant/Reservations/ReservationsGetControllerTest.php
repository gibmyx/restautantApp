<?php

declare(strict_types=1);

namespace Tests\Feature\src\Restaurant\Reservations;

use App\Models\User;
use AppRestaurant\Restaurant\Shared\Domain\ValueObject\Uuid;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\JsonResponse;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

final class ReservationsGetControllerTest extends TestCase
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
    public function this_should_get_the_reservation_for_user_exists()
    {
        $user = User::factory()->create();
        $this->authUser($user);


        $uuid = Uuid::random()->value();
        $uuidTable = Uuid::random()->value();
        $this->create_table($uuidTable);
        $this->create_reservation($uuid, $uuidTable, $user);

        $response = $this->getJson('/api/reservations');

        $response->assertStatus(JsonResponse::HTTP_OK);
    }

    /**
     * @test
     */
    public function this_should_get_the_reservation_exists()
    {
        $user = User::factory()->create();
        $this->authUser($user);


        $uuid = Uuid::random()->value();
        $uuidTable = Uuid::random()->value();
        $this->create_table($uuidTable);
        $this->create_reservation($uuid, $uuidTable, $user);

        $response = $this->getJson('/api/reservations');

        $response->assertStatus(JsonResponse::HTTP_OK);
    }

    private function create_reservation(string $uuid, string $uuidTable, User $user): void
    {
        $this->postJson("/api/reservation/{$uuid}", [
            'id' => $uuid,
            'tableId' => $uuidTable,
            'userId' => $user->id,
            'people' => 6,
            'date' => '2021-8-9 16:30:00',
        ]);
    }

    private function create_table(string $uuidTable): void
    {
        $this->post("/table/{$uuidTable}", [
            'id' => $uuidTable,
            'number' => 1,
            'maxPeople' => rand(5,9),
            'minPeople' =>  rand(2,4),
            'description' => $this->faker->text
        ]);
    }

}
