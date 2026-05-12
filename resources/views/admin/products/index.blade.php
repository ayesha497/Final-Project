@extends('admin.layouts.app')

@section('title', 'Products Management')
@section('header', 'Products Management')

@section('content')
    <div class="table-card">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">All Products</h5>
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Product
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="productsTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Brand</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Sizes</th>
                        <th>Color</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>
                                @if($product->images && count($product->images) > 0)
                                    <img src="{{ asset('storage/' . $product->images[0]) }}" width="50" height="50"
                                        style="object-fit: cover; border-radius: 5px;">
                                @else
                                    <img src="https://via.placeholder.com/50" width="50" height="50">
                                @endif
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->brand_name }}</td>
                            <td>{{ $product->category }}</td>
                            <td>${{ number_format($product->price, 2) }}</td>
                            <td>
                                @if(is_array($product->sizes) || is_object($product->sizes))
                                    @foreach($product->sizes as $size)
                                        <span class="badge bg-secondary">{{ $size }}</span>
                                    @endforeach
                                @else
                                    {{ $product->sizes }}
                                @endif
                            </td>
                            <td><span class="badge bg-info">{{ $product->color }}</span></td>
                            <td>
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $products->links() }}
        </div>
    </div>

    <form id="deleteForm" action="" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    @push('scripts')
        <script>
            $(document).ready(function () {
                if ($.fn.DataTable) {
                    $('#productsTable').DataTable({
                        responsive: true,
                        autoWidth: false,
                        pageLength: 10,
                        columnDefs: [
                            { orderable: false, targets: [1, 8] },
                            { searchable: false, targets: [1, 8] }
                        ],
                        language: {
                            search: "Search:",
                            lengthMenu: "Show _MENU_ entries",
                            info: "Showing _START_ to _END_ of _TOTAL_ entries",
                            emptyTable: "No products found. Use the Add New Product button to create one."
                        }
                    });
                }
            });

        </script>
    @endpush
@endsection