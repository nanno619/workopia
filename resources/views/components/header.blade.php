<header class="bg-blue-900 text-white p-4">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-3xl font-semibold">
            <a href="{{ url('/') }}">Workopia</a>
        </h1>
        <nav class="hidden md:flex items-center space-x-4">
            <a href="{{ route('jobs.index') }}" class="text-white hover:underline py-2 {{ request()->is('jobs') ? 'text-yellow-500' : '' }}"
                >All Jobs</a
            >
            <a
                href="{{ url('/jobs/saved') }}"
                class="text-white hover:underline py-2 {{ request()->is('jobs/saved') ? 'text-yellow-500' : '' }}"
                >Saved Jobs</a
            >
            <a href="{{ url('/login') }}" class="text-white hover:underline py-2 {{ request()->is('login') ? 'text-yellow-500' : '' }}"
                >Login</a
            >
            <a
                href="{{ url('/register') }}"
                class="text-white hover:underline py-2 {{ request()->is('register') ? 'text-yellow-500' : '' }}"
                >Register</a
            >
            <a
                href="{{ url('/dashboard') }}"
                class="text-white hover:underline py-2 {{ request()->is('dashboard') ? 'text-yellow-500' : '' }}"
            >
                <i class="fa fa-gauge mr-1"></i> Dashboard
            </a>
            <a
                href="{{ route('jobs.create') }}"
                class="bg-yellow-500 hover:bg-yellow-600 text-black px-4 py-2 rounded hover:shadow-md transition duration-300"
            >
                <i class="fa fa-edit"></i> Create Job
            </a>
        </nav>
        <button
            id="hamburger"
            class="text-white md:hidden flex items-center"
        >
            <i class="fa fa-bars text-2xl"></i>
        </button>
    </div>
    <!-- Mobile Menu -->
    <nav
        id="mobile-menu"
        class="hidden md:hidden bg-blue-900 text-white mt-5 pb-4 space-y-2"
    >
        <a href="{{ route('jobs.index') }}" class="block px-4 py-2 hover:bg-blue-700 {{ request()->is('jobs') ? 'text-yellow-500' : '' }}"
            >All Jobs</a
        >
        <a
            href="{{ url('/jobs/saved') }}"
            class="block px-4 py-2 hover:bg-blue-700 {{ request()->is('jobs/saved') ? 'text-yellow-500' : '' }}"
            >Saved Jobs</a
        >
        <a href="{{ url('/login') }}" class="block px-4 py-2 hover:bg-blue-700 {{ request()->is('login') ? 'text-yellow-500' : '' }}"
            >Login</a
        >
        <a
            href="{{ url('/register') }}"
            class="block px-4 py-2 hover:bg-blue-700 {{ request()->is('register') ? 'text-yellow-500' : '' }}"
            >Register</a
        >
        <a
            href="{{ url('/dashboard') }}"
            class="block text-white hover:underline py-2 {{ request()->is('dashboard') ? 'text-yellow-500' : '' }}"
        >
            <i class="fa fa-gauge mr-1"></i> Dashboard
        </a>
        <a
            href="{{ route('jobs.create') }}"
            class="block px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-black"
        >
            <i class="fa fa-edit"></i> Create Job
        </a>
    </nav>
</header>
