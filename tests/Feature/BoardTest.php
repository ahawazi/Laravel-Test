<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BoardTest extends TestCase
{
    /** @test */
    public function user_can_create_a_board(): void
    {
        $response = $this->post('/board' ,[
            'name' => 'My Board',
            'details' => 'Something about my board',

        ]);

        $response->assertStatus(200);
    }
}
