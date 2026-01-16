@extends('admin.layouts.layout')

@section('adminPageTitle')
    Create Product -Admin Panel 
@endsection

@section('adminLayout')
<div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>Attribute infomation</h3>
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
                        <div class="text-tiny">Attributes</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">New Attribute</div>
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
            <form class="form-new-product form-style-1" action="{{route('productattribute.store')}}" method="POST">
                @csrf
                <fieldset class="name">
                    <div class="body-title">Attribute Name <span class="tf-color-1">*</span>
                    </div>
                    <input class="flex-grow" type="text" placeholder="Attribute name" name="attribute_value"
                        tabindex="0" value="" aria-required="true" required="">
                </fieldset>
               
                <div class="bot">
                    <div></div>
                    <button class="tf-button w208" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
