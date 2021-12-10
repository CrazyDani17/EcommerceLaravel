<nav class="sidebar-nav">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="nav-icon icon-speedometer"></i> Dashboard
            </a>
        </li>

        <li class="nav-title">MANAGEMENT</li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('category.index') }}">
                <i class="nav-icon icon-drop"></i> Category
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('product.index') }}">
                <i class="nav-icon icon-drop"></i> Product
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('customer.index') }}">
                <i class="nav-icon icon-drop"></i> Customer
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('courier.index') }}">
                <i class="nav-icon icon-drop"></i> Courier
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('order.index') }}">
                <i class="nav-icon icon-drop"></i> Orders
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('product.trending') }}">
                <i class="nav-icon icon-drop"></i> Trending products
            </a>
        </li>
    </ul>
</nav>