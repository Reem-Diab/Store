@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Your Products</h2>
    <a href="{{ route('products.create') }}" class="btn btn-success float-end mb-3">Add New Product</a>

    @if($products->count())
        <table class="table">
            <thead>
                <tr>
                    <th>#</th><th>Name</th><th>Category</th><th>Price</th><th>Qty</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name ?? 'N/A' }}</td>
                    <td>${{ $product->price }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Delete?')" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $products->links() }}
    @else
        <p>No products found.</p>
    @endif
</div>
@endsection
