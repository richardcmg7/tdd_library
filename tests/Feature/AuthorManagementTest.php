<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\Book;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthorManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_author_can_be_created()
    {

         $this->post('/authors', [
             'name' => 'Author name',
             'lastname' => 'Author Last Name',
             'dob' => '05/14/1988',
         ]);
         $author = Author::all();

         $this->assertCount(1, Author::all());
         $this->assertInstanceOf(Carbon::class, $author->first()->dob);
         $this->assertEquals('1988/14/05', $author->first()->dob->format('Y/d/m'));
    }



}
