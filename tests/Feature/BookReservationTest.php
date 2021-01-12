<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;


class BookReservationTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_book_can_be_added_to_the_library(){


        $response = $this->post('/books', [
            'title' => 'Title of my book',
            'author' => 'Richard Saavedra'
         ]);
        $response->assertOk();
        $this->assertCount(1, Book::all());

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

        $response = $this->post('/books', [
            'title' => 'This is the title',
            'author' => ''
        ]);
        $response->assertSessionHasErrors('author');
    }

    /** @test  */
    function a_book_can_be_updated(){

        $this->post('/books', [
            'title' => 'Title of my book',
            'author' => 'Richard Saavedra'
        ]);
        $book = Book::first();
        $this->patch('/books/'. $book->id, [
            'title' => 'Updated Title of my book',
            'author' => 'Richard Saavedra Updated'
        ]);
        $this->assertEquals('Updated Title of my book', Book::first()->title);
        $this->assertEquals('Richard Saavedra Updated', Book::first()->author);
    }
    /** @test  */
    public function a_book_can_be_deleted(){
        $this->withoutExceptionHandling();

        $this->post('/books', [
            'title' => 'Title of my book',
            'author' => 'Richard Saavedra'
        ]);

        $book = Book::first();
        $this->assertCount(1, Book::all());

        $response = $this->delete('/books/' . $book->id);
        $this->assertCount(0, Book::all());

    }

}

