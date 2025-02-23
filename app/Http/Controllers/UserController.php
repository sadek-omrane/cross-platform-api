<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //get query params
        $searchKey = $request->query('search');
        $users = User::where('id', '!=', Auth::id());
        if($searchKey) {
            $users->where('name', 'like', '%'.$searchKey.'%');
        }
        $users = $users->get();
        return $this->sendResponse($users, 'Users retrieved successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return $this->sendResponse($user, 'User retrieved successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'profile_image_id' => 'nullable',
            'cover_image_id' => 'nullable',
            'email' => 'required|email'
        ]);

        if($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors(), 400);
        }

        $user->update($request->all());

        return $this->sendResponse($user, 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return $this->sendResponse([], 'User deleted successfully');
    }

    /**
     * register user and return user and jwt token
     */
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ])->setCustomMessages([
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email is invalid',
            'email.unique' => 'Email is already taken',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 6 characters',
        ]);

        if($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors(), 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $token = Auth::login($user);

        return $this->sendResponse($token, 'User registered successfully');
    }

    /**
     * login user and return user and jwt token
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ])->setCustomMessages([
            'email.required' => 'Email is required',
            'email.email' => 'Email is invalid',
            'password.required' => 'Password is required',
        ]);

        if($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors(), 400);
        }

        $credentials = $request->only('email', 'password');

        if(!$token = Auth::attempt($credentials)) {
            return $this->sendError('Email or password is incorrect', [], 401);
        }

        return $this->sendResponse($token, 'User logged in successfully');
    }

    /**
     * logout user
     */
    public function logout(){
        Auth::logout();
        return $this->sendResponse( null, 'User logged out successfully');
    }

    /**
     * refresh jwt token
     */
    public function refresh(){
        return $this->sendResponse([
            'token' => Auth::refresh(),
        ], 'Token refreshed successfully');
    }

    /**
     * get authenticated user
     */
    public function me(){
        return $this->sendResponse(Auth::user(), 'User retrieved successfully');
    }

}
