<x-app-layout>
    <section class="mt-50 mb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="shop-product-fillter">
                        <div class="totall-product">
                            <p> We found <strong class="text-brand">{{ $products->total() }}</strong> items for you!</p>
                        </div>
                        <div class="sort-by-product-area">
                            <div class="sort-by-cover">
                                <div class="sort-by-product-wrap">
                                    <div class="sort-by">
                                        <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                                    </div>
                                    <div class="sort-by-dropdown-wrap">
                                        <span>
                                            @if ($sort === 'latest')
                                                Latest: New Released
                                            @elseif ($sort === 'low-to-high')
                                                Price: Low to High
                                            @elseif ($sort === 'high-to-low')
                                                Price: High to Low
                                            @else
                                                Default Sorting
                                            @endif
                                            <i class="fi-rs-angle-small-down"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="sort-by-dropdown">
                                    <ul>
                                        <li><a class="{{ $sort === 'latest' ? 'active' : '' }}"
                                                href="{{ url()->current() }}?{{ http_build_query(array_merge(request()->query(), ['sort' => 'latest'])) }}">Latest:
                                                New Released</a></li>
                                        <li><a class="{{ $sort === 'low-to-high' ? 'active' : '' }}"
                                                href="{{ url()->current() }}?{{ http_build_query(array_merge(request()->query(), ['sort' => 'low-to-high'])) }}">Price:
                                                Low to High</a></li>
                                        <li><a class="{{ $sort === 'high-to-low' ? 'active' : '' }}"
                                                href="{{ url()->current() }}?{{ http_build_query(array_merge(request()->query(), ['sort' => 'high-to-low'])) }}">Price:
                                                High to Low</a></li>
                                        <li><a href="{{ route('home') }}">Default Sorting</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row product-grid-3">
                        @foreach ($products as $p)
                            <div class="col-lg-4 col-md-4 col-6 col-sm-6 ">
                                <div class="product-cart-wrap mb-30 border-slate-200">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{ route('product.details', $p->id) }}">
                                                <img class="default-img" src="{{ json_decode($p->images)[0] }}"
                                                    alt="">
                                                <img class="hover-img" src="{{ json_decode($p->images)[1] }}"
                                                    alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            @foreach ($p->categories as $index => $cat)
                                                <a class=""
                                                    href="/?{{ http_build_query(array_merge(request()->query(), ['category' => $cat->slug])) }}"
                                                    rel="tag">{{ $index === count($p->categories) - 1 && count($p->categories) > 1 && strlen($cat->name) > 15 ? substr($cat->name, 0, 3) . '...' : $cat->name }}</a>
                                                @if ($index !== count($p->categories) - 1)
                                                    ,
                                                @endif
                                            @endforeach


                                        </div>
                                        <h2><a href="{{ route('product.details', $p->id) }}"
                                                class="text-xl">{{ strlen($p->name) > 20 ? substr($p->name, 0, 17) . '...': $p->name }}</a></h2>
                                        <div class="product-price">
                                            <span>${{ $p->price }}</span>
                                            <span class="old-price">${{ $p->old_price }}</span>
                                        </div>
                                        <div class="show flex justify-end mt-3">
                                            <form action="{{ route('cart.add') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $p->id }}">
                                                <button type="submit" class="btn btn-sm">
                                                    <i class="fi-rs-shopping-cart-add"></i>
                                                    Add to cart
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!--pagination-->
                    {{ $products->links('pagination::tailwind') }}
                </div>
                @include('livewire.sidebar')
            </div>
        </div>
    </section>
</x-app-layout>
