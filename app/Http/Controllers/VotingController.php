<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\Vote;

class VotingController extends Controller
{
    public function index()
    {
        $candidates = Candidate::all();
        return view('vote', compact('candidates'));
    }

    public function candidates()
    {
        $candidates = Candidate::withCount('votes')->get();
        return view('candidates', compact('candidates'));
    }

    public function store(Request $request)
    {
        $request->validate(['candidate_id' => 'required|exists:candidates,id']);

        if (auth()->user()->vote) {
            return back()->with('error', 'You have already voted!');
        }

        Vote::create([
            'user_id' => auth()->id(),
            'candidate_id' => $request->candidate_id
        ]);

        return back()->with('success', 'Vote submitted successfully!');
    }
}
