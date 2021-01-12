<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class BooksController extends Controller
{
    public function store(Request $request){
        $book = Book::create($this->validateRequest());

        return redirect( $book->path() );

    }
    public function update(Book $book){
        $book->update($this->validateRequest());

        return redirect($book->path());
    }

    public function destroy(Book $book){
        try {
            $book->delete();

            return redirect('/books');

        } catch (\Exception $e) {
        }
    }
    /**
     * @return array
     */
    protected function validateRequest(): array
    {
        return request()->validate([
            'title' => 'required',
            'author' => 'required'
        ]);
    }
}
