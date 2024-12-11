<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Item</title>
    <link rel="stylesheet" href="{{ asset('css/items.css') }}">
</head>
<body>
    <div class="container">
        <h2>Listing of Items</h2>
        <table class="itemTable">
            <thead>
                <tr>
                    <th>Category Name</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop through all items -->
                @foreach($items as $item)
                <tr>
                    <td>{{ $item->categoryName }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td><img src="{{ asset($item->picture) }}" alt="{{ $item->title }}" class="itemImage"></td>
                    <td>
                        <a href="{{ url('/items/' . $item->id . '/edit') }}" class="edit">Edit</a>
                        <a href="{{ url('/items/' . $item->id . '/delete') }}" class="delete">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Create a new item button -->
        <div class="formRow">
            <a href="{{ route('items.create') }}" class="createItem">Create New Item</a>
        </div>
    </div>
</body>
</html>
