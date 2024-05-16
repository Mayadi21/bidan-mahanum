@extends('dashboard.layouts.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
    </div>

    <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Create New Post</a>
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
                        <a href="{{ route('posts.show', 'non-et-dicta-libero-expedita-dolorem-nobis') . '#main' }}" class="btn btn-sm btn-outline-primary">
                            View
                        </a>
                        <a href="{{ route('posts.edit', 'non-et-dicta-libero-expedita-dolorem-nobis') }}" class="btn btn-sm btn-outline-secondary">
                            Edit
                        </a>
                        <a href="#" class="btn btn-sm btn-outline-danger">
                            Delete
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>1,001</td>
                    <td>Judul dari Database</td>
                    <td>Kategori dari Database</td>
                    <td>Jumlah View dari Database</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-outline-primary">
                            View
                        </a>
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
                    <td>Judul dari Database</td>
                    <td>Kategori dari Database</td>
                    <td>Jumlah View dari Database</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-outline-primary">
                            View
                        </a>
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



    
    <!-- Modal -->
    <div class="modal fade" id="sessionMessageModal" tabindex="-1" aria-labelledby="sessionMessageModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sessionMessageModalLabel">Message</h5>
                </div>
                <div class="modal-body">
                    {{ session('success') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            @if(session('success'))
                $('#sessionMessageModal').modal('show');
            @endif
        });
    </script>
@endsection