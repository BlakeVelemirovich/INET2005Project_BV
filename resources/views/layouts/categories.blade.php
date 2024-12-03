<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Categories</title>
    <link rel="stylesheet" href="{{ asset('css/categories.css') }}">
</head>
<body>
    <!-- Display all categories using Blade's foreach command -->
<form method="POST" action="{{ route('categories.store') }}">
    <legend>
        <h2>Listing of Category Names</h2>
    </legend>
    <!-- All categories with an edit button next to them -->
    @foreach($categories as $category)
    <div class="formRow categoryListing">
        <label for="categoryName">{{ $category->categoryName }}</label>
        <a href="{{ url('/categories/' . $category->id . '/edit') }}" class="edit">Edit</a>
    </div>
    @endforeach
    <!-- Create a new category button -->
    <div class="formRow">
        <a href="{{ route('categories.create') }}" class="createCategory">Create New Category</a>
    </div>
</form>
</body>
</html>
