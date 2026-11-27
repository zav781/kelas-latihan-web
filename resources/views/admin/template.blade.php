<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="api-token" content="{{ session('api_token') }}">
    <title>@yield('title', 'Admin Panel')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/toastr/toastr.min.css') }}">

    <script src="{{ asset('DataTables/jquery-3.6.1.js') }}"></script>
    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/toastr/toastr.min.js') }}"></script>

    <script>
        const API_TOKEN = @json(session('api_token'));
    </script>

    <style>
        body {
            background-color: #f8f9fa;
        }

        .admin-sidebar {
            width: 250px;
            background-color: #343a40;
            color: #fff;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
            display: flex;
            flex-direction: column;
        }

        .admin-sidebar .nav-link {
            color: #fff;
            padding: 10px 20px;
        }

        .admin-sidebar .nav-link:hover {
            background-color: #495057;
            color: #fff;
        }

        .admin-content {
            margin-left: 250px;
            padding: 30px;
        }

        @media (max-width: 768px) {
            .admin-sidebar {
                width: 100%;
                position: relative;
                height: auto;
            }

            .admin-content {
                margin-left: 0;
                padding: 30px;
            }
        }
    </style>
</head>

<body>
    <div class="admin-sidebar shadow">
        <h4 class="text-center fw-bold text-white pb-3 border-bottom border-secondary">Admin Panel</h4>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('admin.home') }}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('admin.projects.index') }}">Projects</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('admin.users.index') }}">Users</a>
            </li>
        </ul>

        <form action="{{ route('logout') }}" method="POST" class="mt-auto p-3">
            @csrf
            <button type="submit" class="btn btn-danger w-100">Logout</button>
        </form>
    </div>

    <div class="admin-content">
        <div class="d-flex justify-content-between align-items-center px-3 pt-3 pb-3 mb-4 bg-white rounded shadow-sm">
            <h3 class="fw-bold mb-0">Admin Dashboard</h3>
            <span class="text-muted fw-semibold">Halo, Administrator</span>
        </div>

        @yield('content')
    </div>

    <script>
        toastr.options = {
            closeButton: true,
            progressBar: true,
            positionClass: 'toast-top-right',
            timeOut: 3000
        };

        @if (session('success'))
            toastr.success(@json(session('success')));
        @endif

        @if (session('error'))
            toastr.error(@json(session('error')));
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error(@json($error));
            @endforeach
        @endif
    </script>

    @stack('scripts')
</body>

</html>