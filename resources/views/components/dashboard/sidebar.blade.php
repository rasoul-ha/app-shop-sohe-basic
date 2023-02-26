<li class="side-nav-item">
    <a href="{{ route('dashboard') }}" aria-expanded="false" aria-controls="sidebarDashboards" class="side-nav-link">
        <i class="uil-home-alt"></i>
        <span> Dashboard </span>
    </a>
</li>

<li class="side-nav-item  {{ Request::is('dashboard/users/*') ? 'menuitem-active' : '' }}">
    <a href="{{ route('dashboard.users.index') }}" aria-expanded="false" aria-controls="sidebarDashboards"
        class="side-nav-link">
        <i class="uil-users-alt"></i>
        <span> Users </span>
    </a>
</li>

<li class="side-nav-item  {{ Request::is('dashboard/categories/*') ? 'menuitem-active' : '' }}">
    <a href="{{ route('dashboard.categories.index') }}" aria-expanded="false" aria-controls="sidebarDashboards"
        class="side-nav-link">
        <i class="uil-layers"></i>
        <span> Categories </span>
    </a>
</li>


<li class="side-nav-item  {{ Request::is('dashboard/products/*') ? 'menuitem-active' : '' }}">
    <a href="{{ route('dashboard.products.index') }}" aria-expanded="false" aria-controls="sidebarDashboards"
        class="side-nav-link">
        <i class="uil  uil-box"></i>
        <span> Products</span>
    </a>
</li>
<li class="side-nav-item  {{ Request::is('dashboard/banners/*') ? 'menuitem-active' : '' }}">
    <a href="{{ route('dashboard.banners.index') }}" aria-expanded="false" aria-controls="sidebarDashboards"
        class="side-nav-link">
        <i class="uil   uil-heart-alt"></i>
        <span> Banners</span>
    </a>
</li>
<li class="side-nav-item  {{ Request::is('dashboard/orders/*') ? 'menuitem-active' : '' }}">
    <a href="{{ route('dashboard.orders.index') }}" aria-expanded="false" aria-controls="sidebarDashboards"
        class="side-nav-link">
        <i class="uil-cart"></i>
        <span> Orders </span>
    </a>
</li>
<li class="side-nav-item  {{ Request::is('dashboard/images/*') ? 'menuitem-active' : '' }}">
    <a href="{{ route('dashboard.images') }}" aria-expanded="false" aria-controls="sidebarDashboards"
        class="side-nav-link">
        <i class="mdi mdi-camera-outline"></i>
        <span> Images </span>
    </a>
</li>
