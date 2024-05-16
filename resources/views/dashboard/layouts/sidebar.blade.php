<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
    <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="sidebarMenuLabel">Company name</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
            <ul class="nav flex-column">

                <h6 class="sidebar-heading d-flex justify-content-start align-items-center px-3 mt-4 mb-1 text-body-secondary text-uppercase">
                    <a class="link-secondary text-decoration-none" href="{{ route('post.index') }}" aria-label="Add a new report">
                        <i class="bi bi-arrow-left-circle"></i>
                        <span class="ms-2">Back to Blog</span>
                    </a>
                </h6>
                
                <hr class="my-3">
                
                @can('admin')
                
                <h6 class="sidebar-heading d-flex justify-content-start align-items-center px-3 my-3 text-body-secondary text-uppercase">
                    <i class="bi bi-person-vcard"></i>
                    <span class="ms-2 fw-bold">ADMIN</span>
                </h6>

                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 @if($active === 'admin-dashboard') active @endif" aria-current="page" href="{{ route('dashboard.admin') }}">
                        <i class="bi bi-display"></i>
                        Dashboard
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 @if($active === 'admin-users') active @endif" aria-current="page" href="{{ route('admin.users.index') }}">
                        <i class="bi bi-person-circle"></i>
                        Users
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 @if($active === 'admin-posts') active @endif" aria-current="page" href="{{ route('admin.posts.index') }}">
                        <i class="bi bi-file-earmark-text"></i>
                        Posts
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 @if($active === 'admin-comments') active @endif" aria-current="page" href="{{ route('admin.comments.index') }}">
                        <i class="bi bi-chat-left-text"></i>
                        Comments
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 @if($active === 'admin-categories') active @endif" href="{{ route('categories.index')}}">
                        <i class="bi bi-tags"></i>
                        Categories
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 @if($active === 'admin-reports') active @endif" href="{{ route('reports.index')}}">
                        <i class="bi bi-flag"></i>
                        Reports
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 @if($active === 'admin-post-reports') active @endif" aria-current="page" href="{{ route('admin.post-reports.index') }}">
                        <i class="bi bi-stickies"></i>
                        Post Reports
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 @if($active === 'admin-comment-reports') active @endif" aria-current="page" href="{{ route('admin.comment-reports.index') }}">
                        <i class="bi bi-chat-square"></i>
                        Comment Reports
                    </a>
                </li>

                <hr class="my-3">

                @endcan

                <h6 class="sidebar-heading d-flex justify-content-start align-items-center px-3 my-3 text-body-secondary text-uppercase">
                    <i class="bi bi-person-circle"></i>
                    <span class="ms-2 fw-bold">
                        @can('admin') USER MODE @else USER @endcan
                    </span>
                </h6>
                
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 @if($active == 'dashboard') active @endif" aria-current="page" href="{{ route('dashboard') }}">
                        <i class="bi bi-display"></i>
                        Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 @if($active == 'posts') active @endif" aria-current="page" href="{{ route('posts.index') }}">
                        <i class="bi bi-file-earmark-text"></i>
                        Posts
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 @if($active == 'comments') active @endif" aria-current="page" href="{{ route('dashboard.comments.index') }}">
                        <i class="bi bi-chat-left-text"></i>
                        Comments
                    </a>
                </li>
            </ul>

            <hr class="my-3">

            <ul class="nav flex-column mb-auto">
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" class="nav-link d-flex align-items-center gap-2">
                        @csrf
                        <i class="bi bi-door-open"></i>
                        <button class="dropdown-item fw-bold" type="submit">Log Out</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>