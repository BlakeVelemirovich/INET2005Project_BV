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
    public function index()
    {
        // Get all items
        $items = Item::latest()->get();
        // Get matching category name
        $items->map(function ($item) {
            $item->categoryName = Category::find($item->categoryId)->categoryName;
        });

        return view("layouts.items", [
            "items" => $items,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get all categories, as we will need them for an option dropdown to select category
        $categories = Category::latest()->get();

        return view("layouts.itemCreate", [
            "categories" => $categories
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
            "picture" => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Check if the item title already exists
        if (Item::where('title', $validated['title'])->exists()) {
            return back()
                ->withErrors(['title' => 'The item name already exists.'])
                ->withInput();
        }

        // Store the image in the public folder
        $request->picture->move(public_path('images'), $request->picture->getClientOriginalName());
        $imagePath = "images/" . $request->picture->getClientOriginalName();

        // Create a new item using ORM
        Item::create([
            'categoryId' => $request->categoryId,
            'title' => $request['title'],
            'description' => $request['description'],
            'price' => $request['price'],
            'quantity' => $request['quantity'],
            'sku' => $request['sku'],
            'picture' => $imagePath
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
        // Get all categories, as we will need them for an option dropdown to select category
        $categories = Category::latest()->get();

        return view("layouts.itemEdit", [
            "categories" => $categories,
            "item" => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item): RedirectResponse
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
            "picture" => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Check if the item title already exists
        if (Item::where('title', $validated['title'])->exists()) {
            return back()
                ->withErrors(['title' => 'The item name already exists.'])
                ->withInput();
        }

        // Store the image in the public folder
        $request->picture->move(public_path('images'), $request->picture->getClientOriginalName());
        $imagePath = "images/" . $request->picture->getClientOriginalName();

        // Update the item using ORM
        $item->update([
            'categoryId' => $request->categoryId,
            'title' => $request['title'],
            'description' => $request['description'],
            'price' => $request['price'],
            'quantity' => $request['quantity'],
            'sku' => $request['sku'],
            'picture' => $imagePath
        ]);

        // Redirect back to the items page
        return redirect(route("items.index"))
            ->with('success', 'Item created successfully.')
            ->withInput();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        // Make sure to delete the image from the images folder before deletion
        $imagePath = public_path($item->picture);
        if (file_exists($imagePath))
            unlink($imagePath);

        // Delete the item
        $item->delete();

        // Redirect back to the items page
        return redirect(route("items.index"))
            ->with('success', 'Item deleted successfully.');
    }
}
