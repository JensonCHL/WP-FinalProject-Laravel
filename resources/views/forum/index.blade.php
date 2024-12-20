<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forum</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">

    <!-- Search Bar -->
    <form method="GET" action="{{ route('forum.index') }}" class="mb-4">
        <input type="text" name="search" placeholder="Search threads..." class="form-control">
    </form>

    <!-- Create Thread Button -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createThreadModal">
        Create Thread
    </button>

    <!-- Modal for Create Thread -->
    <div class="modal fade" id="createThreadModal" tabindex="-1" aria-labelledby="createThreadModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createThreadModalLabel">Create New Thread</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('forum.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="title" class="form-label">Thread Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="text" class="form-label">Content</label>
                            <textarea name="text" class="form-control" rows="5" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-success">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Display Threads -->
    <h3 class="mt-5">Forum Threads</h3>
    @foreach ($threads as $thread)
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <strong>{{ $thread->title }}</strong> by {{ $thread->username }}
                </div>

                <!-- Like Button -->
                <div>
                    <button class="btn btn-outline-warning like-btn" data-id="{{ $thread->id }}">
                        <i class="bi bi-star-fill"></i>
                        <span id="likes-count-{{ $thread->id }}">{{ $thread->likes_count }}</span>
                    </button>
                </div>
            </div>

            <div class="card-body">
                <p>{{ $thread->text }}</p>
                <small>Replies: {{ $thread->replies_count }}</small>
            </div>
        </div>
    @endforeach

</div>

<!-- Bootstrap JS & Icons -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>

<!-- AJAX for Like Button -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const likeButtons = document.querySelectorAll('.like-btn');

    likeButtons.forEach(button => {
        button.addEventListener('click', async () => {
            const threadId = button.dataset.id;

            try {
                const response = await fetch(`/forum/like/${threadId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                });

                if (response.ok) {
                    const result = await response.json();
                    document.getElementById(`likes-count-${threadId}`).textContent = result.likes_count;
                }
            } catch (error) {
                console.error('Error liking the thread:', error);
            }
        });
    });
});
</script>
</body>
</html>
