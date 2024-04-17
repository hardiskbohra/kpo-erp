<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="/html/ltr/vertical-menu-template/index.html">
                    <div class="brand-logo"><img class="logo" src="/app-assets/images/logo/logo.png" /></div>
                    <h2 class="brand-text mb-0">Frest</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i
                        class="bx bx-x d-block d-xl-none font-medium-4 primary"></i><i
                        class="toggle-icon bx bx-disc font-medium-4 d-none d-xl-block primary"
                        data-ticon="bx-disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation"
            data-icon-style="lines">
<!--             <li class=" nav-item"><a href="/html/ltr/vertical-menu-template/index.html"><i class="menu-livicon" data-icon="desktop"></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span><span class="badge badge-light-danger badge-pill badge-round float-right mr-2">5</span></a>
                <ul class="menu-content">
                    <li><a href="{{route('dashboard')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">EEeCommerce</span></a>
                    </li>
                    <li class="active"><a href="{{route('dashboard')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Analytics">Analytics</span></a>
                    </li>
                </ul>
            </li>

            {{-- @if (Auth::guard('client')->check() && $prefix == '/client')
                <li class=" navigation-header"><span>Images</span>
                <li class=" nav-item"><a href="#"><i class="menu-livicon" data-icon="notebook"></i><span
                            class="menu-title" data-i18n="Invoice"> My images</span></a>
                    <ul class="menu-content">
                        @if (Auth::guard('client')->check())
                            <li><a href="{{ route('client.purchased-images') }}"><i
                                        class="bx bx-right-arrow-alt"></i><span class="menu-item"
                                        data-i18n="Invoice">Purchased images</span></a>
                            </li>
                            <li><a href="{{ route('client.for-sale-images') }}"><i
                                        class="bx bx-right-arrow-alt"></i><span class="menu-item"
                                        data-i18n="Invoice">For-sale images</span></a>
                            </li>
                            <li><a href="{{ route('client.uploaded-images') }}"><i
                                        class="bx bx-right-arrow-alt"></i><span class="menu-item"
                                        data-i18n="Invoice">All-uploaded images</span></a>
                            </li>
                            <li><a href="{{ route('client.image-select') }}"><i class="bx bx-right-arrow-alt"></i><span
                                        class="menu-item" data-i18n="Invoice">Image upload</span></a>
                            </li>
                        @endif

                    </ul>
                </li>
                </li>
                <li class=" navigation-header"><span>O T H E R</span>
                <li class=" nav-item"><a href="#"><i class="menu-livicon" data-icon="notebook"></i><span
                            class="menu-title" data-i18n="Invoice">Other</span></a>
                    <ul class="menu-content">
                        <li><a href="{{ route('client.order-history') }}"><i class="bx bx-right-arrow-alt"></i><span
                                    class="menu-item" data-i18n="Invoice">Order History</span></a>
                        </li>
                        <li><a href="{{ route('client.coin-history') }}"><i class="bx bx-right-arrow-alt"></i><span
                                    class="menu-item" data-i18n="Invoice">Wallet</span></a>
                        </li>
                        <li><a href="{{ route('client.referral') }}"><i class="bx bx-right-arrow-alt"></i><span
                                    class="menu-item" data-i18n="Invoice">Share Referral </span></a>
                        </li>
                    </ul>
                </li>
                </li>
            @endif --}}

            {{-- @if (Auth::guard('admin')->check() && $prefix == '/admin')
                <li class=" navigation-header"><span> A D M I N</span>
                <li class=" nav-item"><a href="#"><i class="menu-livicon" data-icon="notebook"></i><span
                            class="menu-title" data-i18n="Invoice">Admin</span></a>
                    <ul class="menu-content">
                        <li><a href="{{ route('admin.system-settings') }}"><i class="bx bx-right-arrow-alt"></i><span
                                    class="menu-item" data-i18n="Invoice List">System Settings</span></a>
                        </li>
                        <li><a href="{{ route('admin.clients-list') }}"><i class="bx bx-right-arrow-alt"></i><span
                                    class="menu-item" data-i18n="Invoice">Users Lisr</span></a>
                        </li>
                        <li><a href="{{ route('admin.clients-reports') }}"><i class="bx bx-right-arrow-alt"></i><span
                                    class="menu-item" data-i18n="Invoice">Analytics</span></a>
                        </li>
                        <li><a href="{{ route('admin.coin-history') }}"><i class="bx bx-right-arrow-alt"></i><span
                                    class="menu-item" data-i18n="Invoice">coin history</span></a>
                        </li>
                        <li><a href="{{ route('admin.order-history') }}"><i class="bx bx-right-arrow-alt"></i><span
                                    class="menu-item" data-i18n="Invoice">order history</span></a>
                        </li>
                    </ul>
                </li>
                </li>
            @endif --}} -->
            <li class="navigation-header"><span>Store Management</span>
            </li>
            <li class="nav-item"><a href="{{route('dashboard')}}"><i class="menu-livicon" data-icon="desktop"></i><span class="menu-title" data-i18n="User">Dashboard</span></a></li>
            <li class="nav-item"><a href="{{route('users.index')}}"><i class="menu-livicon" data-icon="users"></i><span class="menu-title" data-i18n="User">Users</span></a></li>
            <li class="nav-item"><a href="{{route('invoices.index')}}"><i class="menu-livicon" data-icon="notebook"></i><span class="menu-title" data-i18n="Invoice">Invoices</span></a>
<!--                 <ul class="menu-content">
                    <li><a href="{{route('invoices.index')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Invoice List">Invoice List</span></a>
                    </li>
                    <li><a href="app-invoice.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Invoice">Invoice</span></a>
                    </li>
                    <li><a href="app-invoice-edit.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Invoice Edit">Invoice Edit</span></a>
                    </li>
                    <li class="active"><a href="{{route('invoices.create')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Invoice Add">Invoice Add       </span></a>
                    </li>
                </ul> -->
            </li>

        </ul>
    </div>
</div>
