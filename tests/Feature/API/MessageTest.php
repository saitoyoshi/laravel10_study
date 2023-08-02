<?php

namespace Tests\Feature\API;

use App\Models\Message;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MessageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function 一覧取得(): void {
        $message1 = Message::create(['body' => 'hello']);
        $message2 = Message::create(['body' => 'come on']);

        $this->getJson(route('api.message.index'))->assertOk()->assertJson([
            'data' => [
                [
                'type' => 'message',
                'id' => $message1->id,
                'body' => $message1->body,
                'url' => url('/messages/' . $message1->id),
                ],
                [
                'type' => 'message',
                'id' => $message2->id,
                'body' => $message2->body,
                'url' => url('/messages/' . $message2->id),
                ],
            ]
            ]);
    }
    /** @test */
    public function 一件取得(): void {
        $message1 = Message::create(['body' => 'hello']);

        $this->getJson(route('api.message.show', $message1))->assertOk()->assertJson(
            ['data' =>
                [
                'type' => 'message',
                'id' => $message1->id,
                'body' => $message1->body,
                'url' => url('/messages/' . $message1->id),
                ]

        ]);
    }
    /** @test */
    public function 登録(): void {
        $message = ['body' => 'I love IT'];
        $this->postJson(route('api.message.store', $message))->assertStatus(201)->assertJson($message);

        $this->assertDatabaseHas('messages', $message);
    }
    /** @test */
    public function 削除(): void {
        $message = Message::create(['body' => 'good']);
        $this->deleteJson('api/messages/' . $message->id)->assertStatus(204);

        $this->assertModelMissing($message);
    }

}
