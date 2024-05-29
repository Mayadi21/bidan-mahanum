@extends('blog.layouts.main')

@section('content')

<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-8 pb-5">
            <h2 class="my-3 pb-3 border-bottom">{{ $post->title }}</h2>
            @if($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid" alt="">
            @else
                <img src="https://picsum.photos/seed/{{ $post->category }}/1200/400" class="img-fluid" alt="{{ $post->category->category_name }}">
            @endif
            <p class="text-secondary text-lg mt-3">
                By <a href="/user/{{ $post->user->username }}" class="text-decoration-none">{{ $post->user->name }}</a> 
                @if($post->user->role == 'admin') <span class="badge text-bg-success">Admin</span> @endif
                in <a href="/categories/{{ $post->category->category_slug }}" class="text-decoration-none">{{ $post->category->category_name }}</a>
            </p>

            @auth
            <!-- Button trigger modal -->
            <button type="button" class="btn mb-3" data-bs-toggle="modal" data-bs-target="#reportModal">
                <i class="bi bi-flag-fill"></i><p class="d-inline text-secondary fs-6 ms-2">Report</p>
            </button>
            @endauth

            <!-- Modal -->
            <div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-3" id="reportModalLabel">Report Post</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('post.report', $post->slug) }}" method="post">
                                @method('PUT')
                                @csrf
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                @foreach($reports as $report)
                                <div class="form-check">
                                    <input class="form-check-input align-self-center" type="radio" name="report_id" id="report_id{{ $report->id }}" value="{{ $report->id }}" {{ $loop->first ? 'checked' : '' }}>
                                    <label class="form-check-label" for="report_id{{ $report->id }}">
                                        <div>
                                            <h5>{{ $report->report_name }}</h5>
                                            <p>{{ $report->report_description }}</p>
                                        </div>
                                    </label>
                                </div>
                                @endforeach
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-warning">Hide</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            {!! $post->body !!}
            <a href="/posts" class="text-decoration-none">Back to Blog</a>
        </div>

        <div class="col-md-8">
            <h3 class="my-3 pb-3 border-bottom">Comments</h3>

            @auth
                <form action="{{ route('comment.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <textarea class="form-control" name="body" id="comment" rows="4" placeholder="Enter your comment"></textarea>
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>
            @else
                <div class="alert text-center p-5">
                    <h5>Please <a href="/login" class="text-decoration-none">login</a> to add comment</h5>
                </div>
            @endauth

            <div id="commentList" class="mt-3">
                @if($comments->isEmpty())
                    <div class="container vertical-center">
                        <div class="row justify-content-center">
                            <div class="col-md-6 text-center">
                                <p class="lead">No comments.</p>
                            </div>
                        </div>
                    </div>
                @endif
                {{-- Loop bagian ini --}}
                @foreach ($comments as $comment)
                    <div class="comment mb-3" id="{{ 'comment-'.$comment->id }}">
                        <div class="d-flex justify-content-between">
                            <div>
                                <a href="/user/{{ $comment->user->username }}" class="text-decoration-none text-dark">
                                    <strong>
                                        {{ '@'.$comment->user->username }}
                                        @if ($comment->user_id === auth()->id())
                                        (you) @endif
                                    </strong>
                                    @if($comment->user->role == 'admin') <span class="badge text-bg-success">Admin</span> @endif
                                </a>
                                -
                                <small>{{ $comment->created_at->diffForHumans() }}</small>
                            </div>
                            @if ($comment->user_id === auth()->id())
                                <form action="{{ route('comment.destroy', $comment->id) }}" method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn" onclick="return confirm('Apakah kamu ingin menghapus komentar ini?')">
                                        <i class="bi bi-trash" alt="Delete Comment"></i>
                                    </button>
                                </form>
                            @else
                                <!-- Button trigger modal -->
                                <button type="button" class="btn delete-form" data-bs-toggle="modal" data-bs-target="#commentReportModal{{ $comment->id }}">
                                    <i class="bi bi-flag-fill"></i>
                                </button>
                            @endif
                        </div>
                        <p>{{ $comment->body }}</p>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="commentReportModal{{ $comment->id }}" tabindex="-1" aria-labelledby="commentReportModalLabel{{ $comment->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="commentReportModalLabel{{ $comment->id }}">Report Comment</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('comment.report', $comment->id)}}" method="post">
                                            @csrf
                                            <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                            @foreach($reports as $report)
                                            <div class="form-check">
                                                <input class="form-check-input align-self-center" type="radio" name="report_id" id="report_id{{ $report->id }}" value="{{ $report->id }}" {{ $loop->first ? 'checked' : '' }}>
                                                <label class="form-check-label" for="report_id{{ $report->id }}">
                                                    <div>
                                                        <h5>{{ $report->report_name }}</h5>
                                                        <p>{{ $report->report_description }}</p>
                                                    </div>
                                                </label>
                                            </div>
                                            @endforeach
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Report</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>




<!-- Modal untuk pesan session -->
<div class="modal fade" id="sessionMessageModal" tabindex="-1" aria-labelledby="sessionMessageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sessionMessageModalLabel">Message</h5>
            </div>
            <div class="modal-body">
                {{ session('error') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function(){
        @if(session('error'))
            $('#sessionMessageModal').modal('show');
        @endif
    });
</script>

@endsection
