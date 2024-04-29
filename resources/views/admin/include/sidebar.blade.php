{{-- start sweet Message --}}
@if (session()->has('success'))
    <div class="snackbar">
        {{ session()->get('success') }}
    </div>
@elseif(session()->has('error'))
    <div class="snackbar">
        {{ session()->get('error') }}
    </div>
@endif
{{-- end sweet Message --}}

<nav class="admin-dashboard-nav">
    <ul>
        <li class="logo">
            <img src="{{ asset('oxygen/resources/images/oxygen.png') }}" alt="">
        </li>

        <li style="margin-top: 20px;" class="{{ $currentPage === 'dashboard' ? 'active-nav' : '' }}">
            <a href="/admin/dashboard" class="{{ $currentPage === 'dashboard' ? 'active-a' : '' }}">
                <i class="fa-solid fa-house"></i>
                <span class="nav-item">Dashboard</span>
            </a>
        </li>

        {{-- user --}}
        <li class="parent  {{ @$currentNav === 'user' ? 'active-nav' : '' }}">
            <a>
                <i class="fa-solid fa-users"></i>
                <span class="nav-item">User </span>
            </a>
            <i class="fa-solid fa-chevron-down"></i>
            <ul class="drop-down-items">
                {{-- new orders --}}
                <li class="{{ $currentPage === 'addUser' ? 'active-nav' : '' }}">
                    <a href="/admin/users/add" class="{{ $currentPage === 'addUser' ? 'active-a' : '' }}">
                        <span>Add User</span>
                    </a>
                </li>
                <li class="{{ $currentPage === 'displayUser' ? 'active-nav' : '' }}">
                    <a href="/admin/users" class="{{ $currentPage === 'displayUser' ? 'active-a' : '' }}">
                        <span>Display user</span>
                    </a>
                </li>

            </ul>
        </li>
        {{-- category --}}
        <li class="parent  {{ @$currentNav === 'category' ? 'active-nav' : '' }}">
            <a>
                <i class="fa-solid fa-bag-shopping"></i>
                <span class="nav-item">Category </span>
            </a>
            <i class="fa-solid fa-chevron-down"></i>
            <ul class="drop-down-items">
                {{-- new orders --}}
                <li class="{{ $currentPage === 'addCategory' ? 'active-nav' : '' }}">
                    <a href="/admin/categories/add" class="{{ $currentPage === 'addCategory' ? 'active-a' : '' }}">

                        <span>Add Category</span>
                    </a>
                </li>
                <li class="{{ $currentPage === 'displayCategory' ? 'active-nav' : '' }}">
                    <a href="/admin/categories" class="{{ $currentPage === 'displayCategory' ? 'active-a' : '' }}">

                        <span>Display Category</span>
                    </a>
                </li>

            </ul>
        </li>

        {{-- product --}}
        <li class="parent  {{ @$currentNav === 'product' ? 'active-nav' : '' }}">
            <a>
                <i class="fa-solid fa-bag-shopping"></i>
                <span class="nav-item">Product </span>
            </a>
            <i class="fa-solid fa-chevron-down"></i>
            <ul class="drop-down-items">
                {{-- new orders --}}
                <li class="{{ $currentPage === 'addProduct' ? 'active-nav' : '' }}">
                    <a href="/admin/products/add" class="{{ $currentPage === 'addProduct' ? 'active-a' : '' }}">

                        <span>Add Product</span>
                    </a>
                </li>
                <li class="{{ $currentPage === 'displayProduct' ? 'active-nav' : '' }}">
                    <a href="/admin/products" class="{{ $currentPage === 'displayProduct' ? 'active-a' : '' }}">

                        <span>Display Product</span>
                    </a>
                </li>
                <li class="{{ $currentPage === 'inventoryProduct' ? 'active-nav' : '' }}">
                    <a href="/admin/products/inventory" class="{{ $currentPage === 'inventoryProduct' ? 'active-a' : '' }}">

                        <span>Product Inventory</span>
                    </a>
                </li>

            </ul>
        </li>

        {{-- order --}}
        <li class="parent  {{ @$currentNav === 'order' ? 'active-nav' : '' }}">
            <a>
                <i class="fa-solid fa-cart-shopping"></i>
                <span class="nav-item">Order </span>
            </a>
            <i class="fa-solid fa-chevron-down"></i>
            <ul class="drop-down-items">
                {{-- new orders --}}
                <li class="{{ $currentPage === 'newOrder' ? 'active-nav' : '' }}">
                    <a href="/admin/orders/new" class="{{ $currentPage === 'newOrder' ? 'active-a' : '' }}">

                        <span>New Order</span>
                    </a>
                </li>
                <li class="{{ $currentPage === 'completedOrder' ? 'active-nav' : '' }}">
                    <a href="/admin/orders/completed"
                        class="{{ $currentPage === 'completedOrder' ? 'active-a' : '' }}">

                        <span>Completed Order</span>
                    </a>
                </li>

            </ul>
        </li>
        {{-- report --}}
        <li class="parent  {{ @$currentNav === 'report' ? 'active-nav' : '' }}">
            <a>
                <i class="fa-solid fa-chart-bar"></i>
                <span class="nav-item">Report </span>
            </a>
            <i class="fa-solid fa-chevron-down"></i>
            <ul class="drop-down-items">
                {{-- Sales Report --}}
                <li class="{{ $currentPage === 'salesReport' ? 'active-nav' : '' }}">
                    <a href="/admin/reports/sales" class="{{ $currentPage === 'salesReport' ? 'active-a' : '' }}">

                        <span>Sales Report</span>
                    </a>
                </li>
                {{-- product  report --}}
                <li class="{{ $currentPage === 'productReport' ? 'active-nav' : '' }}">
                    <a href="/admin/reports/products" class="{{ $currentPage === 'productReport' ? 'active-a' : '' }}">

                        <span>product Report</span>
                    </a>
                </li>

                {{-- sales --}}
                <li class="{{ $currentPage === 'orderReport' ? 'active-nav' : '' }}">
                    <a href="/admin/reports/orders" class="{{ $currentPage === 'orderReport' ? 'active-a' : '' }}">
                        <span>Order Report</span>
                    </a>
                </li>



            </ul>
        </li>
        {{-- logout --}}
        <li class="{{ $currentPage === 'logout' ? 'active-nav' : '' }}">
            <a href="/admin/logout" class="{{ $currentPage === 'logout' ? 'active-a' : '' }}">
                <i class="fa-solid fa-sign-out"></i>
                <span class="nav-item">Logout</span>
            </a>
        </li>

    </ul>
</nav>
<script>
    $(document).ready(function() {
        $('.admin-dashboard-nav ul').on('click', 'li.parent', function(event) {
            event.stopPropagation();
            // $(this).find('.fa-chevron-down').toggleClass('rotate-180');
            $(this).find('.drop-down-items').toggleClass('show');
        });

        $(document).click(function() {
            $('.admin-dashboard-nav ul li.parent .fa-chevron-down').removeClass('rotate-180');
            $('.admin-dashboard-nav ul li.parent .drop-down-items').removeClass('show');
        });
    });
</script>
