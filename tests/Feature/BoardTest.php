<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BoardTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function user_can_create_a_board(): void
    {
        $user = User::factory()->create();
        $this -> be($user);
        
        $response = $this->postJson('/board', [
            'title' => 'My Board',
            'details' => 'Something about my board.',

        ]);

        $response->assertOk();
        $this->assertDatabaseHas('boards',[
            'title'=> 'My Board',
            'details'=> 'Something about my board.',
        ]);
    }

    /** @test guest cannot create a board */
    public function guest_cannot_create_a_board()
    {
        $response = $this->postJson('/board', [
            'title' => 'My Board',
            'details' => 'Somethinf aboute me board.'
        ]);

        $response->assertUnauthorized();
    }

    /** @test user can create a board without details */
    public function user_can_create_board_without_details()
    {
        $user = User::factory()->create();
        $this -> be($user);

        $response = $this->postJson('/board', [
            'title' => 'My Board',
        ]);

        $response->assertOk();
        $this->assertDatabaseHas('boards', [
            'title' => 'My Board',
        ]);
    }
}
