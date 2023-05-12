<header class="header-area header-style-1 header-height-2">
    <div class="header-middle d-none d-lg-block py-3">
        <div class="container">
            <div class="header-wrap flex justify-between items-center">
                <div class="logo w-[12rem]">
                    <a href="{{ route('home') }}"><img src="assets/imgs/logo/logo.png" class="" alt="logo"></a>
                </div>
                <div class="flex-grow px-20">
                    <div class="search-style-1">
                        <form action="#" class="w-100">
                            <input type="text" placeholder="Search for items...">
                        </form>
                    </div>
                </div>
                <div class="header-action-right">
                    <div class="header-action-2">
                        @auth
                            <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block">
                                <nav>
                                    <ul>
                                        <li><a href="#">My Account<i class="fi-rs-angle-down"></i></a>
                                            <ul class="sub-menu">
                                                <li><a href="#">Dashboard</a></li>
                                                <li><a href="#">Orders</a></li>
                                                <li><a href="{{route('profile.edit')}}">Settings</a></li>
                                                <li>
                                                    <form method="POST" action="{{ route('logout') }}">
                                                        @csrf
                                                        <a href="{{ route('logout') }}"
                                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                                            {{ __('Log Out') }}
                                                        </a>
                                                    </form>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="header-action-icon-2">
                                <a class="mini-cart-icon" href="{{route('cart')}}">
                                    <img alt="Yusuf Isawi" src="assets/imgs/theme/icons/icon-cart.svg">
                                    <span class="pro-count blue">2</span>
                                </a>
                                <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                    <ul>
                                        <li>
                                            <div class="shopping-cart-img">
                                                <a href="product-details.html"><img alt="Yusuf Isawi"
                                                        src="assets/imgs/shop/thumbnail-3.jpg"></a>
                                            </div>
                                            <div class="shopping-cart-title">
                                                <h4><a href="product-details.html">Daisy Casual Bag</a></h4>
                                                <h4><span>1 × </span>$800.00</h4>
                                            </div>
                                            <div class="shopping-cart-delete">
                                                <a href="#"><i class="fi-rs-cross-small"></i></a>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="shopping-cart-footer">
                                        <div class="shopping-cart-total">
                                            <h4>Total <span>$4000.00</span></h4>
                                        </div>
                                        <div class="shopping-cart-button">
                                            <a href="cart.html" class="outline">View cart</a>
                                            <a href="checkout.html">Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}"
                                class="pr-4 text-md font-semibold ">Log
                                in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="btn btn-sm btn-default">Register</a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
