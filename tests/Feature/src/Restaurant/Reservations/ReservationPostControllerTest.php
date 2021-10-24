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

final class ReservationPostControllerTest extends TestCase
{
    use DatabaseTransactions;

    private $faker;

    protected function setUp(): void
    {
        $this->faker = Factory::create();
        parent::setUp();
    }

    /**
     * @test
     */
    public function this_should_create_a_reservation()
    {
        $user = User::factory()->create();
        Sanctum::actingAs(
            $user,
            ['view-tasks']
        );

        $uuid = Uuid::random()->value();
        $uuidTable = Uuid::random()->value();
        $this->create_table($uuidTable);

        $reservation = [
            'id' => $uuid,
            'tableId' => $uuidTable,
            'userId' => $user->id,
            'people' => 6,
            'date' => '2021-8-9 16:30:00',
        ];
        $response = $this->postJson("/api/reservation/{$uuid}", $reservation);

        $response->assertStatus(JsonResponse::HTTP_CREATED);
        $this->assertDatabaseHas('reservation', ['id' => $uuid]);
    }

    private function create_table(string $uuidTable)
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
