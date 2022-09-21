<?php

namespace Tests\Feature\app\Http\Controllers;

use App\Models\Developer;
use App\Models\Level;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class DeveloperControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_new_developer_and_level_to_relate_them()
    {
        //Prepare
        $responseLevel = Level::factory()->create()->toArray();
        $developer = Developer::factory()->generateUniqueDeveloperWithLevelId($responseLevel['id']);
        //Act
        $responseDeveloper = $this->postJson('/developers', $developer);
        //Assert
        $responseDeveloper->assertStatus(201)->assertJsonFragment($responseDeveloper['data']);
        $this->assertDatabaseHas('developers', $responseDeveloper['data']);
    }

    public function test_create_new_developer_without_levelid()
    {
        //Prepare
        $developer = Developer::factory()->developerWithoutLevelId();
        //Act
        $responseDeveloper = $this->postJson('/developers', $developer);
        //Assert
        $responseDeveloper->assertStatus(422);
    }

    public function test_update_developer()
    {
        //Prepare
        $responseLevel = Level::factory()->create()->toArray();
        $developer = Developer::factory()->create(['level_id' => $responseLevel['id']])->toArray();
        $developer['name'] = 'New Name';

        //Act
        $responseDeveloper = $this->putJson('/developers/' . $developer['id'], $developer);

        //Assert
        $responseDeveloper->assertStatus(200)->assertJsonFragment($responseDeveloper['data']);
        $this->assertDatabaseHas('developers', $responseDeveloper['data']);
    }

    public function test_get_all_developers()
    {
        //Prepare

        //Act
        $response = $this->getJson('/developers');
        //Assert
        $response->assertStatus(200);
    }

    public function test_get_developer_bad_request()
    {
        //Prepare

        //Act
        $response = $this->getJson('/developers/fake_value');
        //Assert
        $response->assertStatus(400);
    }

    public function test_get_developer_not_found()
    {
        //Prepare

        //Act
        $response = $this->getJson('/developers/849889');
        //Assert
        $response->assertStatus(404);
    }

    public function test_validations_create_developer()
    {
        //Prepare
        $data = [];
        //Act
        $response = $this->postJson('/developers', $data);
        //Assert
        $response->assertStatus(422);
    }
}
