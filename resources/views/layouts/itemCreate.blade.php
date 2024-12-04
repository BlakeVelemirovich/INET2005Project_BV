<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Item</title>
    <link rel="stylesheet" href="{{ asset('css/categories.css') }}">
</head>
<body>
    <form method="POST" action="{{ route('items.store') }}">
        @csrf
        <div class="formRow">
            <label for="category">Category:</label>
            <select name="categoryId" id="category">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->categoryName }}</option>
                @endforeach
            </select>
            @if($errors->has('category'))
                <div class="error">{{ $errors->first('category') }}</div>
            @endif
        </div>

        <div class="formRow">
            <label for="title">Title:</label>
            <input
                type="text"
                name="title"
                id="title"
                placeholder="Enter item title"
                value="{{ old('title') }}"
            >
            @if($errors->has('title'))
                <div class="error">{{ $errors->first('title') }}</div>
            @endif
        </div>

        <div class="formRow">
            <label for="description">Description:</label>
            <textarea
                name="description"
                id="description"
                placeholder="Enter item description"
            >{{ old('description') }}</textarea>
            @if($errors->has('description'))
                <div class="error">{{ $errors->first('description') }}</div>
            @endif
        </div>

        <div class="formRow">
            <label for="price">Price:</label>
            <input
                type="text"
                name="price"
                id="price"
                placeholder="Enter item price"
                value="{{ old('price') }}"
            >
            @if($errors->has('price'))
                <div class="error">{{ $errors->first('price') }}</div>
            @endif
        </div>

        <div class="formRow">
            <label for="quantity">Quantity:</label>
            <input
                type="text"
                name="quantity"
                id="quantity"
                placeholder="Enter item quantity"
                value="{{ old('quantity') }}"
            >
            @if($errors->has('quantity'))
                <div class="error">{{ $errors->first('quantity') }}</div>
            @endif
        </div>

        <div class="formRow">
            <label for="sku">SKU:</label>
            <input
                type="text"
                name="sku"
                id="sku"
                placeholder="Enter item SKU"
                value="{{ old('sku') }}"
            >
            @if($errors->has('sku'))
                <div class="error">{{ $errors->first('sku') }}</div>
            @endif
        </div>

        <div class="formRow">
            <label for="picture">Picture:</label>
            <input
                type="text"
                name="picture"
                id="picture"
                placeholder="Enter item picture URL"
                value="{{ old('picture') }}"
            >
            @if($errors->has('picture'))
                <div class="error">{{ $errors->first('picture') }}</div>
            @endif
        </div>

        <input type="submit" value="Submit Form" class="mt-5">
    </form>
</body>
</html>
