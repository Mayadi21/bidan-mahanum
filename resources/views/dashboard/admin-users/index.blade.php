@extends('dashboard.layouts.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Users</h1>
        <div class="btn-group btn-group-sm me-2" role="group" aria-label="Basic outlined example">
            <form action="{{ route('admin.users.index') }}" method="get">
                <button type="submit" name="status" value="active" class="btn btn-outline-primary">Active</button>
                <button type="submit" name="status" value="admin" class="btn btn-outline-success">Admin</button>
                <button type="submit" name="status" value="banned" class="btn btn-outline-danger">Banned</button>
            </form>
        </div>
        <form action="{{ route('admin.users.index') }}" class="d-flex mt-3 mt-lg-0" role="search">
            <input type="hidden" name="status" value="{{ request('status') }}">
            <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search" value="{{ request('search') }}">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
    </div>
    
    <!-- Bagian untuk menampilkan pesan -->
    @if(session('success'))
    <div class="alert alert-success col-lg-8">
        {{ session('success') }}
    </div>
    @endif
    
    @if(session('error'))
    <div class="alert alert-danger col-lg-8">
        {{ session('error') }}
    </div>
    @endif
    
    <div class="table-responsive small col-lg-12">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Username</th>
                    @if(request('status') !== 'admin')
                    <th scope="col">Reports</th>
                    @endif
                    <th scope="col">Role</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $user->name }}</td>

                    <td>
                        @if(request('status') !== 'banned')
                        <a href="../../user/{{ $user->username }}" class="text-decoration-none">{{ '@' . $user->username }}</a>
                        @else
                        {{ '@' . $user->username }}
                        @endif
                    </td>

                    @if($user->role !== 'admin')
                    <td>
                        @if($user->report_id == null)
                        {{ $userReports[$user->id]['hiddenPostsCount'] + $userReports[$user->id]['hiddenCommentsCount'] }}
                        @else
                        {{ $user->report->report_name }}
                        @endif
                    </td>
                    @endif

                    <td>
                        @if($user->report_id !== null)
                        <span class="text-danger fw-bold">Banned</span>
                        @else
                        {{ $user->role }}
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('admin.users.detail', $user->username) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye-fill"></i>
                        </a>

                        @if($user->role == 'user' && $user->report_id == null)
                            <form action="{{ route('admin.users.role', $user->username) }}" method="post" class="d-inline">
                                @method('PUT')
                                @csrf
                                <input type="hidden" name="role" value="admin">
                                <button type="submit" class="btn btn-sm btn-outline-success" onclick="return confirm('Change this user into admin?')">
                                    <i class="bi bi-person-vcard"></i>
                                </button>
                            </form>
                        @endif

                        @if($user->id !== auth()->user()->id)
                            @if(request('status') == 'admin')
                                <form action="{{ route('admin.users.role', $user->username) }}" method="post" class="d-inline">
                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" name="role" value="user">
                                    <button type="submit" class="btn btn-sm btn-outline-warning" onclick="return confirm('Change this admin into user?')">
                                        <i class="bi bi-person-circle"></i>
                                    </button>
                                </form>
                            @endif
                        @endif

                        @if($user->role == 'user' && $user->report_id == null)
                            <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#banModal{{ $user->id }}">
                                <i class="bi bi-x-octagon-fill"></i>
                            </button>

                            <!-- Modal untuk ban -->
                            <div class="modal fade" id="banModal{{ $user->id }}" tabindex="-1" aria-labelledby="banModalLabel{{ $user->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-3" id="banModalLabel{{ $user->id }}">Ban User</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('admin.users.ban', $user->username) }}" method="post">
                                                @method('PUT')
                                                @csrf
                                                <input type="hidden" name="post_id" value="{{ 1 }}">

                                                @foreach($reports as $report)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="report_id" id="report_id{{ $report->id }}" value="{{ $report->id }}" {{ $loop->first ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="report_id{{ $report->id }}">
                                                        <div>
                                                            <h5>{{ $report->report_name }}</h5>
                                                            <p>{{ $report->report_description }}</p>
                                                        </div>
                                                    </label>
                                                </div>
                                                @endforeach
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
                        @endif

                        @if($user->report_id !== null)
                            <form action="{{ route('admin.users.destroy', $user->username) }}" method="POST" class="d-inline">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure to delete this user?')">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection