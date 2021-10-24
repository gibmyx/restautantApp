<?php

declare(strict_types=1);

namespace Tests\Feature\src\Restaurant\Tables;

use App\Models\User;
use AppRestaurant\Restaurant\Shared\Domain\ValueObject\Uuid;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\JsonResponse;
use Tests\TestCase;
use Faker\Factory;

final class TablePostControllerTest extends TestCase
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
    public function this_should_create_a_table()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get('/');

        $uuidTable = Uuid::random()->value();

        $response = $this->post("/table/{$uuidTable}", [
            'id' => $uuidTable,
            'number' => 1,
            'maxPeople' => rand(5,9),
            'minPeople' =>  rand(2,4),
            'description' => $this->faker->text
        ]);

        $response->assertStatus(JsonResponse::HTTP_CREATED);
        $this->assertDatabaseHas('tables', ['id' => $uuidTable]);
    }
}
