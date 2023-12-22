@extends('admin/layout')
@section('page_title', 'Messages')
@section('messages_select', 'active')
@section('container')
    <style>
        .reply-form-container {
            display: none;
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">User Messages</strong>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Sender Name</th>
                                <th>Message</th>
                                <th>Admin Reply</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($userMessages as $message)
                                <tr class="@if($message->admin_reply) admin-reply @endif">
                                    <td>{{ $message->id }}</td>
                                    <td>{{ $message->sender_name }}</td>
                                    <td>{{ $message->message }}</td>
                                    <td>{{ $message->admin_reply ?? 'N/A' }}</td>
                                    <!-- Inside the <td> where the Reply button is located -->
                                    <td>
                                        @if(!$message->admin_reply)
                                            <button class="btn btn-sm btn-primary" onclick="toggleReplyForm({{ $message->id }})">Reply</button>
                                        @endif
                                        <div id="replyFormContainer_{{ $message->id }}" class="reply-form-container">
                                            <form action="{{ route('admin.submitAdminReply', ['messageId' => $message->id]) }}" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="reply_{{ $message->id }}">Reply:</label>
                                                    <input type="text" class="form-control" name="admin_reply" id="reply_{{ $message->id }}" required>
                                                </div>
                                                <button type="submit" class="btn btn-sm btn-success">Send Reply</button>
                                            </form>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleReplyForm(messageId) {
            var formContainer = document.getElementById('replyFormContainer_' + messageId);
            var replyButton = document.getElementById('replyButton_' + messageId);

            formContainer.style.display = formContainer.style.display === 'none' ? 'block' : 'none';
            replyButton.style.display = 'block'; // Ensure the reply button is always visible after the form is toggled
        }
    </script>
@endsection
