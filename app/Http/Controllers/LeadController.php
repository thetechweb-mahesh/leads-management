<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
   
  
  public function index(Request $request)
{

    
    $user = Auth::user();
    $query = Lead::query();

      // Filters
    if ($request->filled('search')) {
        $query->where(function($q) use ($request) {
            $q->where('name', 'like', "%{$request->search}%")
              ->orWhere('email', 'like', "%{$request->search}%");
        });
    }

    if ($user->role === 'sales') {
        $query->where('assigned_to', $user->id);
    }

    if ($request->has('status')) {
        $query->where('status', $request->status);
    }

    if ($request->has('lead_source')) {
        $query->where('lead_source', $request->lead_source);
    }

    $leads = $query->latest()->paginate(10);


    if ($request->ajax()) {
       
       return response()->json([
       'html' => view('leads.partials.table', compact('leads'))->render()
      ]);

       
    }

    return view('leads.index', compact('leads'));
 
}

// store create
public function create()
{  
    if (Auth::user()->role !== 'admin') {
        abort(403);
    }

    $salesUsers = User::where('role', 'sales')->get();
    $roles = ['admin', 'sales']; // Add available roles here

    return view('leads.create', compact('salesUsers', 'roles'));
}





// store lead
public function store(Request $request)
{
    if (Auth::user()->role !== 'admin') {
        abort(403);
    }

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'required|string|max:20',
        'lead_source' => 'required|string',
        'status' => 'required|in:New,Contacted,Converted,Lost',
        'assigned_to' => 'nullable|exists:users,id',
        'remarks' => 'nullable|string',
    ]);

    Lead::create($validated);

    return redirect()->route('leads.index')->with('success', 'Lead created successfully.');
}

// show
public function show(Lead $lead)
{
    $user = Auth::user();

    if ($user->role === 'sales' && $lead->assigned_to !== $user->id) {
        abort(403);
    }

    return view('leads.show', compact('lead'));
}

// edit
public function edit(Lead $lead)
{
    $user = Auth::user();

    if ($user->role === 'sales' && $lead->assigned_to !== $user->id) {
        abort(403);
    }
  
    $salesUsers = $user->role === 'admin' ? User::where('role', 'sales')->get() : [];

    return view('leads.edit', compact('lead', 'salesUsers'));
}




public function update(Request $request, Lead $lead)
{
    $user = Auth::user();

    if ($user->role === 'sales' && $lead->assigned_to !== $user->id) {
        abort(403);
    }

    $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'required|string|max:20',
        'lead_source' => 'required|string',
        'status' => 'required|in:New,Contacted,Converted,Lost',
        'remarks' => 'nullable|string',
    ];

    // Only admin  change assigned_to
    if ($user->role === 'admin') {
        $rules['assigned_to'] = 'nullable|exists:users,id';
    }

    $validated = $request->validate($rules);

    $lead->update($validated);

    return redirect()->route('leads.index')->with('success', 'Lead updated successfully.');
}


public function destroy(Lead $lead)
{
    if (Auth::user()->role !== 'admin') {
        abort(403);
    }

    $lead->delete();

    return redirect()->route('leads.index')->with('success', 'Lead deleted successfully.');
}






public function export()
{
    $fileName = 'leads.csv';
    $leads = Lead::all();

    $headers = [
        "Content-type"        => "text/csv",
        "Content-Disposition" => "attachment; filename=$fileName",
        "Pragma"              => "no-cache",
        "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
        "Expires"             => "0"
    ];

    $columns = ['ID', 'Name', 'Email', 'Phone', 'Status', 'Lead Source', 'Assigned To'];

    $callback = function() use ($leads, $columns) {
        $file = fopen('php://output', 'w');
        fputcsv($file, $columns);

        foreach ($leads as $lead) {
            fputcsv($file, [
                $lead->id,
                $lead->name,
                $lead->email,
                $lead->phone,
                $lead->status,
                $lead->lead_source,
                optional($lead->user)->name
            ]);
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}




}


















































































