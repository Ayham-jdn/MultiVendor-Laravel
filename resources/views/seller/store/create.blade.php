@extends('seller.layouts.layout')

@section('sellerPageTitle')
    Create Store
@endsection

@section('sellerLayout')
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>Brand infomation</h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li>
                    <a href="#">
                        <div class="text-tiny">Dashboard</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <a href="#">
                        <div class="text-tiny">Store</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">New Store</div>
                </li>
            </ul>
        </div>
        <!-- new-category -->
        <div class="wg-box">
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
            <form class="form-new-product form-style-1" action="{{route('stores.store')}}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <fieldset class="name">
                    <div class="body-title">Store Name <span class="tf-color-1">*</span></div>
                    <input class="flex-grow" type="text" placeholder="Store name" name="store_name"
                        tabindex="0" value="" aria-required="true" required="">
                </fieldset>
                <fieldset class="name">
                    <div class="body-title">Store Slug <span class="tf-color-1">*</span></div>
                    <input class="flex-grow" type="text" placeholder="Store Slug" name="slug"
                        tabindex="0" value="" aria-required="true" required="">
                </fieldset>
                <fieldset class="description">
                    <div class="body-title mb-10">Details <span class="tf-color-1">*</span>
                    </div>
                    <textarea class="mb-10" name="details" placeholder="details"
                        tabindex="0" aria-required="true" required=""></textarea>

                </fieldset>

                <div class="bot">
                    <div><input type="hidden" name="user_id" value="{{ Auth::id() }}"></div>
                    <button class="tf-button w208" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection