<?php

namespace App\Http\Controllers;

use App\Models\UserData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    /**
     * Summary of userProfile
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function userProfile()
    {
        // Fetch user profile data from the database based on the user's ID
        $userId = session()->get('user_id');
        $user = UserData::find($userId);
        return view('profile', compact('user'));
    }

    /**
     * Summary of profile img upload
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uploadimg(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);
        // Get the file from the request
        $profileImage = $request->file('profile_image');
        // Generate a unique name for the file
        $imageName = $profileImage->getClientOriginalName();
        // Move the uploaded file to the storage location
        $profileImage->move('images', $imageName);
        // Update user's profile image in the database
        $userId = session()->get('user_id');
        $user = UserData::find($userId);
        $user->profile_image = $imageName;
        $user->save();
        // Redirect back or wherever you want
        return redirect()->back()->with('status', 'Profile image uploaded successfully.');
    }
}
