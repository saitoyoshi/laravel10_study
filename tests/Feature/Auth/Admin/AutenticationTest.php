<?php

namespace Tests\Feature\Auth\Admin;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AutenticationTest extends TestCase
{
    use RefreshDatabase;
    private $admin;

    public function setUp(): void {
        parent::setUp();
        $this->admin = Admin::factory()->create(
            [
            'login_id' => 'hoge',
            'password' => \Hash::make('hogehoge')
            ]
        );
    }
    /** @test */
    public function ログイン画面表示(): void {
        $response = $this->get(route('admin.create'))->assertOk();
    }
    /** @test */
    public function ログイン成功する():void {
        $this->post(route('admin.store',
        [
            'login_id' => 'hoge',
            'password' => 'hogehoge',
        ]))->assertRedirect(route('book.index'));
        $this->assertAuthenticatedAs($this->admin, 'admin');
    }
    /** @test */
    public function ログイン失敗する(): void {
        // idが違う
        $this->from(route('admin.store'))->post(route('admin.store',
        [
            'login_id' => 'fuga',
            'password' => 'hogehoge',
        ]))->assertRedirect(route('admin.create'))->assertInvalid(['login_id' => "These credentials do not match our records."]);

        // パスワードが違う
        $this->from(route('admin.store'))->post(route('admin.store',
        [
            'login_id' => 'hoge',
            'password' => 'fugafuga',
        ]))->assertRedirect(route('admin.create'))->assertInvalid(['login_id' => "These credentials do not match our records."]);


        $this->assertGuest('admin');
    }
    /** @test */
    public function ヴァリデーション(): void {
        $url = route('admin.store');

        $this->from(route('admin.create'))->post($url, ['login_id' => ''])->assertRedirect(route('admin.create'));

        $this->from(route('admin.create'))->post($url, ['login_id' => ''])->assertInvalid(['login_id' => 'id は必須入力']);

        $this->from(route('admin.create'))->post($url, ['login_id' => 'a'])->assertValid('login_id');

        $this->from(route('admin.create'))->post($url, ['password' => ''])->assertInvalid(['password' => 'password は必須入力']);

        $this->from(route('admin.create'))->post($url, ['password' => 'a'])->assertValid('password');

    }
}
