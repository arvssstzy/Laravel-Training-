   <!-- Sidebar Toggle Button -->
   <button id="toggleSidebar" class="btn">
            <span id="toggleIcon">&gt;</span>
        </button>

        <!-- Sidebar -->
        <nav class="sidebar" id="sidebar">
        <div class="logo">
            <img src="{{ asset('asset/images/lst.png') }}" alt="Logo">
            <h2>LSTV USER</h2>
        </div>
        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" data-page="create">Dashboard</a>
        <a href="{{ route('create') }}" class="nav-link {{ request()->routeIs('create') ? 'active' : '' }}" data-page="create">SIMPLE CRUD</a>
        <a href="{{ route('headndetails') }}" class="nav-link" data-page="about">HEADER AND DETAILS</a>
        <a href="#" class="nav-link" data-page="contact">Contact</a>
        </nav>