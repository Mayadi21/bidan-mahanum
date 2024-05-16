@extends('dashboard.layouts.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">
            @if($active === 'admin-comments') All @else My Posts' @endif
            Comments
        </h1>
    </div>

    <div class="table-responsive small col-lg-8">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Comment</th>
                <th scope="col">User</th>
                <th scope="col">Post Title</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1,001</td>
                    <td>Komen dari Database</td>
                    <td>User yang komen dari Database</td>
                    <td>Judul post uang dikomen dari Database</td>
                    <td>
                        <a href="{{ route(($active === 'admin-comments') ? 'admin.comments.show' : 'dashboard.comments.show', '1') }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="#" class="btn btn-sm btn-outline-danger d-inline-block">
                            <i class="bi bi-trash"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection