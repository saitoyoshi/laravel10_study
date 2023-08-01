<?php

namespace Tests\Feature;

use App\Models\Message;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MessageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }
    /** @test */
    public function メッセージ一覧の表示(): void {
        Message::create(['body' => 'Hello world']);
        Message::create(['body' => 'come on']);
        $response = $this->get('/messages');
        $response->assertOk()->assertSee('Hello world')->assertSee('come on');
    }
}
