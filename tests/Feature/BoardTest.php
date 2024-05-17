<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BoardTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function user_can_create_a_board(): void
    {
        $response = $this->post('/board', [
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
}
