<?php

namespace App\Http\Controllers;

use App\Models\Flower;
use Illuminate\Http\Request;

class FlowerController extends Controller
{
    public function index()
    {
        $flowers = Flower::all();
        return view('flowers.index', compact('flowers'));
    }

    public function create()
    {
        return view('flowers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric'
        ]);

        Flower::create($validated);

        return redirect()->route('flowers.index')->with('success', 'Flower added successfully!');
    }

    public function edit(Flower $flower)
    {
        return view('flowers.edit', compact('flower'));
    }

    public function update(Request $request, Flower $flower)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric'
        ]);

        $flower->update($validated);

        return redirect()->route('flowers.index')->with('success', 'Flower updated successfully!');
    }

    public function destroy(Flower $flower)
    {
        $flower->delete();
        return redirect()->route('flowers.index')->with('success', 'Flower deleted successfully!');
    }
}
