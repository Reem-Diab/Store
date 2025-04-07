@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Your Categories</h2>
    <a href="{{ route('categories.create') }}" class="btn btn-success mb-3 float-end">Add New Category</a>

    @if($categories->count())
        <table class="table">
            <thead>
                <tr>
                    <th>#</th><th>Name</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Delete?')" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $categories->links() }}
    @else
        <p>No categories found.</p>
    @endif
</div>
@endsection
