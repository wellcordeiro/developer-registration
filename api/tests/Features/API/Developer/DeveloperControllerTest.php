<?php

namespace Tests\Features\API\Developer;

use App\Models\Developer;
use App\Models\Level;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeveloperControllerTest extends TestCase
{
    use RefreshDatabase;

    /* ========= CREATE =========================================================== */
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

    public function test_create_developer_with_invalid_data()
    {
        //Prepare
        $data = [];
        //Act
        $response = $this->postJson('/developers', $data);
        //Assert
        $response->assertStatus(422);
    }

    public function test_create_duplicate_developer()
    {
        //Prepare
        $responseLevel = Level::factory()->create()->toArray();
        $developer = Developer::factory()->generateUniqueDeveloperWithLevelId($responseLevel['id']);
        $this->postJson('/developers', $developer);
        //Act
        $responseDeveloper = $this->postJson('/developers', $developer);
        //Assert
        $responseDeveloper->assertStatus(422);
        $this->assertEquals('The email has already been taken.', $responseDeveloper['errors']['email'][0]);
    }

    /* =========END CREATE=========================================================== */

    /* ========= UPDATE =========================================================== */
    public function test_update_developer()
    {
        //Prepare
        $responseLevel = Level::factory()->create()->toArray();
        $developer = Developer::factory()->create(['level_id' => $responseLevel['id']])->toArray();
        $developer['name'] = 'New Developer Name';

        //Act
        $responseDeveloper = $this->putJson('/developers/' . $developer['id'], $developer);

        //Assert
        $responseDeveloper->assertStatus(200)->assertJsonFragment($responseDeveloper['data']);
        $this->assertDatabaseHas('developers', $responseDeveloper['data']);
    }

    public function test_validations_update_developer()
    {
        //Prepare
        $data = [];
        //Act
        $response = $this->putJson('/developers/1', $data);
        //Assert
        $response->assertStatus(422);
    }

    public function test_update_developer_invalid_data()
    {
        //Prepare
        $data = [];
        //Act
        $response = $this->putJson('/developers/1', $data);
        //Assert
        $response->assertStatus(422);
    }
    /* =========END UPDATE=========================================================== */

    /* ========= GET =========================================================== */
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
    /* =========END GET=========================================================== */

    /* ========= DELETE =========================================================== */
    public function test_delete_developer()
    {
        //Prepare
        $responseLevel = Level::factory()->create()->toArray();
        $developer = Developer::factory()->create(['level_id' => $responseLevel['id']])->toArray();
        //Act
        $response = $this->deleteJson('/developers/' . $developer['id']);
        //Assert
        $response->assertStatus(204);
    }

    public function test_delete_developer_not_found()
    {
        //Prepare

        //Act
        $response = $this->deleteJson('/developers/' . 99999);
        //Assert
        $response->assertStatus(404);
    }
    /* =========END DELETE=========================================================== */
}
