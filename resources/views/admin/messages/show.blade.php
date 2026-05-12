@extends('admin.layouts.app')

@section('title', 'Message Details')
@section('header', 'Message from ' . $message->name)

@section('content')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="table-card">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Message Details</h5>
                    <span class="badge bg-{{ !$message->is_read ? 'danger' : 'success' }}">
                        {{ !$message->is_read ? 'Unread' : 'Read' }}
                    </span>
                </div>

                <table class="table table-borderless">
                    <tr>
                        <th width="150">Sender Name:</th>
                        <td>{{ $message->name }}</td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td>{{ $message->email }}</td>
                    </tr>
                    <tr>
                        <th>Sent Date:</th>
                        <td>{{ $message->created_at->format('F d, Y h:i A') }}</td>
                    </tr>
                    <tr>
                        <th>Message:</th>
                        <td>
                            <div class="p-3 bg-light rounded">
                                {{ nl2br($message->message) }}
                            </div>
                        </td>
                    </tr>
                </table>

                <div class="mt-3">
                    <a href="mailto:{{ $message->email }}" class="btn btn-primary">
                        <i class="fas fa-reply"></i> Reply via Email
                    </a>
                    <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Messages
                    </a>
                    <button class="btn btn-danger float-end delete-message" data-id="{{ $message->id }}">
                        <i class="fas fa-trash"></i> Delete Message
                    </button>
                </div>
            </div>
        </div>
    </div>

    <form id="deleteForm" action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    @push('scripts')
        <script>
            document.querySelector('.delete-message')?.addEventListener('click', function () {
                if (confirm('Are you sure you want to delete this message?')) {
                    document.getElementById('deleteForm').submit();
                }
            });
        </script>
    @endpush
@endsection