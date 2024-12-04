<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return response("Hello World");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("layouts.itemCreate", [
            "categories" => Category::latest()->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // Capitalize the first letter of the item name to maintain data consistency
        $request->merge([
            'title' => ucfirst($request->title)
        ]);

        // Validation for empty fields
        $validated = $request->validate([
            "categoryId" => ["required"],
            "title" => ["required"],
            "description" => ["required"],
            "price" => ["required"],
            "quantity" => ["required"],
            "sku" => ["required"],
            "picture" => ["required"]
        ]);

        // Check if the item title already exists
        if (Item::where('title', $validated['title'])->exists()) {
            return back()
                ->withErrors(['title' => 'The item name already exists.'])
                ->withInput();
        }

        // Create a new item using ORM
        Item::create([
            'categoryId' => $validated['categoryId'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'quantity' => $validated['quantity'],
            'sku' => $validated['sku'],
            'picture' => $validated['picture']
        ]);

        // Redirect back to the create category page
        return redirect(route("items.index"))
            ->with('success', 'Item created successfully.')
            ->withInput();
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        //
    }
}
