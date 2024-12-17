@extends('dashboard.layouts.main')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Daftar log</h1>
</div>
<div class="container mt-5">
    <h1 class="mb-4">Log Table</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-sm" style="max-width: 100%;">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Modifier ID</th>
                    <th>Table Name</th>
                    <th>Log Target</th>
                    <th>Log Time</th>
                    <th>Action</th>
                    <th>Old Value</th>
                    <th>New Value</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                <tr>
                    <td class="small">{{ $loop->iteration }}</td>
                    <td class="small">{{ $log->modifier_id ?? 'N/A' }}</td>
                    <td class="small">{{ $log->table_name ?? 'N/A' }}</td>
                    <td class="small">{{ $log->log_target ?? 'N/A' }}</td>
                    <td class="small">{{ $log->log_time ?? 'N/A'}}</td>
                    <td class="small">{{ $log->log_action ?? 'N/A' }}</td>
                    <td class="small">{{ $log->old_value ?? 'N/A' }}</td>
                    <td class="small">{{ $log->new_value ?? 'N/A' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">No logs available</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Tampilkan link pagination -->
    <div class="d-flex justify-content-center">
        {{ $logs->links() }}
    </div>
</div>
@endsection
