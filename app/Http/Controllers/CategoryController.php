<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view("layouts.categories", [
            "categories" => Category::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("layouts.categoryCreate");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // Capitalize the first letter of the category name to maintain data consistency
        $request->merge([
            'categoryName' => ucfirst($request->categoryName)
        ]);

        // Validation for empty category name and unique category name
        $validated = $request->validate([
            "categoryName" => ["required", "unique:categories,categoryName"]
        ]);

        // Check if the category name already exists
        if (Category::where('name', $validated['categoryName'])->exists()) {
            return back()
                ->withErrors(['categoryName' => 'The category name already exists.'])
                ->withInput();
        }

        // Create a new category using ORM
        Category::create([
            'categoryName' => $validated['categoryName']
        ]);

        // Redirect back to the create category page
        return redirect(route("categories.index"))
            ->with('success', 'Category created successfully.')
            ->withInput();
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view("layouts.categoryEdit", [
            "category" => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        // Capitalize the first letter of the category name to maintain data consistency
        $request->merge([
            'categoryName' => ucfirst($request->categoryName)
        ]);

        // Validation for empty category name and unique category name
        $validated = $request->validate([
            "categoryName" => ["required", "unique:categories,categoryName"]
        ]);

        // Check if the category name already exists
        if (Category::where('name', $validated['categoryName'])->exists()) {
            return back()
                ->withErrors(['categoryName' => 'The category name already exists.'])
                ->withInput();
        }

        // Update the category using ORM
        $category->update([
            'categoryName' => $validated['categoryName']
        ]);

        // Redirect back to the edit category page
        return redirect(route("categories.index"))
            ->with('success', 'Category updated successfully.')
            ->withInput();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {

    }
}
