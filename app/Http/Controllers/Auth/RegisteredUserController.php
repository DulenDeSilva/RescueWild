<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Client;  // Ensure the 'Client' model exists and is correctly named
use App\Models\Rescuer; // Ensure the 'Rescuer' model exists and is correctly named
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request){
         // Validate the request data
          
         /*  $request->validate([
            'name' => ['required'],
            'email' => ['required'], // Fixed validation
            'passwords' => ['required'], // Added password confirmation and rules
            'clients_address' => ['required'],
            'rescuer_location' => ['required'],
            'contact_number' => ['required'], // Assuming contact number is required
        ]);  */
    
        // Create the user in the 'users' table
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->passwords),
            'user_type' => $request->usertype,
            'contact_no' => $request->contact_number,
        ]);
    
        // Save address to appropriate table based on usertype
        if ($request->usertype === 'client') {
            // Save client address to 'clients' table
            client::create([
                'user_id' => $user->id, // Assuming user_id is the foreign key in the clients table
                'client_address' => $request->clients_address,
            ]);
        } elseif ($request->usertype === 'rescuer') {
            // Save rescuer location to 'rescuers' table
            rescuer::create([
                'user_id' => $user->id, // Assuming user_id is the foreign key in the rescuers table
                'rescuer_location' => $request->rescuer_location,
            ]);
        }
    
        // Trigger registered event
        event(new Registered($user));
    
        // Log in the user
        Auth::login($user);
    
        // Redirect to the appropriate dashboard (assuming 'dashboard' route exists)
        return view('auth.login');
    }
    
}
