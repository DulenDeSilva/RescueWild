<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Update the user's general info (email, name, etc.)
    $user = $request->user();
    $user->fill($request->validated());

    // If the user's email has changed, set email verification to null
    if ($user->isDirty('email')) {
        $user->email_verified_at = null;
    }

    $user->save(); // Save user basic info

    // Additional logic for client and rescuer
    if ($user->user_type === 'client') {
        // Check if client_address is being updated
        $request->validate([
            'client_address' => 'required|string|max:255',
        ]);

        // Update client address
        $user->client->update([
            'client_address' => $request->input('client_address'),
        ]);
    }

    if ($user->user_type === 'rescuer') {
        // Check if rescuer_location is being updated
        $request->validate([
            'rescuer_location' => 'required|string|max:255',
        ]);

        // Update rescuer location
        $user->rescuer->update([
            'rescuer_location' => $request->input('rescuer_location'),
        ]);
    }

    return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
