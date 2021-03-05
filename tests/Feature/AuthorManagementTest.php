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

         $this->post('/authors', $this->data());
         $author = Author::all();

         $this->assertCount(1, Author::all());
         $this->assertInstanceOf(Carbon::class, $author->first()->dob);
         $this->assertEquals('1988/14/05', $author->first()->dob->format('Y/d/m'));
    }
    /** @test */

public function a_name_is_required()
    {
        $response = $this->post('/authors', array_merge($this->data(), ['name' => '']));
        $response->assertSessionHasErrors('name');
    }    /** @test */

public function a_dob_is_required()
    {
        $response = $this->post('/authors', array_merge($this->data(), ['dob' => '']));
        $response->assertSessionHasErrors('dob');
    }

    /**
     * @return string[]
     */
    private function data(): array
    {
        return [
            'name' => 'Author name',
            'lastname' => 'Author Last Name',
            'dob' => '05/14/1988',
        ];
    }


}
