@extends('seller.layouts.layout')

@section('adminPageTitle')
    Manage Product 
@endsection

@section('sellerLayout')
<div class="main-content-wrap">
        @foreach (['success', 'error', 'warning', 'info'] as $msg)
            @if(session()->has($msg))
                <div class="alert alert-{{ $msg }} mt-3">
                    {{ session()->get($msg) }}
                </div>
            @endif
        @endforeach

        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>product Manage</h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li>
                    <a href="index.html">
                        <div class="text-tiny">Dashboard</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">products Manage</div>
                </li>
            </ul>
        </div>

        <div class="wg-box">
            <div class="flex items-center justify-between gap10 flex-wrap">
                <div class="wg-filter flex-grow">
                    <form class="form-search">
                        <fieldset class="name">
                            <input type="text" placeholder="Search here..." class="" name="name"
                                tabindex="2" value="" aria-required="true" required="">
                        </fieldset>
                        <div class="button-submit"> 
                            <button class="" type="submit"><i class="icon-search"></i></button>
                        </div>
                    </form>
                </div>
                <a class="tf-button style-1 w208" href="{{route('product.create')}}"><i
                        class="icon-plus"></i>Add new</a>
            </div>



            <div class="wg-table table-all-use p-1  ">
                <table class="table table-hover table-bordered ">
                    <thead class="table-light text-center ">>
                        <tr class="">
                            <th>Status</th>
                            <th>Store Name</th>
                            <th>Store</th>
                            <th>Details</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @foreach($products as $product)
                    <tbody>
                        <tr class="align-middle text-center">
                            <td>{{$product->status}}</td>
                            <td class="pnam">{{$product->product_name}}</td>
                            <td class="pnam">{{$product->store->store_name}}</td>
                            <td class="pnam">{{$product->description}}</td>
                            <td>
                                <div class="list-icon-function">
                                    <a href="{{route('product.edit',$product->id)}}">
                                       <span class="item edit">
                                           <i class="icon-edit-3"></i>
                                        </span>
                                   </a>
                                    <form action="{{route('product.destroy',$product->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="item text-danger delete" onclick="return confirm('Are you sure you want to delete this category?')">
                                            <i class="icon-trash-2"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>





            <div class="divider"></div>
            <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">

            </div>
        </div>
    </div>
@endsection