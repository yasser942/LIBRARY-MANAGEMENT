<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{

    $title = $request->input('title');
    $author = $request->input('author');
    $category = $request->input('category');
    $isbn = $request->input('isbn');
    $year = $request->input('year');


    $query = Book::query();

    if ($title) {
        $query->where('title', 'LIKE', "%$title%");
    }

    if ($author) {
        $query->where('author', 'LIKE', "%$author%");
    }

    if ($category) {
        $query->where('category', 'LIKE', "%$category%");
    }

    if ($isbn) {
        $query->where('isbn', $isbn);
    }

    if ($year) {
        $query->where('year', 'LIKE', "%$year%");
    }

    $books = $query->get();

    return view('index', compact('books'));
}

    public function books()
    { 
    
        $books = Book::latest()->get();
       
        

        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function addBookForm()
    {
        return view('users.admin.add_book');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'isbn' => 'required|unique:books',
            'title' => 'required',
            'author' => 'required',
            'year' => 'required|integer',
            'category' => 'required',
        ]);
         // Create a new book using the validated data
    $book = Book::create($validatedData);

    // Redirect to the book's details page
    return redirect()->route('books.index');
        
    }


    public function removeBookForm(){
        return view( 'users.admin.remove_book');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
            // Get the input values from the request
        $isbn = $request->input('isbn');
        $id = $request->input('book_id');

        // Find the book based on the provided isbn and/or id
        $book = Book::where('isbn', $isbn)->orWhere('id', $id)->first();

        // Check if the book exists
        if ($book) {
            // Delete the book
            $book->delete();
            return redirect()->route('books.index')->with('success', 'Book removed successfully');
        } else {
            return redirect()->back()->with('error', 'Book not found');
        }
    }

    public function booksDetial(){
        $books=Book::all();

        return view('users.admin.book_show',compact('books'));
    }
}
