<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|string',
        ]);

        // Insertion dans la table 'feedbacks'
        $inserted = DB::table('feedbacks')->insert([
            'rating' => $request->rating,
            'page' => $request->page ?? 'home',
            'ip_address' => $request->ip(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($inserted) {
            return response()->json(['success' => true, 'message' => 'Feedback enregistré !']);
        }

        return response()->json(['success' => false], 500);
    }
}
