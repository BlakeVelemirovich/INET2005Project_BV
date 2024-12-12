<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Item</title>
    <link rel="stylesheet" href="{{ asset('css/items.css') }}">
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const deleteButtons = document.querySelectorAll('.delete');

            deleteButtons.forEach(button => {
                button.addEventListener('click', (event) => {
                    const confirmed = confirm('Are you sure you want to delete this item?');
                    if (!confirmed) {
                        // Prevent the form from being submitted
                        event.preventDefault();
                    }
                });
            });
        });
    </script>
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
                        <form action="{{ route('items.edit', $item->id) }}" method="GET" style="display:inline;">
                            @csrf
                            @method('GET')
                            <button type="submit" class="edit">Edit</button>
                        </form>
                        <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete">Delete</button>
                        </form>
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

