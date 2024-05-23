@extends('dashboard.layouts.main')

@section('content')
    <div class="flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $user->name }}</h1>
        <p class="text-secondary">{{'@'.$user->username }}</p>
    </div>

    <h3 class="mt-5 mb-0 pb-3">Hidden Comments</h3>

    <div class="table-responsive small col-lg-8">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Comment</th>
                    <th scope="col">Post Title</th>
                    <th scope="col">Report</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hiddenComments as $comment)
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
            </tbody>
        </table>
    </div>

    <h3 class="mt-5 mb-0 pb-3">Hidden Posts</h3>

    <div class="table-responsive small col-lg-8">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Post Title</th>
                    <th scope="col">Report</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hiddenPosts as $post)
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
            </tbody>
        </table>
    </div>
@endsection