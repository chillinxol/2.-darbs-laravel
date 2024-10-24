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
        return view('create'); 
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric'
        ]);
        Flower::create($validated);

        return redirect()->route('home')->with('success', 'Flower added successfully!'); 
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
