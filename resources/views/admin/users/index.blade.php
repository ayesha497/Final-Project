@extends('admin.layouts.app')

@section('title', 'Users Management')
@section('header', 'Users Management')

@section('content')
<div class="table-card">
    <h5 class="fw-bold mb-4" style="color: #1A0B2E;">
        <i class="fas fa-users me-2" style="color: #6B46C1;"></i>All Registered Users
    </h5>
    
    <div class="table-responsive">
        <table class="table table-hover" id="usersTable">
            <thead style="background: #FAF5FF;">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Orders</th>
                    <th>Registered</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td class="fw-semibold">{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td><span class="badge" style="background: #FAF5FF; color: #6B46C1;">{{ $user->orders_count ?? 0 }} Orders</span></td>
                    <td>{{ $user->created_at->format('M d, Y') }}</td>
                    <td>
                        <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-sm btn-info me-1" style="border-radius: 10px;">
                            <i class="fas fa-eye"></i>
                        </a>
                        <button class="btn btn-sm btn-danger delete-user" data-id="{{ $user->id }}" data-name="{{ $user->name }}" style="border-radius: 10px;">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="mt-3">
        {{ $users->links() }}
    </div>
</div>

<form id="deleteForm" action="" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#usersTable').DataTable({
            responsive: true,
            pageLength: 10,
            order: [[0, 'desc']],
            language: {
                search: "Search users:",
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ users"
            }
        });
    });
    
  
</script>
@endpush
@endsection