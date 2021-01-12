<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;


class AuthorsController extends Controller
{
    public function store(){
        $author = Author::create(request()->only([
            'name', 'lastname', 'dob'
        ]));
    }

    private function validateRequest():array
    {
        return request()->validate([
            'name' => request()->name,
            'last_name' => request()->lastname,
            'dob' => request()->dob,
        ]);
    }

}
