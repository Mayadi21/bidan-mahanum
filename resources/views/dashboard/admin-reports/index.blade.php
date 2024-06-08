@extends('dashboard.layouts.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Report Categories</h1>
        <form action="{{ route('reports.index') }}" class="d-flex mt-3 mt-lg-0" role="search">
            <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search" value="{{ request('search') }}">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
    </div>

    @if(session('success'))
        <div class="alert alert-success col-lg-8">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('reports.create') }}" class="btn btn-primary mb-3">Create New Report Category</a>
    <div class="table-responsive small col-lg-12">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                <th scope="col">No</th>
                <th scope="col">Report Title</th>
                <th scope="col">Description</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reports as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->report_name }}</td>
                    <td>{{$item->report_description}}</td>
                    <td>
                        <a href="{{ route('reports.edit', $item->id) }}" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-pencil-square"></i>
                        </a>

                        <form action="{{ route('reports.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $reports->appends(request()->all())->links() }}
    </div>
@endsection