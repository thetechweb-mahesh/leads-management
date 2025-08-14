<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lead;

class frontendController extends Controller
{
    public function index(){
    // 
        return view('frontend.leadform');
    }

    // LeadController.php
public function storeFrontend(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'nullable|email|max:255',
        'phone' => 'required|string|max:20',
        'lead_source' => 'nullable|string|max:255',
        'comments' => 'nullable|string',
    ]);

    $validated['status'] = 'new';
    $validated['assigned_to'] = null; // unassigned

    Lead::create($validated);

    return back()->with('success', 'Your request has been submitted successfully!');
}

}
