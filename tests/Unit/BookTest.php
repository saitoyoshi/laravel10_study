<?php

namespace Tests\Unit;

use App\Models\Book;
use PHPUnit\Framework\TestCase;

class BookTest extends TestCase
{
    /** @test */
    public function 書籍のタイトルが11文字以上で省略される(): void {
        $book1 = new Book;
        $book1->title = '1234567891';

        $book2 = new Book;
        $book2->title = '12345678912';

        $this->assertSame('1234567891', $book1->abbreviatedTitle());
        $this->assertSame('1234567891...', $book2->abbreviatedTitle());
    }
}
