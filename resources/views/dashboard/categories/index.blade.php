@extends('dashboard.layouts.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{auth()->user()->role}}</h1>
    </div>

    @if(session('success'))
    <div class="alert alert-success col-lg-8">
        {{ session('success') }}
    </div>
    @endif

    {{-- <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> --}}

    {{-- <h2>Section title</h2> --}}
    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Create New Category</a>
    <div class="table-responsive small col-lg-8">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                <th scope="col">No</th>
                <th scope="col">Category Name</th>
                <th scope="col">Description</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->category_name}}</td>
                    <td>{{$item->category_description}}</td>
                    <td>
                    
                        <a href="{{ route('categories.edit', $item->category_slug) }}" class="btn btn-sm btn-outline-secondary">
                            Edit
                        </a>
                        <form action="{{ route('categories.destroy', $item->category_slug) }}" method="POST" class="delete-form" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                        </form>
                    </td>
                </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection