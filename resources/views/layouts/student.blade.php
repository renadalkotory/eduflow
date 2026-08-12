<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'EduFlow')</title>

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Your CSS -->
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">

    @yield('css')
</head>

<body>

    <!-- ================= HEADER ================= -->

    <div class="container-fluid">

        <div class="row">

            <!-- Logo -->
            <div class="col-md-2 p-0">

                <div class="logo-section">

                    <span class="logo-icon">
                        ▰
                    </span>

                    <span class="logo-text">
                        EduFlow
                    </span>

                </div>

            </div>


            <!-- Menu Button -->
            <div class="col-md-2">

                <button
                    class="menu-button"
                    id="menuButton"
                    type="button"
                >

                    <i class="bi bi-list"></i>

                </button>

            </div>


            <!-- Header Right -->
            <div class="col-md-8 d-flex justify-content-end">

                <div class="header-right d-flex align-items-center">

                    <!-- Search -->
                    <button class="header-icon">

                        <i class="bi bi-search"></i>

                    </button>


                    <!-- Notification -->
                    <button class="header-icon">

                        <i class="bi bi-bell"></i>

                    </button>


                    <!-- Profile -->
                    <button
                        class="profile-button"
                        onclick="window.location.href='{{ route('student.profile') }}'"
                    >

                        <i class="bi bi-person-fill"></i>

                    </button>

                </div>

            </div>

        </div>

    </div>


    <!-- ================= BODY ================= -->

    <div class="container-fluid">

        <div class="row min-vh-100">


            <!-- ================= SIDEBAR ================= -->

            <aside
                id="sidebar"
                class="col-md-2 sidebar p-3"
            >

                <nav>

                    <!-- Dashboard -->
                    <a
                        href="{{ route('student.dashboard') }}"
                        class="nav-link sidebar-link"
                    >

                        <i class="bi bi-grid"></i>

                        Dashboard

                    </a>


                    <!-- My Courses -->
                    <a
                        href="{{ route('student.courses') }}"
                        class="nav-link sidebar-link"
                    >

                        <i class="bi bi-mortarboard"></i>

                        My Courses

                    </a>


                    <!-- Grades -->
                    <a
                        href="{{ route('student.grades') }}"
                        class="nav-link sidebar-link"
                    >

                        <i class="bi bi-star"></i>

                        Grades

                    </a>


                    <!-- Profile -->
                    <a
                        href="{{ route('student.profile') }}"
                        class="nav-link sidebar-link"
                    >

                        <i class="bi bi-person"></i>

                        Profile

                    </a>

                </nav>

            </aside>


            <!-- ================= MAIN CONTENT ================= -->

            <main
                id="mainContent"
                class="col-md-10 main-content p-4 p-lg-5"
            >

                @yield('content')

            </main>

        </div>

    </div>


    <!-- Bootstrap JS -->

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>


    <!-- Menu JavaScript -->

    <script>

        const menuButton = document.getElementById('menuButton');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');

        menuButton.addEventListener('click', function () {

            sidebar.classList.toggle('d-none');

            if (sidebar.classList.contains('d-none')) {

                mainContent.classList.remove('col-md-10');
                mainContent.classList.add('col-md-12');

            } else {

                mainContent.classList.remove('col-md-12');
                mainContent.classList.add('col-md-10');

            }

        });

    </script>


    @yield('scripts')

</body>

</html>