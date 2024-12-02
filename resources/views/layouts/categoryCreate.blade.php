<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Category</title>
    <link rel="stylesheet" href="{{ asset('css/categories.css') }}">
</head>
<body>
    <form method="POST" action="{{ route('categories.store') }}">
        @csrf
        <div class="formRow">
            <label for="categoryName">Category Name:</label>
            <input
                type="text"
                name="categoryName"
                id="categoryName"
                placeholder="Enter category name"
                value="{{ old('categoryName') }}"
            >
            @if($errors->has('categoryName'))
            <div class="error">{{ $errors->first('categoryName') }}</div>
            @endif
        </div>

        <input type="submit" value="Submit Form" class="mt-5">
    </form>
</body>
</html>
