<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use App\Models\AnimalRecord; 
use App\Models\User; 
use Illuminate\Support\Facades\Auth;

class RescuerController extends Controller
{
   
   
    public function acceptComplaint($id)
    {

        $complaint = Complaint::findOrFail($id);

        $complaint->update(['complaint_status' => 'accepted']);


        return redirect()->route('dashboard')->with('success', 'Complaint accepted successfully!');
    }

    public function rejectComplaint($id)
    {

        $complaint = Complaint::findOrFail($id);
        $complaint->update(['complaint_status' => 'rejected']);

        return redirect()->route('dashboard')->with('success', 'Complaint rejected successfully!');
    }


    public function addAnimalRecord(Request $request)
    {
        
        $request->validate([
            'rescuer_name' => 'required|string|max:255',
            'animal_species' => 'required|string|max:255',
            'date' => 'required|date',
            'medical_condition' => 'required|string|max:255',
        ]);
    
       
        $rescuer = Auth::user()->rescuer;
    
       
        AnimalRecord::create([
            'rescuer_id' => $rescuer->id,
            'rescuer_name' => $request->input('rescuer_name'),
            'animal_species' => $request->input('animal_species'),
            'date' => $request->input('date'),
            'medical_condition' => $request->input('medical_condition'),
            'record_status' => 'pending', 
        ]);
    
    
        return redirect()->back()->with('success', 'Animal record added successfully!');
    }
    
}
