@extends('dashboard.layouts.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Categories</h1>
    </div>

    {{-- <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> --}}

    {{-- <h2>Section title</h2> --}}
    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Create New Category</a>
    <div class="table-responsive small col-lg-8">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Category Name</th>
                <th scope="col">Description</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1,001</td>
                    <td>Kategori dari Database</td>
                    <td>Deskripsi dari Database</td>
                    <td>
                        <a href="{{ route('categories.edit', 'travel') }}" class="btn btn-sm btn-outline-secondary">
                            Edit
                        </a>
                        <a href="#" class="btn btn-sm btn-outline-danger">
                            Delete
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>1,001</td>
                    <td>Kategori dari Database</td>
                    <td>Deskripsi dari Database</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-outline-secondary">
                            Edit
                        </a>
                        <a href="#" class="btn btn-sm btn-outline-danger">
                            Delete
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>1,001</td>
                    <td>Kategori dari Database</td>
                    <td>Deskripsi dari Database</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-outline-secondary">
                            Edit
                        </a>
                        <a href="#" class="btn btn-sm btn-outline-danger">
                            Delete
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection