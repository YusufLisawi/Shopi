<header class="header-area header-style-1 header-height-2 px-20 shadow-sm">
    <div class="header-middle d-none d-lg-block py-3">
        <div class="container">
            <div class="header-wrap flex justify-between items-center">
                <div class="logo w-[12rem]">
                    <x-application-logo></x-application-logo>
                </div>
                <div class="search-style-1 flex-grow px-20">
                    <form action="{{ route('home') }}" class="w-100">
                        <input id="search" name="search" type="text" placeholder="Search for any product, category, brand..."/>
                    </form>
                </div>
                <div class="header-action-right">
                    <div class="header-action-2">
                        @auth
                            <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block">
                                <nav class="">
                                    <ul class="">
                                        <li>
                                            <h1 class="text-black font-bold text-[1rem]">Hi, {{ Auth::user()->name }}</h1>
                                        </li>
                                        <li><a href="#">My Account<i class="fi-rs-angle-down"></i></a>
                                            <ul class="sub-menu">
                                                @if (Auth::user()->is_admin)
                                                    <li><a href="/admin">Admin Dashboard</a></li>
                                                @endif
                                                <li><a href="{{ route('dashboard') }}">Orders Dashboard</a></li>
                                                <li><a href="{{ route('profile.edit') }}">Account Settings</a></li>
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
                            @else
                            <a href="{{ route('login') }}" class="pr-4 text-md font-semibold ">Log
                                in</a>

                                @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-sm btn-default">Register</a>
                                @endif
                                @endauth
                                <div class="header-action-icon-2 ml-10">
                                    <a class="mini-cart-icon" href="{{ route('cart') }}">
                                        {{-- <img alt="Yusuf Isawi" src="{{ asset('assets/imgs/theme/icons/icon-cart.svg') }}"> --}}
                                        <i class="fi-rs-shopping-cart text-3xl"></i>
                                        <span class="pro-count blue">{{Cart::count()}}</span>
                                    </a>
                                    <div class="cart-dropdown-wrap cart-dropdown-hm2 border-gray-200">
                                        <ul>
                                            @foreach (Cart::content() as $item)
                                                <li>
                                                    <div class="shopping-cart-img">
                                                        <a href="{{ route('product.details', $item->model->id) }}">
                                                            <img alt="" src="{{ asset('storage/'.$item->model->image) }}"></a>
                                                    </div>
                                                    <div class="shopping-cart-title">
                                                        <h4><a
                                                                href="{{ route('product.details', $item->model->id) }}">
                                                                {{ strlen($item->model->name) > 15 ? substr($item->model->name, 0, 15) . '...' : $item->model->name }}
                                                            </a>
                                                        </h4>
                                                        <h4><span>{{$item->qty}} × </span>${{$item->model->price}}</h4>
                                                    </div>
                                                    <div class="shopping-cart-delete">
                                                        <form action="{{ route('destroy.item') }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="row_id" value="{{ $item->rowId }}">
                                                            <a onclick="event.preventDefault(); this.closest('form').submit()"><i class="fi-rs-cross-small"></i></a>
                                                        </form>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div class="shopping-cart-footer">
                                            <div class="shopping-cart-total">
                                                <h4>Total <span>${{Cart::total()}}</span></h4>
                                            </div>
                                            <div class="shopping-cart-button">
                                                <a href="{{ route('cart') }}" class="btn btn-sm btn-secondary">View cart</a>
                                                <a href="{{ route('checkout') }}" class="btn btn-sm">Checkout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
