<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                        class="fas fa-search"></i></a></li>
        </ul>

    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{ asset(auth()->user()->avatar) }}" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">Hi, {{ auth()->user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{ route('admin.profile') }}" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a>
                <a href="{{ route('admin.settings.index') }}" class="dropdown-item has-icon">
                    <i class="fas fa-cog"></i> Settings
                </a>
                <div class="dropdown-divider"></div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <a href="{{ route('logout') }}"  onclick="event.preventDefault();
                    this.closest('form').submit();" class="dropdown-item has-icon text-danger">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </form>
            </div>
        </li>
    </ul>
</nav>

                                                            {{-- sidebar start --}}


<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard.index') }}">{{ config('settings.site_name') }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard.index') }}">{{ truncate(config('settings.site_name'),2) }}</a>
        </div>
        <ul class="sidebar-menu">

            <li class="menu-header">Starter</li>
            <li class="{{ setSidebarActive(['admin.dashboard.index']) }}"><a class="nav-link" href="{{ route('admin.dashboard.index') }}"><i class="fas fa-fire"></i><span>Dashboard</span></a></li>
            @can('sectionn index')
                 <li class="dropdown {{ setSidebarActive([
                                             'admin.hero.index',
                                             'admin.our-features.*',
                                             'admin.counter.*',
                                             'admin.section-title.index'
                                     ]) }}">
                     <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                             class="fas fa-columns"></i> <span>Sections</span></a>
                     <ul class="dropdown-menu">
                         <li class="{{ setSidebarActive(['admin.hero.index']) }}"><a class="nav-link" href="{{ route('admin.hero.index') }}">Hero</a></li>
                         <li class="{{ setSidebarActive(['admin.our-features.*']) }}"><a class="nav-link" href="{{ route('admin.our-features.index') }}">Our Features</a></li>
                         <li class="{{ setSidebarActive(['admin.counter.*']) }}"><a class="nav-link" href="{{ route('admin.counter.index') }}">Counter</a></li>
                         <li class="{{ setSidebarActive(['admin.section-title.index']) }}"><a class="nav-link" href="{{ route('admin.section-title.index') }}">Section Titles</a></li>
                     </ul>
                 </li>
            @endcan

            @canany(['listing index' , 'pending listing' , 'listing review' , 'listing claims'])
                <li class="dropdown {{ setSidebarActive([
                'admin.category.*',
                'admin.location.*',
                'admin.amenity.*',
                'admin.listing.*',
                'admin.pending-listing.*',
                'admin.listing-claims',
                'admin.listing-reviews.index'
                ]) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-list"></i><span>Listings</span></a>
                <ul class="dropdown-menu">
                    @can('listing index')
                         <li class="{{ setSidebarActive(['admin.category.*']) }}"><a class="nav-link" href="{{ route('admin.category.index') }}">Categories</a></li>
                         <li class="{{ setSidebarActive(['admin.location.*']) }}"><a class="nav-link" href="{{ route('admin.location.index') }}">Locations</a></li>
                         <li class="{{ setSidebarActive(['admin.amenity.*']) }}"><a class="nav-link" href="{{ route('admin.amenity.index') }}">Amenities</a></li>
                         <li class="{{ setSidebarActive(['admin.listing.*']) }}"><a class="nav-link" href="{{ route('admin.listing.index') }}">All Listings</a></li>
                    @endcan
                    @can('pending listing')
                        <li class="{{ setSidebarActive(['admin.pending-listing.*']) }}"><a class="nav-link" href="{{ route('admin.pending-listing.index') }}">Pending Listings</a></li>
                    @endcan
                    @can('listing review')
                        <li class="{{ setSidebarActive(['admin.listing-reviews.index']) }}"><a class="nav-link" href="{{ route('admin.listing-reviews.index') }}">Reviews</a></li>
                    @endcan
                    @can('listing claims')
                        <li class="{{ setSidebarActive(['admin.listing-claims']) }}"><a class="nav-link" href="{{ route('admin.listing-claims') }}">Claims</a></li>
                    @endcan
                </ul>
                </li>
            @endcanany

            @canany(['package index', 'payment setting index'])
                <li class="dropdown {{ setSidebarActive(['admin.package.*','admin.payment-settings.index']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-dollar-sign"></i><span>Manage Packages</span></a>
                <ul class="dropdown-menu">
                    @can('package index')
                    <li class="{{ setSidebarActive(['admin.package.*']) }}"><a class="nav-link" href="{{ route('admin.package.index') }}">Packages</a></li>
                    @endcan
                    @can('payment setting index')
                    <li class="{{ setSidebarActive(['admin.payment-settings.index']) }}"><a class="nav-link" href="{{ route('admin.payment-settings.index') }}">Payment Settings</a></li>
                    @endcan
                </ul>
                </li>
            @endcanany

            @can('order index')
                <li class="{{ setSidebarActive(['admin.order.*']) }}"><a class="nav-link" href="{{ route("admin.order.index") }}"><i class="fas fa-cart-arrow-down"></i><span>Order</span></a></li>
            @endcan
            @can('message index')
                <li class="{{ setSidebarActive(['admin.messages']) }}"><a class="nav-link"  href="{{ route("admin.messages") }}"><i class="fas fa-inbox"></i><span>Messages</span></a></li>
            @endcan
            @can('testimonial index')
                <li class="{{ setSidebarActive(['admin.testimonials.*']) }}"><a class="nav-link" href="{{ route("admin.testimonials.index") }}"><i class="fas fa-star"></i> <span>Testimonials</span></a></li>
            @endcan

            @canany(['blog index', 'blog comment'])
                <li class="dropdown {{ setSidebarActive(['admin.blog-category.*', 'admin.blog.*','admin.blog-comment.index']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fab fa-blogger-b"></i> <span>Manage Blog</span></a>
                <ul class="dropdown-menu">
                    @can('blog index')
                    <li class="{{ setSidebarActive(['admin.blog-category.*']) }}"><a class="nav-link" href="{{ route('admin.blog-category.index') }}">Blog Categories</a></li>
                    <li class="{{ setSidebarActive(['admin.blog.*']) }}"><a class="nav-link" href="{{ route('admin.blog.index') }}">Blog</a></li>
                    @endcan
                    @can('blog comment')
                    <li class="{{ setSidebarActive(['admin.blog-comment.index']) }}"><a class="nav-link" href="{{ route('admin.blog-comment.index') }}">Comments</a></li>
                    @endcan
                </ul>
                </li>
            @endCanany

            @canany(['about index', 'contact index', 'privacy policy index', 'terms and conditions index'])
                <li class="dropdown {{ setSidebarActive(['admin.about-us.index','admin.contact.index','admin.privacy-policy.index','admin.terms-and-conditions.index']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-file-alt"></i> <span>Pages</span></a>
                <ul class="dropdown-menu">
                    @can('about index')
                    <li class="{{ setSidebarActive(['admin.about-us.index']) }}"><a class="nav-link" href="{{ route('admin.about-us.index') }}">About Us</a></li>
                    @endcan
                    @can('contact index')
                    <li class="{{ setSidebarActive(['admin.contact.index']) }}"><a class="nav-link" href="{{ route('admin.contact.index') }}">Contact Us</a></li>
                    @endcan
                    @can('privacy policy index')
                    <li class="{{ setSidebarActive(['admin.privacy-policy.index']) }}"><a class="nav-link" href="{{ route('admin.privacy-policy.index') }}">Privacy Policy</a></li>
                    @endcan
                    @can('terms and conditions index')
                    <li class="{{ setSidebarActive(['admin.terms-and-conditions.index']) }}"><a class="nav-link" href="{{ route('admin.terms-and-conditions.index') }}">Terms and Conditions</a></li>
                    @endcan
                </ul>
                </li>
            @endcanany

            @canany(['footer index', 'social link index'])
            <li class="dropdown {{ setSidebarActive(['admin.footer-info.index','admin.social-link.index']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-info"></i> <span>Manage Footer</span></a>
                <ul class="dropdown-menu">
                    @can('footer index')
                    <li class="{{ setSidebarActive(['admin.footer-info.index']) }}"><a class="nav-link" href="{{ route('admin.footer-info.index') }}">Footer Info</a></li>
                    @endcan
                    @can('social link index')
                    <li class="{{ setSidebarActive(['admin.social-link.index']) }}"><a class="nav-link" href="{{ route('admin.social-link.index') }}">Social Links</a></li>
                    @endcan
                </ul>
            </li>
            @endcanany

            @can('access management index')
            <li class="dropdown {{ setSidebarActive(['admin.role.index','admin.role-user.index']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-ban"></i> <span>Access Management</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setSidebarActive(['admin.role.index']) }}"><a class="nav-link" href="{{ route('admin.role.index') }}">Roles and Permissions</a></li>
                    <li class="{{ setSidebarActive(['admin.role-user.index']) }}"><a class="nav-link" href="{{ route('admin.role-user.index') }}">Role Users</a></li>
                </ul>
            </li>
            @endcan

            @can('menu builder index')
            <li class="{{ setSidebarActive(['admin.menu-builder.index']) }}"><a class="nav-link" href="{{ route("admin.menu-builder.index") }}"><i class="fas fa-wrench"></i> <span>Menu Builder</span></a></li>
            @endcan
            @can('setting index')
            <li class="{{ setSidebarActive(['admin.settings.index']) }}"><a class="nav-link" href="{{ route("admin.settings.index") }}"><i class="fas fa-cog"></i> <span>Settings</span></a></li>
            @endcan
            @can('setting index')
            <li class="{{ setSidebarActive(['admin.clear-database.index']) }}"><a class="nav-link" href="{{ route("admin.clear-database.index") }}"><i class="fas fa-exclamation"></i> <span>Clear Database</span></a></li>
            @endcan
        </ul>
    </aside>
</div>
