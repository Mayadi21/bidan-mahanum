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

    <div class="table-responsive small col-lg-8">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Category</th>
                <th scope="col">View</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1,001</td>
                    <td>Judul dari Database</td>
                    <td>Kategori dari Database</td>
                    <td>Jumlah View dari Database</td>
                    <td>
                        <a href="{{ route(($active === 'admin-posts') ? 'admin.posts.show' : 'posts.show', 'non-et-dicta-libero-expedita-dolorem-nobis') }}" class="btn btn-sm btn-outline-primary">
                            View
                        </a>
                        @if($active === 'posts')
                        <a href="{{ route('posts.edit', 'non-et-dicta-libero-expedita-dolorem-nobis') }}" class="btn btn-sm btn-outline-secondary">
                            Edit
                        </a>
                        @endif
                        @if($active === 'posts')
                        <a href="#" class="btn btn-sm btn-outline-danger">
                            Delete
                        </a>
                        @else
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModal{{ 1 }}">
                                <i class="bi bi-x-octagon-fill"></i>
                            </button>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{ 1 }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-3" id="exampleModalLabel">Hide Post</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <form action="#" method="post">
                                                @csrf
                                                <input type="hidden" name="comment_id" value="{{ 1 }}">
                                                <div class="form-check">
                                                    <input class="form-check-input align-self-center" type="radio" name="report_id" id="report_id1" value="1" checked>
                                                    <label class="form-check-label" for="report_id1">
                                                        <div>
                                                            <h5>Judul report</h5>
                                                            <p>Deskripsi report dari database</p>
                                                        </div>
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input align-self-center" type="radio" name="report_id" id="report_id2" value="2">
                                                    <label class="form-check-label" for="report_id2">
                                                        <div>
                                                            <h5>Judul report</h5>
                                                            <p>Deskripsi report dari database</p>
                                                        </div>
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input align-self-center" type="radio" name="report_id" id="report_id3" value="3">
                                                    <label class="form-check-label" for="report_id3">
                                                        <div>
                                                            <h5>Judul report</h5>
                                                            <p>Deskripsi report dari database</p>
                                                        </div>
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input align-self-center" type="radio" name="report_id" id="report_id4" value="4">
                                                    <label class="form-check-label" for="report_id4">
                                                        <div>
                                                            <h5>Judul report</h5>
                                                            <p>Deskripsi report dari database</p>
                                                        </div>
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input align-self-center" type="radio" name="report_id" id="report_id5" value="5">
                                                    <label class="form-check-label" for="report_id5">
                                                        <div>
                                                            <h5>Judul report</h5>
                                                            <p>Deskripsi report dari database</p>
                                                        </div>
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input align-self-center" type="radio" name="report_id" id="report_id6" value="6">
                                                    <label class="form-check-label" for="report_id6">
                                                        <div>
                                                            <h5>Judul report</h5>
                                                            <p>Deskripsi report dari database</p>
                                                        </div>
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input align-self-center" type="radio" name="report_id" id="report_id7" value="7">
                                                    <label class="form-check-label" for="report_id7">
                                                        <div>
                                                            <h5>Judul report</h5>
                                                            <p>Deskripsi report dari database</p>
                                                        </div>
                                                    </label>
                                                </div>
                                                 
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
            </tbody>
        </table>
    </div>
@endsection