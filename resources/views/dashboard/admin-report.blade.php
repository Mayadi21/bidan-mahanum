@extends('dashboard.layouts.main')

@php
    
@endphp

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">
            @if($active === 'admin-post-reports') Post @else Comment @endif
            Reports
        </h1>
    </div>

    <div class="table-responsive small col-lg-8">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    @if($active === 'admin-post-reports') @else
                    <th scope="col">Comment</th>
                    @endif
                    <th scope="col">Post Title</th>
                    <th scope="col">Report</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1,001</td>
                    @if($active === 'admin-post-reports') @else
                    <td scope="col">Komentar yang direport</td>
                    @endif
                    <td scope="col">Judul postnya</td>
                    <td scope="col">Jenis reportnya</td>
                    <td>
                        @php
                            $hrefRouteName = $active === 'admin-post-reports' ? 'admin.post-reports.show' : 'admin.comment-reports.show';
                            $hrefParameter = $active === 'admin-post-reports' ? $active : 1;  // GANTI PARAMETER AJA
                        @endphp

                        <a href="{{ route($hrefRouteName, $hrefParameter) }}" 
                            class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye-fill"></i>
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
                                        <h1 class="modal-title fs-3" id="exampleModalLabel">Hide Post</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        @php
                                            $formRouteName = $active === 'admin-post-reports' ? 'admin.post-reports.hide' : 'admin.comment-reports.hide';
                                            $formParameter = $active === 'admin-post-reports' ? $active : 1;  // GANTI PARAMETER AJA
                                        @endphp

                                        <form action="{{ route($formRouteName, $formParameter) }}" method="post">
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
                                                <button type="submit" class="btn btn-warning">Hide</button>
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
@endsection