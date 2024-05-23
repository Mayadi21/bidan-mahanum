@extends('dashboard.layouts.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
    </div>

    {{-- <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> --}}

    {{-- <h2>Section title</h2> --}}
    <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Create New Post</a>
    <div class="table-responsive small col-lg-8">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                <th scope="col">No</th>
                <th scope="col">Title</th>
                <th scope="col">Category</th>
                <th scope="col">Status</th>
                <th scope="col">View</th>
                <th scope="col">Publish Date</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $item)
                @if(auth()->user()->role === 'user')
                        @if($item->user_id === auth()->id())
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->title}}</td>
                    <td>{{$item->Category->category_name}}</td>
                    <td>{{$item->status}}</td>
                    <td>{{$item->view}}</td>
                    <td>{{$item->created_at}}</td>
                    <td>
                        <a href="{{ route('posts.show', $item->slug)}}" class="btn btn-sm btn-outline-primary">
                            View
                        </a>
                        <a href="{{ route('posts.edit', $item->slug) }}" class="btn btn-sm btn-outline-secondary">
                            Edit
                        </a>
                        <form action="{{ route('posts.destroy', $item->slug) }}" method="POST" class="delete-form" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete('{{$item->slug}}')">Delete</button>
                        </form>
                    </td>
                    </tr>
                    @endif
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
    {{ $posts->links() }}
@endsection