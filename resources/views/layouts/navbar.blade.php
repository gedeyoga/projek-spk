<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
            <div class="dropdown">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-link dropdown-toggle" type="button" data-toggle="dropdown"
                        aria-expanded="false">
                        {{ Auth::user()->name }}
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Profile</a>
                        <button class="dropdown-item" type="submit">Logout</button>
                    </div>
            </div>
            </form>
        </li>

        <!-- Messages Dropdown Menu -->

        <!-- Notifications Dropdown Menu -->

    </ul>
</nav>
