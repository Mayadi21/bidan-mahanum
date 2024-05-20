@extends('dashboard.layouts.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Users</h1>
    </div>

    <div class="btn-group btn-group-sm" role="group" aria-label="Basic outlined example">
        <button type="button" class="btn btn-outline-primary">Active</button>
        <button type="button" class="btn btn-outline-primary">Admins</button>
        <button type="button" class="btn btn-outline-primary">Banned</button>
    </div>

    <h4 class="mt-5 mb-0 pb-3">Active</h4>

    <div class="table-responsive small col-lg-8">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Reports</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <t>
                    <td>1</td>
                    <td>Aku Manusia</td>
                    <td>
                        <a href="../../user/akumanusia" class="text-decoration-none">@akumanusia</a>
                    </td>
                    <td>Banyak report (dijumlahkan dari report post sama comment)</td>
                    <td>
                        <a href="{{ route('admin.users.detail', 'akumanusia') }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye-fill"></i>
                        </a>

                        <a href="{{ route('admin.users.role', 'akumanusia') }}" class="btn btn-sm btn-outline-success" onclick="return confirm('Change this user into admin?')">
                            <i class="bi bi-person-vcard"></i>
                        </a>

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModal{{ 1 }}">
                            <i class="bi bi-x-octagon-fill"></i>
                        </button>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal{{ 1 }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-3" id="exampleModalLabel">Ban User</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <form action="{{ route('admin.users.ban', 'akumanusia') }}" method="post">
                                            @method('PUT')
                                            @csrf
                                            <input type="hidden" name="post_id" value="{{ 1 }}">
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
                                    {{-- GAK USAH DIUBAH DIV-NYA DI SINI. FOKUS DI FORM AJA --}}
                                    </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-warning">Ban</button>
                                            </div>
                                        </form>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <h4 class="mt-5 mb-0 pb-3">Admin</h4>

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
                <t>
                    <td>1</td>
                    <td>Admin</td>
                    <td>@admin</td>
                    <td>
                        <a href="{{ route('admin.users.detail', 'akumanusia') }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye-fill"></i>
                        </a>

                        <a href="{{ route('admin.users.role', 'akumanusia') }}" class="btn btn-sm btn-outline-warning" onclick="return confirm('Change this admin into user?')">
                            <i class="bi bi-person-circle"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- Banned --}}

    <h4 class="mt-5 mb-0 pb-3">Banned</h4>

    <div class="table-responsive small col-lg-8">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Reports</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <t>
                    <td>1</td>
                    <td>Nama akun</td>
                    <td>@username</td>
                    <td>Alasan diban, ngambil dari report_id</td>
                    <td>
                        <a href="{{ route('admin.users.detail', 'akumanusia') }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye-fill"></i>
                        </a>
                        <form action="{{ route('admin.users.destroy', 'akumanusia') }}">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection