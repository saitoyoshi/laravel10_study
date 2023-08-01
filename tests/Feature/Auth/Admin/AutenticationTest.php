<?php

namespace Tests\Feature\Auth\Admin;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AutenticationTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function ログイン画面表示(): void {
        $response = $this->get(route('admin.create'))->assertOk();
    }
    /** @test */
    public function ログイン成功する():void {
        $admin = Admin::factory()->create(
            [
            'login_id' => 'hoge',
            'password' => \Hash::make('hogehoge')
            ]
        );
        $this->post(route('admin.store',
        [
            'login_id' => 'hoge',
            'password' => 'hogehoge',
        ]))->assertRedirect(route('book.index'));
        $this->assertAuthenticatedAs($admin, 'admin');
    }
    /** @test */
    public function ログイン失敗する(): void {
        $admin = Admin::factory()->create([
            'login_id' => 'hoge',
            'password' => \Hash::make('hogehoge'),
        ]);

        // idが違う
        $this->from(route('admin.store'))->post(route('admin.store',
        [
            'login_id' => 'fuga',
            'password' => 'hogehoge',
        ]))->assertRedirect(route('admin.create'));

        // パスワードが違う
        $this->from(route('admin.store'))->post(route('admin.store',
        [
            'login_id' => 'hoge',
            'password' => 'fugafuga',
        ]))->assertRedirect(route('admin.create'));


        $this->assertGuest('admin');
    }
}
