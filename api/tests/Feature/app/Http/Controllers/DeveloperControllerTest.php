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
        $developer = Developer::factory()->create(['level_id' => $responseLevel['id']])->toArray();

        //Act
        $responseDeveloper = $this->postJson('/api/developers', $developer);

        //Assert
        $responseDeveloper->assertStatus(201)->assertJsonFragment($responseDeveloper['data']);
        $this->assertDatabaseHas('developers', $responseDeveloper['data']);
    }

    public function test_create_new_developer_without_levelid()
    {
        //Prepare
        $developer = Developer::factory()->create()->toArray();

        //Act
        $responseDeveloper = $this->postJson('/api/developers', $developer);

        //Assert
        $responseDeveloper->assertStatus(400);
        $responseDeveloper->assertJsonMissingValidationErrors(['level_id']);
    }
}
