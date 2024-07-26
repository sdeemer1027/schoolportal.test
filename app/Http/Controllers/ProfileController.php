<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\School;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {

        $user = $request->user();
        $userZip = $user->zip; // Get the user's ZIP code

        // Check if the user's ZIP code is not null
        if (!empty($userZip)) {
            // Query to retrieve schools within 25 miles of the user's ZIP code
// Assuming you have the user's latitude and longitude in $userLatitude and $userLongitude
$zipinfo= DB::table('zipcodes')->where('zip',$userZip)->first();

            $userLatitude=$zipinfo->lat;
            $userLongitude=$zipinfo->lng;
  //          dd($userZip,$userLatitude,$userLongitude,$zipinfo);


// Query to retrieve schools within 25 miles of the user's location
            $schoolsWithin25Miles = DB::table('schools')
                ->select('schools.id', 'schools.name', 'schools.address', 'schools.city', 'schools.state', 'schools.zip')
                ->join('zipcodes', 'schools.zip', '=', 'zipcodes.zip')
                ->whereRaw("
        3959 * ACOS(
            SIN(RADIANS(zipcodes.lat)) * SIN(RADIANS(?))
            + COS(RADIANS(zipcodes.lat)) * COS(RADIANS(?))
            * COS(RADIANS(zipcodes.lng - ?))
        ) <= 25", [$userLatitude, $userLatitude, $userLongitude])
                ->get();

// Dump the results to inspect
   //         dd($schoolsWithin25Miles);

            $uniqueStates = School::distinct()->pluck('state');

            return view('profile.edit', [
                'user' => $user,
                'uniqueStates' => $uniqueStates,
                'schoolsWithin25Miles' => $schoolsWithin25Miles,
            ]);
        }


        $uniqueStates = School::distinct()->pluck('state');

//dd($uniqueStates);
        return view('profile.edit', [
            'user' => $request->user(),
            'uniqueStates' => $uniqueStates, // Pass the unique states as a parameter

        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {

        




$request->validate([
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            // Other validation rules
        ]);

        $user = Auth::user();

        if ($request->hasFile('profile_picture')) {
            // Delete old profile picture if it exists
            if ($user->profile_picture) {
                Storage::delete('public/profile_pictures/' . $user->profile_picture);
            }

            // Store the new profile picture
            $file = $request->file('profile_picture');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/profile_pictures', $filename);

            // Update user profile picture in the database
            $user->profile_picture = $filename;
            $user->save();
        }








        $user = $request->user();














        // Update the user's zip attribute
        $user->zip = $request->input('zip');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->address2 = $request->input('address2');
        $user->city = $request->input('city');
        $user->state = $request->input('state');


        $request->user()->fill($request->validated());

















 //       dd($request);

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }


        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
