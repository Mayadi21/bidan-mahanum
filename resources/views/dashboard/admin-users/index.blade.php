@extends('dashboard.layouts.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Users</h1>
    </div>

    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Create New Category</a>
    <div class="table-responsive small col-lg-8">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Username</th>
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