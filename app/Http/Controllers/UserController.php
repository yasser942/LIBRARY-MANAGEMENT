<?php

namespace App\Http\Controllers;

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


    public function showRegisteredUsers (){

        $users = User::where('role', '!=', 'admin')->get();
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
            return redirect('/');
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

    public function adminDashboard(){
        return view('users.admin.dashboard');


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





}
