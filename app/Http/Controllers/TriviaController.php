<?php

namespace App\Http\Controllers;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Models\SearchHistory;

class TriviaController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'full_name' => 'required|string|max:255',
                'email' => 'required|email',
                'number_of_questions' => 'required|integer|max:49',
                'difficulty' => 'required|string|max:255',
                'type' => 'required|string|max:255',
            ]);
            SearchHistory::createSearchHistory($validatedData);
            return response()->json(['message' => 'new history record created'], 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->validator->errors()], 422);
        }
    }
}
