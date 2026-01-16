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
            <form class="form-new-product form-style-1" action="{{route('category.update',$category->id)}}" method="POST">
                @csrf
                @method('PUT')
                <fieldset class="name">
                    <div class="body-title">Category Name <span class="tf-color-1">*</span>
                    </div>
                    <input class="flex-grow" type="text" placeholder="Category name" name="category_name"
                        tabindex="0" value="{{$category->category_name}}" aria-required="true" required="">
                </fieldset>
               
                <div class="bot">
                    <div></div>
                    <button class="tf-button w208" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
