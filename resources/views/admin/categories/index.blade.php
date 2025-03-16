@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Categories List</h2>
        <a href="{{ route('categories.create') }}" class="btn btn-success">Add New Categories</a>
    </div>

    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Category Name</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr id="category-{{ $category->id }}">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $category->name }}</td>
                <td class="d-flex">

                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-primary me-2">Edit</a>

                  
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
