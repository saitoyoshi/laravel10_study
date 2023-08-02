<?php

namespace Tests\Feature\Admin;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookUpdate extends TestCase
{
    use RefreshDatabase;

    private $admin;
    private $book;
    private $categories;
    private $authors;

    public function setUp(): void {
        parent::setUp();

        $this->admin = Admin::factory()->create([
            'login_id' => 'hoge',
            'password' => \Hash::make('hogehoge')
        ]);

        $this->categories = Category::factory(3)->create();

        $this->book = Book::factory()->create([
            'title' => 'Laravel book',
            'admin_id' => $this->admin->id,
            'category_id' => $this->categories[1]->id
        ]);

        $this->authors = Author::factory(4)->create();

        $this->book->authors()->attach([$this->authors[0]->id,$this->authors[2]->id]);
    }
    /** @test */
    public function アクセス制御(): void {
        $url = route('book.edit', $this->book);

        $this->get($url)->assertRedirect(route('admin.create'));

        $other = Admin::factory()->create();

        $this->actingAs($other, 'admin');
        $this->get($url)->assertForbidden();

        $this->actingAs($this->admin, 'admin');
        $this->get($url)->assertOk();
    }
    /** @test */
    public function 更新処理のアクセス制御(): void {
        $url = route('book.update', $this->book);
        $param = [
            'category_id' => $this->categories[0]->id,
            'title' => 'New laravel book',
            'price' => '10000',
            'author_ids' => [$this->authors[1]->id, $this->authors[2]->id],
        ];
        $this->put($url, $param)->assertRedirect(route('admin.create'));

        $other = Admin::factory()->create();
        $this->actingAs($other, 'admin');
        $this->put($url, $param)->assertForbidden();

        $this->assertSame('Laravel book', $this->book->refresh()->title);
    }
    /** @test */
    public function 更新処理のヴァリデーション(): void {
        $this->actingAs($this->admin, 'admin');
        $url = route('book.update', $this->book);

        $this->from(route('book.edit', $this->book))->put($url, ['category_id' => ''])->assertRedirect(route('book.edit', $this->book));

        $this->put($url, ['category_id' => ''])->assertInvalid(['category_id' => 'カテゴリ は必須']);

        $this->put($url, ['category_id' => '0'])->assertInvalid(['category_id' => '正しい カテゴリ']);

        $this->put($url, ['category_id' => $this->categories[2]->id])->assertValid('category_id');

        $this->put($url, ['title' => ''])->assertInvalid(['title' => 'タイトル は必須入力']);
        $this->put($url, ['title' => 'a'])->assertValid('title');

        $this->put($url, ['title' => str_repeat('a', 100)])->assertValid('title')->assertValid('title');

        $this->put($url, ['title' => str_repeat('a', 101)])->assertInvalid(['title' => 'タイトル は 100 文字以内']);

        $this->put($url, ['price' => 'a'])->assertInvalid(['price' => '価格 は数値']);
        $this->put($url, ['price' => '0'])->assertInvalid(['price' => '価格 は 1 以上']);
        $this->put($url, ['price' => '1'])->assertValid('price');
        $this->put($url, ['price' => '9999'])->assertValid('price');
        $this->put($url, ['price' => '10000'])->assertInvalid(['price' => '価格 は 9999 以下']);

        $this->put($url, ['author_ids' => []])->assertInvalid(['author_ids' => '著者 は必須入力']);

        $this->put($url, ['author_ids' => ['0']])->assertInvalid(['author_ids.0' => '正しい 著者 を選択']);

        $this->put($url, ['author_ids' => [$this->authors[2]->id]])->assertValid('author_ids.0');





    }
}
