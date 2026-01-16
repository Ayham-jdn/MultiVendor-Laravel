@extends('layouts.user')
@section('home') 
<main class="pt-90">
    @foreach (['success', 'error', 'warning', 'info'] as $msg)
        @if(session()->has($msg))
            <div class="alert alert-{{ $msg }} mt-3">
                {{ session()->get($msg) }}
            </div>
        @endif
    @endforeach
    <div class="mb-4 pb-4"></div>
    <section class="shop-checkout container">
      <h2 class="page-title">Cart</h2>
      <div class="checkout-steps">
        <a href="{{route('cart.index')}}" class="checkout-steps__item active">
          <span class="checkout-steps__item-number">1</span>
          <span class="checkout-steps__item-title">
            <span>Shopping Bag</span>
            <em>Manage Your Items List</em>
          </span>
        </a>
        <a href="checkout.html" class="checkout-steps__item">
          <span class="checkout-steps__item-number">2</span>
          <span class="checkout-steps__item-title">
            <span>Shipping and Checkout</span>
            <em>Checkout Your Items List</em>
          </span>
        </a>
        <a href="order-confirmation.html" class="checkout-steps__item">
          <span class="checkout-steps__item-number">3</span>
          <span class="checkout-steps__item-title">
            <span>Confirmation</span>
            <em>Review And Submit Your Order</em>
          </span>
        </a>
      </div>
      <div class="shopping-cart">
        <div class="cart-table__wrapper">
          @if($cartItems->count() > 0)
            <table class="cart-table">
              <thead>
                <tr>
                  <th>Product</th>
                  <th></th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Subtotal</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @php $total = 0; @endphp

                  @foreach ($cartItems as $item)
                @php
              
                $product = $item->product;

                //TODO : check if ....
                $price = $product->discounted_price ?? $product->sale_price;
                $subtotal = $price * $item->quantity;
                $total += $subtotal;

                $hasDiscount = $product->discounted_price !== null;
                $discountPercent = $hasDiscount
                    ? round(100 * ($product->sale_price - $product->discounted_price) / $product->sale_price)
                    : 0;

                    $originalPrice = number_format($product->sale_price, 2); // 299.99
                    [$saleWhole, $saleFraction] = explode('.', $originalPrice);
                @endphp
                <tr>
                  <td>
                    <div class="shopping-cart__product-item">
                      @if ($product->images->isNotEmpty())
                          <img src="{{ asset($product->images->first()->img_path) }}" width="60">
                      @else
                          <img src="{{ asset('assets/images/default.png') }}" width="60">
                      @endif
                    </div>
                  </td>
                  <td>
                    <div class="shopping-cart__product-item__detail">
                      <h4>{{ $product->product_name ?? 'Unavilabel' }}</h4>
                      <ul class="shopping-cart__product-item__options">
                        <li>Category: {{ $product->category->category_name }}</li>
                        <li>Brand: {{ $product->brand->brand_name }}</li>
                      </ul>
                    </div>
                  </td>
                  <td>
                    @if ($product->discounted_price)
                    @php
                      [$whole, $fraction] = explode('.', $price);
                    @endphp
                      <div class="d-flex flex-column">
                        <div>
                            <span class="fw-bold text-dark">{{ $whole }}<span style="font-size: 12px; vertical-align: super;">.{{ $fraction }}</span></span> EGP</span>
                        </div>
                          @if ($hasDiscount)
                            <span class="fw-bold ms-1 "   style="color: #b30000; padding-left:20px;">-{{ $discountPercent }}%</span>
                          @endif
                          <div>
                            <span class="text-muted text-decoration-line-through fs-6" style="font-size: 7px;">{{ number_format($product->sale_price, 2) }} EGP</span>
                          </div>
                      </div>            
                    @else
                      <span class="shopping-cart__product-price">{{ number_format($product->sale_price, 2) }} EGP</span>
                    @endif
                  </td>
                  

                  <td>
                    <form action="{{ route('cart.update', $item->id) }}" method="POST">
                      @csrf
                      @method('PUT')
                      <div class="qty-control position-relative quantity-form" data-cart-id="{{ $item->id }}">
                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="qty-control__number text-center">
                        <div class="qty-control__reduce">-</div>
                        <div class="qty-control__increase">+</div>
                      </div>
                      <button type="submit" class="btn">Update</button>
                    </form>
                  </td>
                  <td>
                    <span class="shopping-cart__subtotal">{{ number_format($subtotal, 2) }} EGP</span>
                  </td>  
                  <td>
                    <form action="{{ route('cart.destroy', $item->id) }}"  method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="remove-cart">
                          <svg width="10" height="10" viewBox="0 0 10 10" fill="#767676" xmlns="http://www.w3.org/2000/svg">
                          <path d="M0.259435 8.85506L9.11449 0L10 0.885506L1.14494 9.74056L0.259435 8.85506Z" />
                          <path d="M0.885506 0.0889838L9.74057 8.94404L8.85506 9.82955L0 0.97449L0.885506 0.0889838Z" />
                      </svg></button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>

            <div class="cart-table-footer">
              <form action="#" class="position-relative bg-body">
                <input class="form-control" type="text" name="coupon_code" placeholder="Coupon Code">
                <input class="btn-link fw-medium position-absolute top-0 end-0 h-100 px-4" type="submit"
                  value="APPLY COUPON">
              </form>
              <button class="btn btn-light">UPDATE CART</button>
            </div>
          </div>
          <div class="shopping-cart__totals-wrapper">
            <div class="sticky-content">
              <div class="shopping-cart__totals">
                <h3>Cart Totals</h3>
                <table class="cart-totals">
                  <tbody>
                    <tr>
                      <th>Subtotal</th>
                      <td>{{ number_format($total, 2) }} EGP</td>
                    </tr>
                    <tr>
                      <th>Shipping</th>
                      <td>
                        <div class="form-check">

                          <label class="form-check-label" for="free_shipping">Free shipping</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input form-check-input_fill" type="checkbox" value="" id="flat_rate">
                          <label class="form-check-label" for="flat_rate">Flat rate: $49</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input form-check-input_fill" type="checkbox" value=""
                            id="local_pickup">
                          <label class="form-check-label" for="local_pickup">Local pickup: $8</label>
                        </div>
                        <div>Shipping to AL.</div>
                        <div>
                          <a href="#" class="menu-link menu-link_us-s">CHANGE ADDRESS</a>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <th>VAT</th>
                      <td>$19</td>
                    </tr>
                    <tr>
                      <th>Total</th>
                      <td>$1319</td>
                    </tr>
                  </tbody>
                </table>
              @else
                <p class="alert alert-info" >Cart is empty1.</p>
              @endif
            </div>
            <div class="mobile_fixed-btn_wrapper">
              <div class="button-wrapper container">
                <a href="{{ route('checkout.index') }}" class="btn btn-primary btn-checkout">PROCEED TO CHECKOUT</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection