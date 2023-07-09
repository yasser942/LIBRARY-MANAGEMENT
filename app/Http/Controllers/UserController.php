<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\Shelf;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the user input
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'address' => 'required',
        ]);

        // Create a new User instance
        $user = new User();

        // Assign the validated data to the User instance
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->address = $validatedData['address'];

        // Save the user in the database
        $user->save();

        // Redirect to a success page or any other appropriate action
        return redirect()->route('users.login', $user->id)
            ->with('success', 'User created successfully');
    }


    public function showRegisteredUsers()
    {
        $users = User::where('role', '!=', 'admin')
            ->withCount('fines')
            ->get();

        return view('users.admin.registeredusers', ['users' => $users]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {

        return view('users.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
         // Validate the user input
         $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'required|min:8|confirmed',
            'address' => 'required',
        ]);
        // Update the user with the validated data
        $user->update($validatedData);

        $role =auth()->user()->role;

        if($role=='admin'){
            return redirect()->route('admin.dashboard')->with('success', 'User updated successfully');
        }else{
            return redirect()->route('index')->with('success', 'User updated successfully');
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function loginform()
    {
        return view('users.login');
    }

    public function login(Request $request)
    {
        // Validate the login form data
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            // Authentication successful

            if (\auth()->user()->role=='admin') {
                return redirect()->route('admin.dashboard');
            }else{
                return redirect()->route('user.dashboard');
            }

        }

        // Authentication failed
        return redirect()->back()->withErrors([
            'email' => 'Invalid credentials',
        ]);
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }

    public function adminDashboard()
    {
        $userCount = User::where('role', 'user')->count();
        $bookCount = Book::count();
        $availableBooksCount = Book::sum('count');
        $borrowedBooksCount = Borrow::count();
        $shelves = Shelf::all();


        return view('users.admin.dashboard', compact('userCount', 'bookCount', 'availableBooksCount', 'borrowedBooksCount', 'shelves'));
    }


    public function userDashboard(){
        return view('users.user_dashboard');

    }

            public function follow(User $user)
        {
            auth()->user()->follow($user);
            return redirect()->back()->with('success', 'User followed successfully');
        }

        public function unfollow(User $user)
        {
            auth()->user()->unfollow($user);
            return redirect()->back()->with('success', 'User unfollowed successfully');
        }

        public  function follower_following(){

            $user = auth()->user();
            $followers = $user->followers;
            $following = $user->follows;
            return view('users.follower_following', compact('followers', 'following'));
        }

    public function showBorrowedBooks(User $user)
    {
        $borrowedBooks = $user->borrows()->with('book')->get();


        return view('users.detail', compact('borrowedBooks'));
    }

    public function viewBorrowedBooks()
    {
        $borrowedBooks = Borrow::with('user', 'book')->get();

        return view('users.admin.borrow_show', compact('borrowedBooks'));
    }

    public function showFines(){

        $usersWithFines = User::whereHas('fines')
            ->with('fines')
            ->get()
            ->map(function ($user) {
                $user->totalFine = $user->fines->sum('amount');
                return $user;
            });
        return view('users.admin.fines',compact('usersWithFines'));
    }

        public function deleteFines(User $user)
        {
            // Delete fines for the user
            $user->fines()->delete();

            // Redirect back with a success message
            return redirect()->back()->with('success', 'Fines deleted successfully.');
        }

    public function showPersonalShelf($userId)
    {
        // Retrieve the user's borrowed books
        $user = User::findOrFail($userId);
        $borrowedBooks = $user->borrows()->with('book')->get();

        return view('users.personal_bookshelf', compact('user', 'borrowedBooks'));
    }

    public function userFines($userId)
    {
        // Retrieve the user's fines and the related book information
        $user = User::findOrFail($userId);
        $fines = $user->fines()->with('book')->get();

        // Calculate the sum of fines
        $totalFine = $fines->sum('amount');

        return view('users.fines', compact('user', 'fines', 'totalFine'));
    }



}
