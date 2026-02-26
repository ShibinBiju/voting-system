<?php

namespace App\Http\Controllers;

use App\Models\Candidate;  
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function results()
{
    $candidates = Candidate::withCount('votes')->get();
    return view('admin.results', compact('candidates'));
}
}
