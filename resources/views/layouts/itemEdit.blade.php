<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Item</title>
    <link rel="stylesheet" href="{{ asset('css/categories.css') }}">
</head>
<body>
    <form method="POST" action="{{ route('items.update', ['item' => $item->id])  }}" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Ensures the HTTP method is PUT -->
        <legend>
            <h2>Edit Item: <b style="color: red;"> {{ $item->title }}</b></h2>
        </legend>

        <div class="formRow">
            <label for="categoryId">Category:</label>
            <select name="categoryId" id="categoryId">
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->categoryName }}</option>
                @endforeach
            </select>
        </div>

        <div class="formRow">
            <label for="title">Item Name:</label>
            <input
                type="text"
                name="title"
                id="title"
                placeholder="Enter item name"
                value="{{ old('title') }}"
            >
            @if($errors->has('title'))
            <div class="error">{{ $errors->first('title') }}</div>
            @endif
        </div>

        <div class="formRow">
            <label for="description">Description</label>
            <input
                type="text"
                name="description"
                id="description"
                placeholder="Enter description"
                value="{{ old('description') }}"
            >
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
                placeholder="Enter the price"
                value="{{ old('price') }}"
            >
            @if($errors->has('price'))
            <div class="error">{{ $errors->first('price') }}</div>
            @endif
        </div>

        <div class="formRow">
            <label for="sku">Sku:</label>
            <input
                type="text"
                name="sku"
                id="sku"
                placeholder="Enter sku"
                value="{{ old('sku') }}"
            >
            @if($errors->has('sku'))
            <div class="error">{{ $errors->first('sku') }}</div>
            @endif
        </div>

        <div class="formRow">
            <label for="quantity">Quantity:</label>
            <input
            type="number"
            name="quantity"
            id="quantity"
            placeholder="Enter quantity"
            value="{{ old('quantity') }}"
            min="0"
            >
            @if($errors->has('quantity'))
            <div class="error">{{ $errors->first('quantity') }}</div>
            @endif
        </div>

        <div class="formRow">
            <label for="picture">image:</label>
            <input type="file" name="picture" id="picture">
        </div>

        <input type="submit" value="Submit Form" class="mt-5">
    </form>
</body>
</html>
