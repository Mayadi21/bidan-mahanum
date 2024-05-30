@extends('dashboard.layouts.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">
            @if($active === 'admin-posts') All @else My @endif
            Posts
        </h1>
    </div>

    @if($active === 'posts')
    <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Create New Post</a>
    @endif

    <div class="table-responsive small col-lg-12">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                <th scope="col">No</th>
                <th scope="col">Title</th>
                @if($active === 'admin-posts') 
                <th scope="col">User</th> 
                @endif
                <th scope="col">Category</th>
                @if($active === 'admin-posts') @else
                <th scope="col">Status</th>
                @endif
                <th scope="col">View</th>
                <th scope="col">Publish Date</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($posts as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td @if($item->report_id) class="text-danger fw-bold" @endif>{{$item->title}}</td>

                    @if($active === 'admin-posts') 
                    <td>{{'@'.$item->user->username}}</td> 
                    @endif

                    <td @if($item->report_id) class="text-danger fw-bold" @endif>{{$item->category->category_name}}</td>

                    @if($active === 'admin-posts') @else
                    <td @if($item->report_id) class="text-danger fw-bold" @endif>
                        {{$item->report_id == null ? $item->status : 'Hidden by Admin'}}
                    </td>
                    @endif

                    <td @if($item->report_id) class="text-danger fw-bold" @endif>{{$item->view}}</td>
                    <td @if($item->report_id) class="text-danger fw-bold" @endif>
                        @if($item->status !== 'draft') {{$item->updated_at}} 
                        @else - @endif
                    </td>
                    <td>
                        <a href="{{ route(($active === 'admin-posts') ? 'admin.posts.show' : 'posts.show', $item->slug) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye-fill"></i>
                        </a>
                        @if($active === 'posts')
                            @if($item->report_id == null)
                            <a href="{{ route('posts.edit', $item->slug) }}" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            @endif
                        @endif
                        @if($active === 'posts')
                            @if($item->report_id == null)
                            <form action="{{ route('posts.destroy', $item->slug) }}" method="POST" class="delete-form" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this post?')">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                            @endif
                        @else
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $item->id }}">
                                <i class="bi bi-x-octagon-fill"></i>
                            </button>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-3" id="exampleModalLabel{{ $item->id }}">Hide Post</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('admin.posts.hide', $item->slug) }}" method="post">
                                                @method('PUT')
                                                @csrf
                                                <input type="hidden" name="post_id" value="{{ $item->id }}">
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
    {{ $posts->links() }}
@endsection