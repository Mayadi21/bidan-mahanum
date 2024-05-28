@extends('dashboard.layouts.main')

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
                    @if($active !== 'admin-post-reports')
                        <th scope="col">Comment</th>
                    @endif
                    <th scope="col">Post Title</th>
                    <th scope="col">Report</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reports as $index => $report)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    @if($active !== 'admin-post-reports')
                        <td>{{ $report->comment->body }}</td>
                    @endif
                        @php
                            $item = $active === 'admin-post-reports' ? $report->post->title : $report->comment->post->title;
                        @endphp
                    <td>{{$item}}</td>
                    <td>{{ $report->report->report_name }}</td>
                    <td>
                        @php
                            $hrefRouteName = $active === 'admin-post-reports' ? 'admin.post-reports.show' : 'admin.comment-reports.show';
                            $hrefParameter = $active === 'admin-post-reports' ? $report->post->slug : $report->comment->id;
                        @endphp

                        <a href="{{ route($hrefRouteName, $hrefParameter) }}" 
                            class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye-fill"></i>
                        </a>
                        
                        @php
                            $formRouteName = $active === 'admin-post-reports' ? 'admin.post-reports.hide' : 'admin.comment-reports.hide';
                            $formParameter = $active === 'admin-post-reports' ? $report->post->slug : $report->comment->id;
                        @endphp
                        <form action="{{ route($formRouteName, $formParameter) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            @if($active == 'admin-post-reports')
                                <input type="hidden" name="post_id" value="{{ $report->post->id }}">
                            @else
                                <input type="hidden" name="comment_id" value="{{ $report->comment->id }}">
                            @endif
                            <input type="hidden" name="report_id" value="{{ $report->report->id }}">
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-x-octagon-fill"></i>
                            </button>
                        </form>

                        <!-- Delete Reports Button -->
                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteReportModal{{ $report->id }}">
                            <i class="bi bi-trash-fill"></i>
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="deleteReportModal{{ $report->id }}" tabindex="-1" aria-labelledby="deleteReportModalLabel{{ $report->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-3" id="deleteReportModalLabel{{ $report->id }}">Delete Reports</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ $active === 'admin-post-reports' ? route('admin.post-reports.delete', $report->post->id) : route('admin.comment-reports.delete', $report->comment->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <p>Are you sure you want to delete all reports for this {{ $active === 'admin-post-reports' ? 'post' : 'comment' }}?</p>
                                            <input type="hidden" name="{{ $active === 'admin-post-reports' ? 'post_id' : 'comment_id' }}" value="{{ $active === 'admin-post-reports' ? $report->post->id : $report->comment->id }}">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </div>
                                        </form>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach    
            </tbody>
        </table>
    </div>
    {{ $reports->links() }}
@endsection
