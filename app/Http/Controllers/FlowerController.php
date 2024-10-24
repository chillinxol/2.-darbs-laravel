<?php

namespace App\Http\Controllers;

use App\Models\Flower;
use Illuminate\Http\Request;

class FlowerController extends Controller
{
    public function index()
    {
        $flowers = Flower::all();
        return view('home', compact('flowers')); // Use home instead of flowers.index
    }

    public function create()
    {
        return view('create'); // Adjust this to match your file structure
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric'
        ]);

        // Create a new flower in the database
        Flower::create($validated);

        return redirect()->route('home')->with('success', 'Flower added successfully!'); // Redirect to home
    }

    public function edit(Flower $flower)
    {
        return view('edit', compact('flower')); // Adjust if needed
    }

    public function update(Request $request, Flower $flower)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric'
        ]);

        $flower->update($validated);

        return redirect()->route('home')->with('success', 'Flower updated successfully!'); // Redirect to home
    }

    public function destroy(Flower $flower)
    {
        $flower->delete();
        return redirect()->route('home')->with('success', 'Flower deleted successfully!'); // Redirect to home
    }
}
