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
        @auth
            <span class="text-white">Hello, {{ Auth::user()->name }}</span>
            <span>Hello</span>
        @else
            <span class="text-black">Hello, Guest</span>
        @endauth
         <!-- Search Bar -->
        <form method="GET" action="{{ route('forum.index') }}" class="mb-4"
            style="border: 1px solid #058789; padding: 8px; border-radius: 8px;">
            <input type="text" name="search" placeholder="Search threads..." class="form-control"
                style="border: none; outline: none;">
        </form>

        <!-- Create Thread Button -->
        <button type="button" class="btn" style="background-color: #058789; color: white; float: right;"
            data-bs-toggle="modal" data-bs-target="#createThreadModal">
            Create Thread
        </button>


        <!-- Modal for Create Thread -->
        <div class="modal fade" id="createThreadModal" tabindex="-1" aria-labelledby="createThreadModalLabel"
            aria-hidden="true">
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
            <div class="card mb-3" style="border: 1px solid #058789;">

                <div class="card-body">
                    <div class="flex flex-col md:flex-row items-center md:items-start gap-4">

                        <!-- Thread Details -->
                        <div style="display: flex; flex-direction: column; gap: 4px;">
                            <!-- Thread Title -->
                            <strong style="font-size: 1.125rem; font-weight: 600;">{{ $thread->title }}</strong>
                            <!-- User Profile Picture -->
                            <div class="w-16 h-16 rounded-full overflow-hidden">
                                <img src="{{ asset('images/profile-placeholder.png') }}"
                                    alt="Foto Profile{{ $thread->username }}" class="w-full h-full object-cover">
                            </div>
                            <!-- Username and Date -->
                            <small style="color: #6B7280;">by {{ $thread->username }} on
                                {{ $thread->created_at->format('d M Y H:i') }}</small>

                            <!-- Thread Text -->
                            <p style="margin-top: 8px; color: #374151;">{{ $thread->text }}</p>
                        </div>
                    </div>


                    <!-- Toggle Replies Button -->
                    <div class="d-flex justify-content-between align-items-center">
                        <!-- "100 replies" text stays on the left -->
                        <p class="mb-0">{{ $thread->replies->count() }} replies</p>

                        <!-- Buttons aligned to the right -->
                        <div class="d-flex gap-2">
                            <button class="btn btn-outline-warning like-btn" data-id="{{ $thread->id }}">
                                <i class="bi bi-star-fill"></i>
                                <span id="likes-count-{{ $thread->id }}">{{ $thread->likes_count }}</span> Likes
                            </button>
                            <button class="btn btn-outline-primary toggle-replies-btn" data-id="{{ $thread->id }}">
                                Reply
                            </button>
                        </div>
                    </div>

                    <!-- Like Button -->


                    <!-- Replies Section (Initially Hidden) -->
                    <div id="replies-{{ $thread->id }}" class="replies-section mt-3 d-none">
                        <h6>Replies:</h6>

                        @foreach ($thread->replies as $reply)
                            <div class="mb-2">
                                <strong>{{ $reply->username }}:</strong>
                                {{ $reply->text }}
                                <small class="text-muted">at {{ $reply->created_at->format('d M Y H:i') }}</small>
                            </div>
                        @endforeach

                        <!-- Reply Form -->
                        <form method="POST" action="{{ route('forum.reply', $thread->id) }}" class="mt-3">
                            @csrf
                            <div class="mb-2">
                                <input type="text" name="username" placeholder="Your name" class="form-control"
                                    required>
                            </div>
                            <div class="mb-2">
                                <textarea name="text" placeholder="Write a reply..." class="form-control" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-success">Reply</button>
                        </form>
                    </div>


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
                            document.getElementById(`likes-count-${threadId}`).textContent =
                                result.likes_count;
                        }
                    } catch (error) {
                        console.error('Error liking the thread:', error);
                    }
                });
            });
        });
    </script>
    <!-- Toggle Replies -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButtons = document.querySelectorAll('.toggle-replies-btn');

            toggleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const threadId = this.getAttribute('data-id');
                    const repliesSection = document.getElementById(`replies-${threadId}`);

                    // Toggle the visibility
                    repliesSection.classList.toggle('d-none');
                });
            });
        });
    </script>

</body>

</html>
