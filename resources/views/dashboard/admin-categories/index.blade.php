@extends('dashboard.layouts.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Categories</h1>

        <form action="{{ route('categories.index') }}" class="d-flex mt-3 mt-lg-0" role="search">
            <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search" value="{{ request('search') }}">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
    </div>

    @if(session('success'))
    <div class="alert alert-success col-lg-8">
        {{ session('success') }}
    </div>
    @endif

    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Create New Category</a>
    <div class="table-responsive small col-lg-12">
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
                            <i class="bi bi-pencil-square"></i>
                        </a>

                        @if($item->id !== 31)
                        <form action="{{ route('categories.destroy', $item->category_slug) }}" method="POST" class="delete-form" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this category?')">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
        @endforeach
        </tbody>
    </table>

    {{ $categories->links() }}
</div>
@endsection