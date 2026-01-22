<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use App\Models\AnimalRecord;


use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function index(){
        $clientId = Auth::user()->id; 
        $complaints = Complaint::where('client_id', $clientId)->get();
        $pendingComplaints = Complaint::where('complaint_status', 'pending')->get();
        $animalRecords = AnimalRecord::where('rescuer_id', Auth::id())->get();
        return view('dashboard', ['complaints' => $complaints, 'complaints' => $pendingComplaints, 'animalRecords' => $animalRecords]);
    }
    
    public function addComplaint(Request $request)    {
        $request->validate([
            'location' => 'required',
            'description' => 'required',
        ]);

        Complaint::create([
            'client_id' => Auth::users()->id, 
            'complaint_location' => $request->input('location'),
            'complaint_description' => $request->input('description'),
            'complaint_status' => 'pending', 
        ]);

        return redirect()->route('dashboard')->with('success', 'Complaint added successfully!');
    }


}
