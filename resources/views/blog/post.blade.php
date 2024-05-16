@extends('blog.layouts.main')

@section('content')

{{-- KOLOM KOMENTAR DI BARIS 27 --}}

    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8 pb-5">
                <h2 class="my-3 pb-3 border-bottom">{{ $post->title }}</h2>
                @if($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid" alt="">
                @else
                    <img src="https://source.unsplash.com/1200x400?{{ $post->category->category_name }}" class="img-fluid" alt="{{ $post->category->category_name }}">
                @endif
                <p class="text-secondary text-lg mt-3">
                    By <a href="/user/{{ $post->user->username }}" class="text-decoration-none">{{ $post->user->name }}</a> 
                    in <a href="/categories/{{ $post->category->category_slug }}" class="text-decoration-none">{{ $post->category->category_name }}</a>
                </p>
                {!! $post->body !!}
                <a href="/posts" class="text-decoration-none">Back to Blog</a>
            </div>

            <div class="col-md-8">

                <h3 class="my-3 pb-3 border-bottom">Comments</h3>

                @auth
                    <form action="{{ route('comment.store', $post->slug) }}" method="post">
                        <textarea class="form-control" id="comment" rows="4" placeholder="Enter your comment"></textarea>
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                    </form>
                @else
                    <div class="alert text-center p-5">
                        <h5>Please <a href="/login" class="text-decoration-none">login</a> to add comment</h5>
                    </div>
                @endauth

                <div id="commentList" class="mt-3">
                    {{-- Loop bagian ini --}}
                    @foreach ($comments as $comment)
                        <div class="comment" id="{{ 'comment-'.$comment->id }}">
                            <a href="/user/{{ $comment->user->username }}" class="text-decoration-none text-dark">
                                <strong>{{ '@'.$comment->user->username }}</strong>
                            </a>
                            -
                            <small>{{ $comment->created_at->diffForHumans() }}</small>
                            <p>{{ $comment->body }}</p>
<<<<<<< HEAD

                            <!-- Button trigger modal -->
                            <button type="button" class="btn delete-form" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $comment->id }}">
                                <i class="bi bi-flag-fill"></i>
                            </button>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{ $comment->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Report Comment</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <form action="/report" method="post">
                                                @csrf
                                                <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                                <div class="form-check">
                                                    <input class="form-check-input align-self-center" type="radio" name="report_id" id="report_id1" value="1" checked>
                                                    <label class="form-check-label" for="report_id1">
                                                        <div>
                                                            <h5>Judul report</h5>
                                                            <p>Deskripsi report dari database</p>
                                                        </div>
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input align-self-center" type="radio" name="report_id" id="report_id2" value="2">
                                                    <label class="form-check-label" for="report_id2">
                                                        <div>
                                                            <h5>Judul report</h5>
                                                            <p>Deskripsi report dari database</p>
                                                        </div>
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input align-self-center" type="radio" name="report_id" id="report_id3" value="3">
                                                    <label class="form-check-label" for="report_id3">
                                                        <div>
                                                            <h5>Judul report</h5>
                                                            <p>Deskripsi report dari database</p>
                                                        </div>
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input align-self-center" type="radio" name="report_id" id="report_id4" value="4">
                                                    <label class="form-check-label" for="report_id4">
                                                        <div>
                                                            <h5>Judul report</h5>
                                                            <p>Deskripsi report dari database</p>
                                                        </div>
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input align-self-center" type="radio" name="report_id" id="report_id5" value="5">
                                                    <label class="form-check-label" for="report_id5">
                                                        <div>
                                                            <h5>Judul report</h5>
                                                            <p>Deskripsi report dari database</p>
                                                        </div>
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input align-self-center" type="radio" name="report_id" id="report_id6" value="6">
                                                    <label class="form-check-label" for="report_id6">
                                                        <div>
                                                            <h5>Judul report</h5>
                                                            <p>Deskripsi report dari database</p>
                                                        </div>
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input align-self-center" type="radio" name="report_id" id="report_id7" value="7">
                                                    <label class="form-check-label" for="report_id7">
                                                        <div>
                                                            <h5>Judul report</h5>
                                                            <p>Deskripsi report dari database</p>
                                                        </div>
                                                    </label>
                                                </div>
                                                 
                                        </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary">Report</button>
                                                </div>
                                            </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{-- Contoh untuk menghapus komen sendiri --}}
                        <div class="comment">
                            <a href="/user/username" class="text-decoration-none text-dark">
                                <strong>@safnayuninda (you)</strong>
                            </a>
                            -
                            <small>4 days ago</small>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>


                            <form action="#" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    {{-- Sampai sini --}}
                </div>
            </div>
        </div>
    </div>




    <!-- Modal -->
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
