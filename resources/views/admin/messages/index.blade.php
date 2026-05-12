@extends('admin.layouts.app')

@section('title', 'Contact Messages')
@section('header', 'Contact Messages')

@section('content')
<div class="table-card">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">All Contact Messages</h5>
    </div>
    
    <div class="table-responsive">
        <table class="table table-bordered table-hover" id="messagesTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($messages as $message)
                <tr>
                    <td>{{ $message->id }}</td>
                    <td>{{ $message->name }}</td>
                    <td>{{ $message->email }}</td>
                    <td>{{ Str::limit($message->message, 50) }}</td>
                    <td>
                        @if(!$message->is_read)
                            <span class="badge bg-danger">Unread</span>
                        @else
                            <span class="badge bg-success">Read</span>
                        @endif
                    </td>
                    <td>{{ $message->created_at->format('M d, Y h:i A') }}</td>
                    <td>
                        <a href="{{ route('admin.messages.show', $message->id) }}" class="btn btn-sm btn-info">
                            <i class="fas fa-eye"></i> View
                        </a>
                        <button class="btn btn-sm btn-danger delete-message" data-id="{{ $message->id }}" data-name="{{ $message->name }}">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="mt-3">
        {{ $messages->links() }}
    </div>
</div>

<form id="deleteForm" action="" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#messagesTable').DataTable({
            responsive: true,
            pageLength: 10,
            order: [[0, 'desc']],
            language: {
                search: "Search:",
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ entries"
            }
        });
    });
    

</script>
@endpush
@endsection