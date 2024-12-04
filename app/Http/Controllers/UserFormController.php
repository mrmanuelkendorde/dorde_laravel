<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Make sure to include the User model
use Illuminate\validation\Rules;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserFormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user-form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input fields
        $validated = $request->validate([
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);
    
        // Handle profile picture upload if present
        if ($request->hasFile('profile')) {
            $profilePath = $request->file('profile')->store('profiles', 'public');
            $validated['profile'] = $profilePath;
        }
    
        // Hash the password before saving to the database
        $validated['password'] = bcrypt($request->password);
    
        // Save the user data to the database using the User model
        User::create($validated);
    
        // Redirect to the user list with a success message
        return redirect()->route('users')->with('success', 'User created successfully.');
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
    public function edit(string $id)
    {
        $user = User::find($id);

        return view('user-form', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{   
    $user = User::find($id);

    $validate = $request->validate([
        'name' => 'required',
        'email' => 'required|unique:users,email,' . $id . ',id',
        'password' => 'nullable|confirmed|min:8',
        'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->filled('password')) {
        $user->password = Hash::make($validate['password']);
    } else {
        unset($validate['password']);
    }

    if ($request->hasFile('profile')) {
        $profilePath = $request->file('profile')->store('profiles', 'public');
        $validate['profile'] = $profilePath;
    }

    if ($user->update($validate)) {
        return redirect()->route('users')->with('message', 'User saved successfully.');
    } else {
        return redirect()->route('users')->with('message', 'Unable to update user.');
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->is_deleted = 1;

        if ($user->save()) {
            return redirect()->route('users')->with('message', 'Your profile has been deleted successfully.');
        }
        
        return redirect()->route('users')->with('message', 'Your profile failed to delete.');
    }
}    