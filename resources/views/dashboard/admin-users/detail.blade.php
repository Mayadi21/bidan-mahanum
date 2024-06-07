@extends('dashboard.layouts.main')

@section('content')
<div class="d-flex justify-content-between align-items-center pt-3 mb-3 border-bottom">
    <div class="order-1">
        <h1 class="h2">{{ $user->name }}</h1>
        <p class="text-secondary">{{'@'.$user->username }}</p>
    </div>
    <div class="order-2">
        <div class="btn-group btn-group-sm" role="group" aria-label="Basic outlined example">
            <form action="{{ route('admin.users.detail', $user->username) }}" method="get">
                <button type="submit" name="hidden" value="posts" class="btn btn-outline-secondary">Posts</button>
                <button type="submit" name="hidden" value="comments" class="btn btn-outline-secondary">Comments</button>
            </form>
        </div>
    </div>
    <div class="order-3">
        <form action="{{ route('admin.users.detail', $user->username) }}" class="d-flex" role="search">
            @if(request('hidden'))
                <input type="hidden" name="hidden" value="{{ request('hidden')}}">
            @endif
            <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search" value="{{ request('search') }}">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
    </div>
</div>


    <h3 class="mt-3">{{ $title }}</h3>

    <div class="table-responsive small col-lg-12">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    @if(request('hidden') == 'comments')
                    <th scope="col">Comment</th>
                    @endif
                    <th scope="col">Post Title</th>
                    <th scope="col">Report</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @if(!request()->has('hidden') || request('hidden') == 'posts')
                    @foreach ($hidden as $post)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->report->report_name }}</td>
                        <td>
                            <a href="{{ route('admin.users.hidden-posts', [$user->username, $post->id]) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye-fill"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                @else
                    @foreach ($hidden as $comment)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $comment->body }}</td>
                        <td>{{ $comment->post->title }}</td>
                        <td>{{ $comment->report->report_name }}</td>
                        <td>
                            <a href="{{ route('admin.users.hidden-comments', [$user->username, $comment->id]) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye-fill"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

        {{ $hidden->appends(request()->all())->links() }}
    </div>
@endsection