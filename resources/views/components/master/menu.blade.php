<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto">
                <a class="navbar-brand" href="">
                    <h2 class="brand-text text-danger">{{ __('Arts') }}</h2>
                </a>
            </li>

            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse">
                    <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
                    <i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i>
                </a>
            </li>
        </ul>
    </div>

    <div class="shadow-bottom"></div>

    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            @can(['dashboard'])
            <li class="{{ Request::routeIs('dashboard') ? 'active' : '' }} nav-item">
                <a class="d-flex align-items-center" href="{{ route('dashboard') }}">
                    <i data-feather="home"></i>
                    <span class="menu-title text-truncate" data-i18n="Dashboard">{{ __('Dashboard') }}</span>
                </a>
            </li>
            @endcan
            @canany(['list-product-read'])
            <li class=" navigation-header">
                <span data-i18n="Shopping">{{ __('Shopping') }}</span>
                <i data-feather="more-horizontal"></i>
            </li>
            @endcanany
            @can(['list-product-read'])
            <li class="{{ Request::routeIs('list.index') ? 'active' : '' }} nav-item">
                <a class="d-flex align-items-center" href="{{ route('list.index') }}">
                    <i data-feather="shopping-bag"></i>
                    <span class="menu-title text-truncate" data-i18n="Shop">{{ __('Shop') }}</span>
                </a>
            </li>
            @endcan
            @canany(['transaction-history-show'])
            <li class=" navigation-header">
                <span data-i18n="Main">{{ __('Main') }}</span>
                <i data-feather="more-horizontal"></i>
            </li>
            @endcanany
            @can(['transaction-history-show'])
            <li class="{{ Request::routeIs('transaction-history.index') ? 'active' : '' }} nav-item">
                <a class="d-flex align-items-center" href="{{ route('transaction-history.index') }}">
                    <i data-feather="list"></i>
                    <span class="menu-title text-truncate" data-i18n="Transaction">{{ __('Transaction') }}</span>
                </a>
            </li>
            @endcan
            @canany(['transaction-read'])
            <li class=" navigation-header">
                <span data-i18n="Main">{{ __('Main') }}</span>
                <i data-feather="more-horizontal"></i>
            </li>
            @endcanany

            @can(['transaction-read'])
            <li class="{{ Request::routeIs('transaction.index') ? 'active' : '' }} nav-item">
                <a class="d-flex align-items-center" href="{{ route('transaction.index') }}">
                    <i data-feather="list"></i>
                    <span class="menu-title text-truncate" data-i18n="Transactions">{{ __('Transactions') }}</span>
                </a>
            </li>
            @endcan

            @canany(['photo-session-read', 'prodct-category-read', 'product-read', 'product-discount-read', 'cashier-read', 'photographer-read', 'customer-read', 'role-read', 'permission-read'])
            <li class=" navigation-header">
                <span data-i18n="Settings">{{ __('Settings') }}</span>
                <i data-feather="more-horizontal"></i>
            </li>
            @endcanany

            @can(['photo-session-read'])
            <li class="{{ Request::routeIs('photo-session.index') ? 'active' : '' }} nav-item">
                <a class="d-flex align-items-center" href="{{ route('photo-session.index') }}">
                    <i data-feather="camera-off"></i>
                    <span class="menu-title text-truncate" data-i18n="Photo Sessions">{{ __('Photo Sessions') }}</span>
                </a>
            </li>
            @endcan

            @canany(['product-category-read', 'product-read', 'product-discount-read'])
            <li class=" nav-item">
                <a class="d-flex align-items-center" href="">
                    <i data-feather="archive"></i>
                    <span class="menu-title text-truncate" data-i18n="Manage Product">{{ __('Manage Product') }}</span>
                </a>

                <ul class="menu-content">
                    @can(['product-category-read'])
                    <li class="{{ Request::routeIs('product-category.index') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ url()->route('product-category.index') }}">
                            <i data-feather="tag"></i>
                            <span class="menu-item text-truncate" data-i18n="Product Categories">{{ __('Product Categories') }}</span>
                        </a>
                    </li>
                    @endcan

                    @can(['product-read'])
                    <li class="{{ Request::routeIs('product.index') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ url()->route('product.index') }}">
                            <i data-feather="airplay"></i>
                            <span class="menu-item text-truncate" data-i18n="Products">{{ __('Products') }}</span>
                        </a>
                    </li>
                    @endcan

                    @can(['product-discount-read'])
                    <li class="{{ Request::routeIs('discount.index') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ url()->route('discount.index') }}">
                            <i data-feather="airplay"></i>
                            <span class="menu-item text-truncate" data-i18n="Discounts">{{ __('Discounts') }}</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcanany

            @canany(['cashier-read', 'photographer-read', 'customer-read', 'role-read', 'permission-read'])
            <li class=" nav-item">
                <a class="d-flex align-items-center" href="">
                    <i data-feather="user"></i>
                    <span class="menu-title text-truncate" data-i18n="Manage Account">{{ __('Manage Account') }}</span>
                </a>

                <ul class="menu-content">
                    @canany(['cashier-read', 'photographer-read', 'customer-read'])
                    <li>
                        <a class="d-flex align-items-center" href="#">
                            <i data-feather="users"></i>
                            <span class="menu-item text-truncate" data-i18n="Users">Users</span>
                        </a>
                        <ul class="menu-content">
                            @can(abilities: ['cashier-read'])
                            <li class="{{ Request::routeIs('cashier.index') ? 'active' : '' }}">
                                <a class="d-flex align-items-center" href="{{ url()->route('cashier.index') }}">
                                    <span class="menu-item text-truncate" data-i18n="Cashiers">Cashiers</span>
                                </a>
                            </li>
                            @endcan

                            @can(['photographer-read'])
                            <li class="{{ Request::routeIs('photographer.index') ? 'active' : '' }}">
                                <a class="d-flex align-items-center" href="{{ url()->route('photographer.index') }}">
                                    <span class="menu-item text-truncate" data-i18n="Photographers">Photographers</span>
                                </a>
                            </li>
                            @endcan

                            @can(['customer-read'])
                            <li class="{{ Request::routeIs('customer.index') ? 'active' : '' }}">
                                <a class="d-flex align-items-center" href="{{ url()->route('customer.index') }}">
                                    <span class="menu-item text-truncate" data-i18n="Customers">Customers</span>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcanany

                    @can(['role-read'])
                    <li class="{{ Request::routeIs('role.index') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ url()->route('role.index') }}">
                            <i data-feather="shield"></i>
                            <span class="menu-item text-truncate" data-i18n="Roles">{{ __('Roles') }}</span>
                        </a>
                    </li>
                    @endcan

                    @can(['permission-read'])
                    <li class="{{ Request::routeIs('permission.index') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ url()->route('permission.index') }}">
                            <i data-feather="shield"></i>
                            <span class="menu-item text-truncate" data-i18n="Permissions">{{ __('Permissions') }}</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
        </ul>
        @endcanany
    </div>
</div>
