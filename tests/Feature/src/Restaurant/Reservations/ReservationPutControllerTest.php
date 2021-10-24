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

final class ReservationPutControllerTest extends TestCase
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
    public function this_should_update_a_reservation_exists_api()
    {
        $user = User::factory()->create();
        $this->authUser($user);

        $uuid = Uuid::random()->value();
        $uuidTable = Uuid::random()->value();
        $this->create_table($uuidTable);
        $reservation = $this->create_reservation($uuid, $uuidTable, $user);

        $reservation['people'] = 4;
        $reservation['date'] = '2021-9-9 16:30:00';

        $response = $this->putJson("/api/reservation", $reservation);

        $response->assertStatus(JsonResponse::HTTP_OK);
        $this->assertDatabaseHas('reservation', [
            'id' => $uuid,
            'peoples' => 4,
        ]);
    }

    /**
     * @test
     */
    public function this_should_valitadion_a_reservation_what_not_exists_api()
    {
        $user = User::factory()->create();
        $this->authUser($user);

        $uuid = Uuid::random()->value();
        $uuidTable = Uuid::random()->value();
        $this->create_table($uuidTable);
        $reservation = $this->create_reservation($uuid, $uuidTable, $user);

        $reservation['id'] = Uuid::random()->value();
        $reservation['people'] = 4;
        $reservation['date'] = '2021-9-9 16:30:00';

        $response = $this->putJson("/api/reservation", $reservation);

        $response->assertStatus(JsonResponse::HTTP_NOT_FOUND);
        $response->assertJson([
            'message' => 'Reservation not exists'
        ]);
    }

    private function create_reservation(string $uuid, string $uuidTable, User $user): array
    {
        $reserva = [
            'id' => $uuid,
            'tableId' => $uuidTable,
            'userId' => $user->id,
            'people' => 6,
            'date' => '2021-8-9 16:30:00',
        ];

        $this->postJson("/api/reservation/{$uuid}", $reserva);

        return $reserva;
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
