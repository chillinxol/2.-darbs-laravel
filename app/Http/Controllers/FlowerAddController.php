<?php

namespace App\Http\Controllers;

use App\Models\Flower;
use Illuminate\Http\Request;

class FlowerAddController extends Controller
{
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
}
