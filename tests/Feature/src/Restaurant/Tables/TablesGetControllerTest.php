<?php

declare(strict_types=1);

namespace Tests\Feature\src\Restaurant\Tables;

use App\Models\User;
use AppRestaurant\Restaurant\Shared\Domain\ValueObject\Uuid;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\JsonResponse;
use Tests\TestCase;

final class TablesGetControllerTest extends TestCase
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
    public function this_should_get_the_tables_exists()
    {
        $user = User::factory()->create();
        $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get('/');

        $uuidTable = Uuid::random()->value();
        $table = [
            'id' => $uuidTable,
            'number' => 1,
            'maxPeople' => 5,
            'minPeople' =>  2,
            'description' => $this->faker->text
        ];
        $this->post("/table/{$uuidTable}", $table);

        $response = $this->getJson('/tables');

        $response->assertStatus(JsonResponse::HTTP_OK);
    }
}
