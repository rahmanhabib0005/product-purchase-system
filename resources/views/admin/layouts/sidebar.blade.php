<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ Route::is('admin.supplier.*') ? 'active' : '' }}"
                href="{{ route('admin.supplier.index') }}">
                <i class="bi bi-grid"></i>
                <span>Supplier</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::is('admin.product.*') ? 'active' : '' }}"
                href="{{ route('admin.product.index') }}">
                <i class="bi bi-grid"></i>
                <span>Product</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::is('admin.order.*') ? 'active' : '' }}"
                href="{{ route('admin.order.index') }}">
                <i class="bi bi-grid"></i>
                <span>Purchase Order</span>
            </a>
        </li>

    </ul>

</aside><!-- End Sidebar-->
