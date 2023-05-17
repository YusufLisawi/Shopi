<x-app-layout>
    <section class="mt-50 mb-50">
        <div class="container">
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table shopping-summery text-center clean">
                            <thead>
                                <tr class="main-heading">
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Subtotal</th>
                                    <th scope="col">Remove</th>
                                </tr>
                            </thead>
                            @if (Cart::count() > 0)
                                <tbody>
                                    @foreach (Cart::content() as $item)
                                        <tr>
                                            <td class="product-thumbnail ">
                                                <a class="rounded-lg"
                                                    href="{{ route('product.details', $item->model->id) }}">
                                                    <img src="{{ asset('storage/' . $item->model->image) }}"
                                                        alt="{{ $item->model->name }}"></a>
                                            </td>
                                            <td class="">
                                                <h5 class="text-lg font-medium ">
                                                    <a
                                                        href="{{ route('product.details', $item->model->id) }}">{{ ucfirst($item->model->name) }}</a>
                                                </h5>
                                                <p class="font-xs">
                                                    {{ $item->model->brief_description }}
                                                </p>
                                            </td>
                                            <td class="price" data-title="Price"><span>${{ $item->model->price }}
                                                </span></td>
                                            <td class="text-center" data-title="Stock">
                                                <div
                                                    class="border rounded-md px-2 py-1 flex items-center justify-between">
                                                    <span class="qty-val">{{ $item->qty }}</span>
                                                    <div>
                                                        <form action="{{ route('qty.up') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="row_id"
                                                                value="{{ $item->rowId }}">
                                                            <a class="qty-up" href=""
                                                                onclick="event.preventDefault(); this.closest('form').submit()">
                                                                <i class="fi-rs-angle-small-up"></i></a>
                                                        </form>
                                                        <form action="{{ route('qty.down') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="row_id"
                                                                value="{{ $item->rowId }}">
                                                            <a class="qty-down" href=""
                                                                onclick="event.preventDefault(); this.closest('form').submit()">
                                                                <i class="fi-rs-angle-small-down"></i></a>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-right" data-title="Cart">
                                                <span>${{ $item->subtotal }} </span>
                                            </td>
                                            <td class="action" data-title="Remove">
                                                <form action="{{ route('destroy.item') }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="row_id" value="{{ $item->rowId }}">
                                                    <a onclick="event.preventDefault(); this.closest('form').submit()"
                                                        class="text-muted"><i class="fi-rs-trash"></i></a>
                                            </td>
                                            </form>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="6" class="text-end">
                                            <form action="{{ route('destroy.cart') }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <a onclick="event.preventDefault(); this.closest('form').submit()"
                                                    class="text-muted">
                                                    <i class="fi-rs-cross-small"></i>
                                                    Clear Cart</a>
                                            </form>
                                        </td>
                                    </tr>

                                </tbody>
                            @else
                                <h1 class="text-xl font-bold pb-20">No item in cart</h1>
                            @endif
                        </table>
                    </div>
                    {{-- <div class="cart-action text-end">
                        <a class="btn " href="{{ route('home') }}"><i class="fi-rs-shopping-bag mr-10"></i>Continue
                            Shopping</a>
                    </div> --}}
                    @if (Cart::count() > 0)
                        <div class="flex justify-center mb-50">
                            <div class="w-100">
                                <div class=" rounded-xl cart-totals">
                                    <div class="mb-3">
                                        <h1 class="font-bold text-lg tracking-widest text-orange-500 mb-2 uppercase">
                                            Cart total</h1>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td class="cart_total_label">Cart Subtotal</td>
                                                    <td class="cart_total_amount"><span
                                                            class="font-lg fw-900 text-brand">${{ Cart::subtotal() }}</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="cart_total_label">Shipping</td>
                                                    <td class="cart_total_amount"> <i class="ti-gift mr-5"></i> Free
                                                        Shipping</td>
                                                </tr>
                                                <tr>
                                                    <td class="cart_total_label">Tax</td>
                                                    <td class="cart_total_amount">
                                                        <i class="ti-gift mr-5"></i>
                                                        <strong class="font-xl text-red-500">
                                                            ${{ Cart::tax() }}
                                                        </strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="cart_total_label">Total</td>
                                                    <td class="cart_total_amount">
                                                        <strong><span class="font-xl fw-900 text-brand">
                                                                ${{ Cart::total() }}
                                                            </span></strong>
                                                    </td>

                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="cart-action text-end">
                                        <a href="{{ route('checkout') }}" class="btn"> <i
                                                class="fi-rs-box-alt mr-10"></i>
                                            Proceed to Checkout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                @endif
            </div>
        </div>
    </section>
</x-app-layout>
