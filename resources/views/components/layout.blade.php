@props(['title'])

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ $title }}</title>
    <link href="{{ asset('bootstrap.min.css') }}" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/b32f3494a3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.bootstrap.min.css">
    @stack('css')
    <style>
        th,
        td {
            white-space: nowrap;
            vertical-align: middle;
        }

        .card-body {
            max-height: 60vh;
            overflow: auto;
        }

        .nav-menu:hover {
            background-color: rgb(131, 198, 240);
        }

        .nav-active {
            background-color: rgb(131, 198, 240);
        }
    </style>
</head>

<body>
    <div class="min-vh-100 py-5 d-flex justify-content-center align-items-center bg-light">
        <div class="card border-0" style="width: 45rem; max-width: 100%">
            @if (Auth::check())
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <div>
                        <a href="{{ route('students.index') }}"
                            class="btn btn-sm me-2 nav-menu @if (Request::is('students')) nav-active @endif"><i class="fa-solid fa-users"></i> Data
                            Siswa</a>
                        <a href="{{ route('users.index') }}"
                            class="btn btn-sm me-2 nav-menu @if (Request::is('users')) nav-active @endif"><i class="fa-solid fa-users-gear"></i> Data
                            User</a>
                    </div>
                    <div>
                        <a href="{{ route('my-profile') }}" class="btn btn-secondary btn-sm nav-menu @if (Request::is('my-profile')) nav-active @endif"><i class="fa-solid fa-user"></i> Profil</a>
                        <a href="{{ route('logout') }}" class="btn btn-secondary btn-sm nav-menu"><i class="fa-solid fa-person-walking-luggage"></i> Logout</a>
                    </div>
                </div>
            @endif
            {{ $slot }}
        </div>
    </div>

    {{-- bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>

    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    {{-- datatable cdn --}}
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/responsive.bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            token();
        })

        function token() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        }
    </script>
    @stack('scripts')
</body>

</html>
