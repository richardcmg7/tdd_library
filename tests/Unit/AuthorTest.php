<?php

namespace Tests\Unit;

use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class AuthorTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
//    public function a_dob_and_last_name_is_nullable()
//    {
//        Author::firstOrCreate([
//            'name' => 'Richard'
//        ]);
//
//        $this->assertCount(1, Author::all());
//    }
    /** @test */
    public function only_name_is_required_to_create_an_author()
    {
        Author::firstOrCreate([
            'name' => 'Richard',
            'lastname' => 'Saavedra',
        ]);

        $this->assertCount(1, Author::all());
    }
}
