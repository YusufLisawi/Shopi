<div class="col-lg-3 primary-sidebar sticky-sidebar">
    <div class="row">
        <div class="col-lg-12 col-mg-6">
            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @elseif (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
        </div>
        <div class="col-lg-12 col-mg-6"></div>
    </div>
    <div class="widget-category mb-30 rounded-3xl border-slate-200">
        <h5 class="section-title style-1 mb-30 wow fadeIn animated">Categories</h5>
        <ul class="categories">
            @foreach ($categories as $category)
                <li>
                    <a href="{{ url()->current() }}?{{ http_build_query(array_merge(request()->query(), ['category' => $category->slug])) }}"
                        class="{{ $selectedCategory === $category->slug ? 'active' : '' }}">
                        {{ ucfirst($category->name) }}
                    </a>
                </li>
            @endforeach

        </ul>
    </div>
    <!-- Fillter By Price -->
    <div class="sidebar-widget price_range range mb-30 rounded-3xl border-slate-200" style="border-radius: 30px">
        <div class="widget-header position-relative mb-20 pb-10">
            <h5 class="widget-title mb-10">Filter by price</h5>
            <div class="bt-1 border-color-1"></div>
        </div>
        <div class="price-filter">
            <form action="{{ url()->current() }}">
                <div class="price-filter-inner">
                    <div id="slider-range"></div>
                    <div class="price_slider_amount">
                        <div class="label-input">
                            <span>Range:</span>
                            <input type="text" id="amount" name="range" placeholder="Required format $xx - $xx">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-sm">
                    Apply Filter
                </button>
            </form>
        </div>
    </div>
</div>
