<?php

namespace App\Http\Controllers;

use App\Models\UserData;
use Illuminate\Http\Request;

/**
 * Summary of AuthController
 */
class AuthController extends Controller
{
    /**
     * Display the registration form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */ 
    public function showregisterForm()
    {
        return view('register');
    }

    /**
     * Show the login form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('login');
    }

    /**
     * Handle the registration form submission.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function registerCreate(Request $request)
    {
        // Validate the user data
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'contact' => 'required',
            'password' => 'required|min:6',
        ]);

        if (UserData::where('email', $request->email)->exists()) {
            return redirect()->back()->with('status', 'This email is already registered..');
        }

        // Create a new user data instance
        $user = new UserData();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->contact = $request->contact;
        $user->password = $request->password;
        $user->save();
        // Redirect to the registration page with a success message
        return redirect('login')->with('status', 'User created successfully.');
    }


    /**
     * Summary of loginCheck
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\RedirectResponse
     */
    public function loginCheck(Request $request)
    {
        // Get the email and password from the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        // Check if the user exists in the database
        $user = UserData::where('email', $request->email)->where('password', $request->password)->first();
        if ($user) {
            $username = $user->first_name;
            $request->session()->put('user_id', $user->id);
            $request->session()->put('user_name', $username);
            return redirect('/')->with('status', 'Login successful.');
        } else {
            return redirect('login')->with('status', 'please enter correct detail.');
        }
    }

    /**
     * Summary of logout
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        // Remove the session variables, then redirect to the login page
        $request->session()->forget('user_id');
        $request->session()->forget('user_name');
        return redirect('login')->with('status', 'Logout successful.');
    }

    /**
     * Summary of user account delete
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteAccount(Request $request, $id)
    {
        // Delete the user data from the database
        $userId = session()->get('user_id');
        UserData::destroy($userId);
        $request->session()->forget('user_id');
        $request->session()->forget('user_name');
        return redirect()->route('register')->with('status', 'Your account has been deleted successfully.');
    }

}
