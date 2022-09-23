<?php

namespace Tests\Features\API\Level;

use App\Models\Developer;
use App\Models\Level;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LevelControllerTest extends TestCase
{
    use RefreshDatabase;

    /* ========= CREATE =========================================================== */
    public function test_create_level()
    {
        //Prepare
        $level = Level::factory()->definition();
        //Act
        $responseLevel = $this->postJson('/levels', $level);
        //Assert
        $responseLevel->assertStatus(201)->assertJsonFragment($responseLevel['data']);
    }

    public function test_create_duplicate_level()
    {
        //Prepare
        $level = Level::factory()->create()->toArray();
        //Act
        $responseLevel = $this->postJson('/levels', $level);

        //Assert
        $responseLevel->assertStatus(422);
        $this->assertEquals('The name has already been taken.', $responseLevel['errors']['name'][0]);
    }

    public function test_create_level_with_invalid_data()
    {
        //Prepare
        $level = Level::factory()->definition();
        $level['name'] = null;
        //Act
        $responseLevel = $this->postJson('/levels', $level);
        //Assert
        $responseLevel->assertStatus(422);
    }
    /* =========END CREATE=========================================================== */

    /* ========= UPDATE =========================================================== */
    public function test_update_level()
    {
        //Prepare
        $level = Level::factory()->create()->toArray();
        $level['name'] = 'New Name Level';

        //Act
        $responseLevel = $this->putJson('/levels/' . $level['id'], $level);

        //Assert
        $responseLevel->assertStatus(200)->assertJsonFragment($responseLevel['data']);
    }

    public function test_update_level_not_found()
    {
        //Prepare
        $level = Level::factory()->create()->toArray();
        $level['name'] = 'New Name Level';

        //Act
        $responseLevel = $this->putJson('/levels/' . $level['id'] + 1, $level);

        //Assert
        $responseLevel->assertStatus(404);
    }

    public function test_update_level_with_invalid_data()
    {
        //Prepare
        $level = Level::factory()->create()->toArray();
        $level['name'] = null;
        //Act
        $responseLevel = $this->putJson('/levels/' . $level['id'], $level);
        //Assert
        $responseLevel->assertStatus(422);
    }
    /* =========END UPDATE=========================================================== */

    /* ========= GET =========================================================== */
    public function test_get_all_levels()
    {
        //Prepare

        //Act
        $response = $this->getJson('/levels');
        //Assert
        $response->assertStatus(200);
    }

    public function test_get_level_by_id()
    {
        //Prepare
        $level = Level::factory()->create()->toArray();
        //Act
        $response = $this->getJson('/levels/' . $level['id']);
        //Assert
        $response->assertStatus(200);
    }

    public function test_get_level_by_id_not_found()
    {
        //Prepare
        $level = Level::factory()->create()->toArray();
        //Act
        $response = $this->getJson('/levels/' . $level['id'] + 1);
        //Assert
        $response->assertStatus(404);
    }

    public function test_get_level_bad_request()
    {
        //Prepare

        //Act
        $response = $this->getJson('/levels/fake_value');
        //Assert
        $response->assertStatus(400);
    }
    /* =========END GET=========================================================== */

    /* ========= DELETE =========================================================== */
    public function test_delete_level_with_relations_developers()
    {
        //Prepare
        $level = Level::factory()->create()->toArray();
        $responseDeveloper = Developer::factory()->create(['level_id' => $level['id']])->toArray();
        $developer = $this->postJson('/developers', $responseDeveloper);
        //Act
        $response = $this->deleteJson('/levels/' . $level['id']);
        //Assert
        $response->assertStatus(409);
    }

    public function test_delete_level_by_id()
    {
        //Prepare
        $level = Level::factory()->create()->toArray();
        //Act
        $response = $this->deleteJson('/levels/' . $level['id']);
        //Assert
        $response->assertStatus(204);
    }

    public function test_delete_level_by_id_not_found()
    {
        //Prepare

        //Act
        $response = $this->deleteJson('/levels/' . '99999999999999999999');
        //Assert
        $response->assertStatus(404);
    }
    /* =========END DELETE=========================================================== */
}
