<?php

namespace Tests\Feature;

use App\Models\Author;
use Tests\TestCase;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;


class BookManagementTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_book_can_be_added_to_the_library(){


        $response = $this->post('/books', $this->data());

        $book = Book::first();


        $this->assertCount(1, Book::all());

        $response->assertRedirect($book->path() );

    }
    /** @test */
    public function a_title_is_required(){

        $response = $this->post('/books', [
            'title' => '',
            'author' => 'Richard Saavedra'
        ]);
        $response->assertSessionHasErrors('title');
    }
    /** @test */
    public function a_author_is_required(){

        $response = $this->post('/books', array_merge($this->data(), ['author_id' => '']));
        $response->assertSessionHasErrors('author_id');
    }

    /** @test  */

    function a_book_can_be_updated(){

        $this->post('/books', $this->data());

        $book = Book::first();

        $response = $this->patch($book->path(), array_merge($this->data(), [
                'title' => 'Updated Title of my book',
                'author_id' => 'Richard Saavedra Updated'
            ]
        ));

        $this->assertEquals('Updated Title of my book', Book::first()->title);
        $this->asser tEquals(2, Book::first()->author_id);

        $response->assertRedirect($book->fresh()->path());
    }
    /** @test  */
    public function a_book_can_be_deleted(){

        $this->post('/books', $this->data());

        $book = Book::first();
        $this->assertCount(1, Book::all());

        $response = $this->delete($book->path());
        $this->assertCount(0, Book::all());
        $response->assertRedirect('/books');

    }
    /** @test */
    public function a_new_author_is_automatically_added()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/books', [
            'title' => 'Title of my book',
            'author_id' => 'Richard Saavedra'
        ]);

        $book = Book::first();
        $author = Author::first();

        $this->assertEquals($author->id, $book->author_id);
        $this->assertCount(1, Author::all());

    }

    private function data(): array
    {
        return [
            'title' => 'Title of my book',
            'author_id' => 'Richard Saavedra'
        ];
    }
}

