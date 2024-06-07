@extends('dashboard.layouts.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">
            @if($active === 'admin-comments') All @else My @endif
            Comments
        </h1>
        <form action="{{ route(($active === 'admin-comments') ? 'admin.comments.index' : 'dashboard.comments.index') }}" class="d-flex mt-3 mt-lg-0" role="search">
            <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search" value="{{ request('search') }}">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
    </div>

    @if(session('success'))
        <div class="alert alert-success col-lg-8">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive small col-lg-12">
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
                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $comment->id }}">
                            @if($active === 'admin-comments') <i class="bi bi-x-octagon-fill"></i>
                            @else <i class="bi bi-flag-fill"></i> @endif
                        </button>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal{{ $comment->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $comment->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-3" id="exampleModalLabel{{ $comment->id }}">@if($active === 'admin-comments') Hide @else Report @endif Comment</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @php
                                            $formRoute = $active === 'admin-comments' ? 'admin.comments.hide' : 'dashboard.comments.report';
                                        @endphp
                                        <form action="{{ route($formRoute, $comment->id) }}" method="post">
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
                                        <button type="submit" class="btn btn-warning">@if($active === 'admin-comments') Hide @else Report @endif</button>
                                    </div>
                                        </form>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>           
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $comments->appends(request()->all())->links() }}
@endsection
