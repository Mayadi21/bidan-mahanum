@extends('dashboard.layouts.main')

@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Report Category</h1>
</div>
  
<div class="col-lg-8">
    <form action="{{ route('reports.update', 1) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="report_name" class="form-label">Report Category</label>
            <input type="text" class="form-control" id="report_name" name="report_name" required autofocus value="">
        </div>
        <div class="mb-3">
            <label for="report_description" class="form-label">Description</label>
            <input type="text" class="form-control" id="report_description" name="report_description" required autofocus value="">
        </div>
        <button type="submit" class="btn btn-primary">Edit</button>
    </form>  
</div>

@endsection