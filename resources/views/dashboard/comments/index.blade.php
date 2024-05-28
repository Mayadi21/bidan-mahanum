@extends('dashboard.layouts.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">
            @if($active === 'admin-comments') All @else My @endif
            Comments
        </h1>
    </div>

    <div class="table-responsive small col-lg-8">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Comment</th>
                    <th scope="col">User</th>
                    <th scope="col">Post Title</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comments as $comment)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $comment->body }}</td>
                    <td>{{ '@' . $comment->user->username }}</td>
                    <td>{{ $comment->post->title }}</td>
                    <td>
                        <a href="{{ route(($active === 'admin-comments') ? 'admin.comments.show' : 'dashboard.comments.show', $comment->id) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye-fill"></i>
                        </a>
                        
                        <!-- Button trigger modal -->
                        @if($active !== 'comments')
                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $comment->id }}">
                            <i class="bi bi-x-octagon-fill"></i>
                        </button>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal{{ $comment->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $comment->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-3" id="exampleModalLabel{{ $comment->id }}">Hide Comment</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('admin.comments.hide', $comment->id) }}" method="post">
                                            @method('PUT')
                                            @csrf
                                            <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                            @foreach($reports as $report)
                                            <div class="form-check">
                                                <input class="form-check-input align-self-center" type="radio" name="report_id" id="report_id{{ $report->id }}" value="{{ $report->id }}" @if($loop->first) checked @endif>
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
                        @endif
                    </td>
                </tr>           
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $comments->links() }}
@endsection
