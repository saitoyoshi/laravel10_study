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

        $this->book->authors()->attach([$this->categories[0]->id,$this->categories[2]->id]);
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
}
