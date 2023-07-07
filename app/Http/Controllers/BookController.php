<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\Fine;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

public function books(Request $request)
{
    $categories = Book::distinct('category')->pluck('category');
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

    $books = $query->latest()->get();


    return view('books.index', compact('categories', 'books'));
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
            'image' => 'required|image|mimes:jpeg,png,jpg'
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $uploadedFile = $request->file('image');
            $imagePath = Storage::putFile('public/images', $uploadedFile);
        }

        $validatedData['image']=$imagePath;
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
     * Update the specified resource in storage.
     */
    public function editBook(Request $request, Book $book)
    {


        $validatedData = $request->validate([
            'isbn' => 'required|unique:books,isbn,' . $book->id,
            'title' => 'required',
            'author' => 'required',
            'year' => 'required|integer',
            'category' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg'
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $uploadedFile = $request->file('image');
            $imagePath = Storage::putFile('public/images', $uploadedFile);
            $validatedData['image'] = $imagePath;
        } else {
            $validatedData['image'] = $book->image;
        }


        $redirectUrl = $request->input('redirect_url');

         // Update the book with the validated data
         $book->update($validatedData);
         return redirect($redirectUrl)->to($redirectUrl)->with('success', 'Book updated successfully');



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
        // Get the redirect URL from the request
        $redirectUrl = $request->input('redirect_url');



        // Check if the book exists
        if ($book) {
            // Delete the book
            $book->delete();
            return redirect()->to($redirectUrl)->with('success', 'Book removed successfully');
        } else {
            return redirect()->back()->with('error', 'Book not found');
        }
    }

    public function deleteById(Request $request, Book $book){
         // Delete the book from the database
            $book->delete();
            $redirectUrl = $request->input('redirect_url');
            return redirect()->to($redirectUrl)->with('success', 'Book removed successfully');

    }

    public function booksDetial(){
        $books=Book::all();

        return view('users.admin.book_show',compact('books'));
    }

    public function editBookForm(Book $book){
        return view( 'users.admin.edit_book', compact('book'));
    }

    public function borrowBook(Book $book)
    {
        // Check if the user is authenticated and is a normal user
        if (auth()->check() && auth()->user()->role === 'user') {
            // Check if the user has already borrowed the book
            if (auth()->user()->borrows()->where('book_id', $book->id)->exists()) {
                // Redirect the user back with an error message if the book is already borrowed
                return redirect()->back()->with('error', 'You have already borrowed this book.');
            }

            // Check if the book count is greater than 0
            if ($book->count > 0) {
                // Calculate the return date
                $returnDate = now()->addDays(15);

                // Create a new borrow record with the return date
                Borrow::create([
                    'user_id' => auth()->user()->id,
                    'book_id' => $book->id,
                    'borrowed_at' => now(),
                    'return_date' => $returnDate,
                ]);



                // Decrease the book count by one
                $book->decrement('count');

                // Redirect the user back with a success message
                return redirect()->back()->with('success', 'Book borrowed successfully. Return by: ' . $returnDate->toDateString());
            } else {
                // Redirect the user back with an error message if the book count is 0
                return redirect()->back()->with('error', 'This book is not available for borrowing.');
            }
        }

        // If the user is not a normal user, redirect with an error message
        return redirect()->back()->with('error', 'You are not authorized to borrow books.');
    }


    public function returnBook(Book $book)
    {
        // Check if the user is authenticated and is a normal user
        if (auth()->check() && auth()->user()->role === 'user') {
            // Find the borrow record for the user and book
            $borrow = Borrow::where('user_id', auth()->user()->id)
                ->where('book_id', $book->id)
                ->first();

            if ($borrow) {
                // Delete the borrow record
                $borrow->delete();

                // Increment the count of the book by one
                $book->increment('count');

                // Calculate the fine if the return date is past the due date
                $returnDate = Carbon::now();
                $dueDate = Carbon::parse($borrow->borrowed_at)->addDays(15);
                $fine = 0;

                if ($returnDate > $dueDate) {
                    // Calculate the number of days the book is overdue
                    $daysOverdue = $returnDate->diffInDays($dueDate);
                    // Calculate the fine amount based on the number of days overdue
                    $fine = $daysOverdue * 10; // Assuming a fine of 10 units per day

                    // Save the fine in the fines table
                    $fine = Fine::create([
                        'user_id' => auth()->user()->id,
                        'book_id' => $book->id,
                        'amount' => $fine,
                    ]);
                }

                // Redirect the user back with a success message
                if ($fine) {
                    return redirect()->back()->with('success', 'Book returned successfully. Fine: ' . $fine->amount);
                } else {
                    return redirect()->back()->with('success', 'Book returned successfully. No fine incurred.');
                }
            } else {
                // If the borrow record is not found, redirect with an error message
                return redirect()->back()->with('error', 'You have not borrowed this book.');
            }
        }

        // If the user is not a normal user, redirect with an error message
        return redirect()->back()->with('error', 'You are not authorized to return books.');
    }




}
