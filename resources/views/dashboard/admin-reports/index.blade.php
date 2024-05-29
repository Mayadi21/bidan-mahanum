@extends('dashboard.layouts.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Report Categories</h1>
    </div>
    @if(session('success'))
        <div class="alert alert-success col-lg-8">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('reports.create') }}" class="btn btn-primary mb-3">Create New Report Category</a>
    <div class="table-responsive small col-lg-8">
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
                @foreach($categories as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->report_name }}</td>
                    <td>{{$item->report_description}}</td>
                    <td>
                        <a href="{{ route('reports.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('reports.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection