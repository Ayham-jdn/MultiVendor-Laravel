@extends('admin.layouts.layout')

@section('adminPageTitle')
    Edit Category -Admin Panel 
@endsection

@section('adminLayout')
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>Edit Category </h3>
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
                        <div class="text-tiny">Categories</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">edit Category</div>
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
            <form class="form-new-product form-style-1" action="{{route('brand.update',$brand->id)}}" method="POST">
                @csrf
                @method('PUT')
                <fieldset class="name">
                    <div class="body-title">Brand Name <span class="tf-color-1">*</span>
                    </div>
                    <input class="flex-grow" type="text" placeholder="Brand name" name="brand_name"
                        tabindex="0" value="{{$brand->brand_name}}" aria-required="true" required="">
                </fieldset>
                <fieldset class="name">
                    <div class="body-title">Select Category <span class="tf-color-1"></span>
                    </div>
                    <select name="category_id" id="">
                        <option>Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" 
                                {{ $category->id == $brand->category_id ? 'selected' : '' }}>
                                {{ $category->category_name }}
                            </option>
                        @endforeach  
                    </select>
                </fieldset>
               
                <div class="bot">
                    <div></div>
                    <button class="tf-button w208" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
