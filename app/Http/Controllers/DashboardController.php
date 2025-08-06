<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Lead;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $totalLeads = Lead::count();
            $leadsByStatus = Lead::select('status')
                ->selectRaw('count(*) as total')
                ->groupBy('status')
                ->get();

            return view('dashboard.admin', compact('totalLeads', 'leadsByStatus'));
        }

        // For Sales role
        $assignedLeads = Lead::where('assigned_to', $user->id)->get();

        return view('dashboard.sales', compact('assignedLeads'));
    }
}


























