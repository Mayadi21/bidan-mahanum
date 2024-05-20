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

                        <button type="button" class="btn btn-sm btn-outline-danger">
                            <i class="bi bi-x-octagon-fill"></i>
                        </button>
                        
                    </td>
                </tr>    
            </tbody>
        </table>
    </div>
@endsection