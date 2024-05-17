<?php

namespace Tests\Feature;

use App\Models\Board;
use App\Models\User;
use Carbon\Traits\Test;
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
        $this->be($user);

        $response = $this->postJson('/board', [
            'title' => 'My Board',
            'details' => 'Something about my board.',

        ]);

        $response->assertOk();
        $this->assertDatabaseHas('boards', [
            'title' => 'My Board',
            'details' => 'Something about my board.',
            'user_id' => $user->id,
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
        $this->be($user);

        $response = $this->postJson('/board', [
            'title' => 'My Board',
        ]);

        $response->assertOk();
        $this->assertDatabaseHas('boards', [
            'title' => 'My Board',
        ]);
    }

    /** @test board title is required */
    public function board_title_is_required()
    {
        $user = User::factory()->create();
        $this->be($user);

        $response = $this->postJson('/board', [
            'details' => 'My Board',
        ]);

        $response->assertJsonValidationErrorFor('title');
    }

    /** @test test board title must be more than 3 chars */
    public function board_title_must_be_more_than_3_chars()
    {
        $user = User::factory()->create();
        $this->be($user);

        $response = $this->postJson('/board', [
            'title' => 'My',
        ]);

        $response->assertJsonValidationErrorFor('title');
    }

    /** @test user can see their own board */
    public function user_can_see_their_own_board()
    {
        $user = User::factory()->create();
        $this->be($user);
        $board = Board::factory()->for($user)->create();
        
        $responce = $this->getJson('/board/'.$board->id);

        $responce->assertOk();
    }
}
