<?php

namespace Tests\Feature\app\Http\Controllers;

use App\Models\Level;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LevelControllerTest extends TestCase
{
   // use DatabaseMigrations;
      use RefreshDatabase;

    public function testCreateLevel()
    {
        $responseLevel = $this->postJson('/api/levels', level());
        $responseLevel->assertStatus(201)->assertJsonFragment($responseLevel['data']);
        $this->assertDatabaseHas('levels', $responseLevel['data']);
    }
}
