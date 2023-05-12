<x-app-layout>
    <section class="mt-50 mb-50">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-25">
                        <h4>Billing Details</h4>
                    </div>
                    <form method="post">
                        <div class="form-group">
                            <input type="text" required="" name="fname" placeholder="First name *">
                        </div>
                        <div class="form-group">
                            <input type="text" required="" name="lname" placeholder="Last name *">
                        </div>
                        <div class="form-group">
                            <input required="" type="text" name="cname" placeholder="Company Name">
                        </div>
                        @include('livewire.countries-select')
                        <div class="form-group">
                            <input type="text" name="billing_address" required="" placeholder="Address *">
                        </div>
                        <div class="form-group">
                            <input type="text" name="billing_address2" required="" placeholder="Address line2">
                        </div>
                        <div class="form-group">
                            <input required="" type="text" name="city" placeholder="City / Town *">
                        </div>
                        <div class="form-group">
                            <input required="" type="text" name="state" placeholder="State / County *">
                        </div>
                        <div class="form-group">
                            <input required="" type="text" name="zipcode" placeholder="Postcode / ZIP *">
                        </div>
                        <div class="form-group">
                            <input required="" type="text" name="phone" placeholder="Phone *">
                        </div>
                        <div class="form-group">
                            <input required="" type="text" name="email" placeholder="Email address *">
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <div class="custome-checkbox">
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="createaccount">
                                    <label class="form-check-label label_info" data-bs-toggle="collapse"
                                        href="#collapsePassword" data-target="#collapsePassword"
                                        aria-controls="collapsePassword" for="createaccount"><span>Create an
                                            account?</span></label>
                                </div>
                            </div>
                        </div>
                        <div id="collapsePassword" class="form-group create-account collapse in">
                            <input required="" type="password" placeholder="Password" name="password">
                        </div>
                        <div class="ship_detail">
                            <div class="form-group">
                                <div class="chek-form">
                                    <div class="custome-checkbox">
                                        <input class="form-check-input" type="checkbox" name="checkbox"
                                            id="differentaddress">
                                        <label class="form-check-label label_info" data-bs-toggle="collapse"
                                            data-target="#collapseAddress" href="#collapseAddress"
                                            aria-controls="collapseAddress" for="differentaddress"><span>Ship to a
                                                different address?</span></label>
                                    </div>
                                </div>
                            </div>
                            <div id="collapseAddress" class="different_address collapse in">
                                <div class="form-group">
                                    <input type="text" required="" name="fname" placeholder="First name *">
                                </div>
                                <div class="form-group">
                                    <input type="text" required="" name="lname" placeholder="Last name *">
                                </div>
                                <div class="form-group">
                                    <input required="" type="text" name="cname" placeholder="Company Name">
                                </div>
                                @include('livewire.countries-select')
                                <div class="form-group">
                                    <input type="text" name="billing_address" required=""
                                        placeholder="Address *">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="billing_address2" required=""
                                        placeholder="Address line2">
                                </div>
                                <div class="form-group">
                                    <input required="" type="text" name="city" placeholder="City / Town *">
                                </div>
                                <div class="form-group">
                                    <input required="" type="text" name="state"
                                        placeholder="State / County *">
                                </div>
                                <div class="form-group">
                                    <input required="" type="text" name="zipcode"
                                        placeholder="Postcode / ZIP *">
                                </div>
                            </div>
                        </div>
                        <div class="mb-20">
                            <h5>Additional information</h5>
                        </div>
                        <div class="form-group mb-30">
                            <textarea rows="5" placeholder="Order notes"></textarea>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="order_review">
                        <div class="mb-20">
                            <h4>Your Orders</h4>
                        </div>
                        <div class="table-responsive order_table text-center">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th colspan="2">Product</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="image product-thumbnail"><img
                                                src="{{ asset('assets/imgs/shop/product-1-1.jpg')}}" alt="#"></td>
                                        <td>
                                            <h5><a href="product-details.html">Yidarton Women Summer Blue</a></h5>
                                            <span class="product-qty">x 2</span>
                                        </td>
                                        <td>$180.00</td>
                                    </tr>
                                    <tr>
                                        <th>SubTotal</th>
                                        <td class="product-subtotal" colspan="2">$280.00</td>
                                    </tr>
                                    <tr>
                                        <th>Shipping</th>
                                        <td colspan="2"><em>Free Shipping</em></td>
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <td colspan="2" class="product-subtotal"><span
                                                class="font-xl text-brand fw-900">$280.00</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                        <div class="payment_method">
                            <div class="mb-25">
                                <h5>Payment</h5>
                            </div>
                            <div class="payment_option">
                                <div class="custome-radio">
                                    <input class="form-check-input" required="" type="radio"
                                        name="payment_option" id="exampleRadios3">
                                    <label class="form-check-label" for="exampleRadios3" data-bs-toggle="collapse"
                                        data-target="#cashOnDelivery" aria-controls="cashOnDelivery">Cash On
                                        Delivery</label>
                                </div>
                                <div class="custome-radio">
                                    <input class="form-check-input" required="" type="radio"
                                        name="payment_option" id="exampleRadios4">
                                    <label class="form-check-label" for="exampleRadios4" data-bs-toggle="collapse"
                                        data-target="#cardPayment" aria-controls="cardPayment">Card Payment</label>
                                </div>
                                <div class="custome-radio">
                                    <input class="form-check-input" required="" type="radio"
                                        name="payment_option" id="exampleRadios5">
                                    <label class="form-check-label" for="exampleRadios5" data-bs-toggle="collapse"
                                        data-target="#paypal" aria-controls="paypal">Paypal</label>
                                </div>
                            </div>
                        </div>
                        <a href="#" class="btn btn-fill-out btn-block mt-30">Place Order</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
