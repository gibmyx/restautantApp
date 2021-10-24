<?php

declare(strict_types=1);

namespace Tests\Feature\src\Restaurant\Tables;

use App\Models\User;
use AppRestaurant\Restaurant\Shared\Domain\ValueObject\Uuid;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\JsonResponse;
use Tests\TestCase;

final class TablePutControllerTest extends TestCase
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
    public function this_should_update_a_table_exists()
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

        $table['maxPeople'] = 8;

        $response = $this->put("/table", $table);

        $response->assertStatus(JsonResponse::HTTP_OK);
        $this->assertDatabaseHas('tables', [
            'id' => $uuidTable,
            'max_people' => 8,
        ]);
    }

    /**
     * @test
     */
    public function this_should_validate_a_table_what_not_exists_exists()
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

        $table['id'] = Uuid::random()->value();
        $table['maxPeople'] = 8;

        $response = $this->put("/table", $table);

        $response->assertStatus(JsonResponse::HTTP_NOT_FOUND);
        $response->assertJson([
           "message" => 'Table not exists'
        ]);
    }
}
