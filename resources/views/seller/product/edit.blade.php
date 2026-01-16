@extends('seller.layouts.layout')

@section('sellerPageTitle')
    Edit store
@endsection

@section('sellerLayout')
    <!-- main-content-wrap -->
    <div class="main-content-wrap">
    <div class="flex items-center flex-wrap justify-between gap20 mb-27">
        <h3>Edit Product</h3>
        <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
            <li>
                <a href="index-2.html">
                    <div class="text-tiny">Dashboard</div>
                </a>
            </li>
            <li>
                <i class="icon-chevron-right"></i>
            </li>
            <li>
                <a href="all-product.html">
                    <div class="text-tiny">Products</div>
                </a>
            </li>
            <li>
                <i class="icon-chevron-right"></i>
            </li>
            <li>
                <div class="text-tiny">Edit product</div>
            </li>
        </ul>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <!-- form-add-product -->
    <form class="tf-section-2 form-add-product" method="POST" enctype="multipart/form-data"
        action="{{route('product.update', $products->id)}}">
        @csrf
        @method('PUT') 
        {{-- <input type="hidden" name="{{}}" value="" autocomplete="off"> --}}
        <div class="wg-box">
            <fieldset class="name">
                <div class="body-title mb-10">Product name <span class="tf-color-1">*</span>
                </div>
                <input class="mb-10" type="text" placeholder="Enter product name"
                    name="product_name" tabindex="0"  value="{{$products->product_name}}" aria-required="true" required>
                <div class="text-tiny">Do not exceed 100 characters when entering the
                    product name.</div>
            </fieldset>

            <fieldset class="name">
                <div class="body-title mb-10">Slug <span class="tf-color-1">*</span></div>
                <input class="mb-10" type="text" placeholder="Enter product slug"
                    name="slug" tabindex="0" value="{{$products->slug}}" aria-required="true" required>
                <div class="text-tiny">Do not exceed 100 characters when entering the
                    product name.</div>
            </fieldset>
            <div class="gap22 cols">

                <!-- الكاتيجوري -->
                <fieldset class="category">
                    <div class="body-title mb-10">Category <span class="tf-color-1">*</span></div>
                    <div class="select">
                        <select id="categorySelect" name="category_id">
                            <option value="" disabled >Choose Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $products->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>    
                </fieldset>

                <!-- البراند -->
                <fieldset class="brand">
                    <div class="body-title mb-10">Brand <span class="tf-color-1">*</span></div>
                    <div class="select">
                        <select id="brandSelect" name="brand_id" >
                            <option disabled>Choose Brand</option>
                            @foreach ($brands->where('category_id', $products->category_id) as $brand)
                                <option value="{{ $brand->id }}" {{ $products->brand_id == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->brand_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>    
                </fieldset>



                <!-- سكريبت -->
                <script>
                    const allBrands = @json($brands);
                    const currentBrandId = {{ $product->brand_id ?? 'null' }};

                    document.getElementById('categorySelect').addEventListener('change', function () {
                        const categoryId = this.value;
                        const brandSelect = document.getElementById('brandSelect');
                        brandSelect.innerHTML = '<option value="">Choose Brand</option>';

                        const filteredBrands = allBrands.filter(brand => brand.category_id == categoryId);

                        filteredBrands.forEach(brand => {
                            const option = document.createElement('option');
                            option.value = brand.id;
                            option.textContent = brand.brand_name;

                            // تحديد البراند إذا كان هو المختار سابقًا
                            if (brand.id == currentBrandId) {
                                option.selected = true;
                            }

                            brandSelect.appendChild(option);
                        });
                    });
                </script>
            </div>
            <fieldset class="description">
                <div class="body-title mb-10">Description <span class="tf-color-1">*</span>
                </div>
                <textarea class="mb-10" name="description" placeholder="Description"
                    tabindex="0" aria-required="true" required >{{$products->description}}</textarea>
                <div class="text-tiny">Do not exceed 100 characters when entering the
                    product name.</div>
            </fieldset>
            <div class="cols gap22">
                <fieldset class="name">
                    <div class="body-title mb-10">
                        Select Your store For This product <span class="tf-color-1">*</span></div>
                        <div class="select">
                            <select name="store_id" id="store_id">
                                <option>Selected Store</option> 
                                @foreach ($stores as $store)
                                    <option value="{{$store->id}}" {{ $store->id == $products->store_id ? 'selected' : '' }} >
                                        {{$store->store_name}}</option>
                                @endforeach
                            </select>
                        </div>
                </fieldset>
            </div>

            <div class="cols gap22">
                <fieldset class="name">
                    <div class="body-title mb-10">Regular Price <span
                            class="tf-color-1">*</span></div>
                    <input class="mb-10" type="number" placeholder="Enter regular price"
                        name="regular_price" tabindex="0"  value="{{$products->regular_price}}"  aria-required="true"
                        required>
                </fieldset>
                <fieldset class="name">
                    <div class="body-title mb-10">Sale Price <span
                            class="tf-color-1">*</span></div>
                    <input class="mb-10" type="number" placeholder="Enter sale price"
                        name="sale_price" tabindex="0"  value="{{$products->sale_price}}" aria-required="true"
                        required>
                </fieldset>
            </div>

            <div class="cols gap22">
                <fieldset class="name">
                    <div class="body-title mb-10">Discounted price (if any)<span
                            class="tf-color-1">*</span></div>
                    <input class="mb-10" type="number" placeholder="not required"
                        name="discounted_price" tabindex="0"  value="{{$products->discounted_price}}"  aria-required="false">
                </fieldset>
                <fieldset class="name">
                    <div class="body-title mb-10">Tax<span
                            class="tf-color-1">*</span></div>
                    <input class="mb-10" type="number" placeholder=""
                        name="tax_rate" tabindex="0"  value="{{$products->tax_rate}}" aria-required="true" required>
                </fieldset>
            </div>
        </div>
        <div class="wg-box">  
            <div class="cols gap22">
                <fieldset class="name">
                    <div class="body-title mb-10">SKU <span class="tf-color-1">*</span>
                    </div>
                    <input class="mb-10" type="text" placeholder="Enter SKU" name="sku"
                        tabindex="0" value="{{$products->sku}}" aria-required="true" required="">
                </fieldset>
                <fieldset class="name">
                    <div class="body-title mb-10">Stock Quantity <span class="tf-color-1">*</span>
                    </div>
                    <input class="mb-10" type="number" placeholder="Enter quantity"
                        name="stock_quantity" tabindex="0" value="{{$products->stock_quantity}}"
                        aria-required="true" required>
                </fieldset>
            </div>

            <div class="cols gap22">
                <fieldset class="name">
                    <div class="body-title mb-10">Stock</div>
                    <div class="select mb-10">
                        <select class="" name="stock_status" >
                            <option value="{{$pro->stock_status}}" selected>{{$pro->stock_status}}</option>
                            <option value="In Stock">InStock </option>
                            <option value="Out of Stock" >Out of Stock</option>                              
                        </select>
                    </div>
                </fieldset>
                <fieldset class="name">
                    <div class="body-title mb-10">Featured</div>
                    <div class="select mb-10">
                        <select class="" name="status">
                            @if ($products->status == "Draft")
                                <option value="Draft">Draft</option>
                                <option value="Published">Published</option>
                            @elseif($products->status == "Published")
                                <option value="Published">Published</option>
                                <option value="Draft">Draft</option>
                            @endif

                        </select>
                    </div>
                </fieldset>
            </div>
         
            <fieldset>
                <div class="body-title mb-10">Upload images <span class="tf-color-1">*</span>
                </div>
                <div class="upload-image flex-grow">
                    <div class="item" id="imgpreview" style="display:none">
                        <img src=""
                            class="effect8" alt="">
                    </div>
                    <div id="upload-file" class="item up-load">
                        <label class="uploadfile" for="imageInput">
                            <span class="icon">
                                <i class="icon-upload-cloud"></i>
                            </span>
                            <span class="body-text">Drop your images here or select <span
                                    class="tf-color">click to browse</span></span>
            
                                    <input type="file" id="imageInput" name="images[]" accept="image/*" multiple>
                        </label>
                    </div>
            </fieldset>




        @if ($products->images)

            <h6>your current images</h6>
            <fieldset>
                <div class="gallery">
                @foreach ($products->images as $image)
                <div class="image-wrapper" id="preview">
                    <img src="{{ asset($image->img_path) }}" alt="Product Image" width="100">
                    <button class="remove-btn">×</button>
                </div>

                @endforeach
            </div>
            </fieldset>         
        @endif
        





            <head>
                <style>
                    .gallery {
                        display: flex;
                        flex-wrap: wrap;
                        gap: 15px;
                        margin-top: 20px;
                    }
                    .image-wrapper {
                        position: relative;
                    }
                    .image-wrapper img {
                        width: 200px;
                        border-radius: 10px;
                        box-shadow: 0 0 5px #aaa;
                    }
                    .remove-btn {
                        position: absolute;
                        top: 5px;
                        right: 5px;
                        background-color: red;
                        color: white;
                        border: none;
                        border-radius: 50%;
                        width: 25px;
                        height: 25px;
                        font-weight: bold;
                        cursor: pointer;
                    }
                </style>
            </head>


            <div class="cols gap10">
                <button class="tf-button w-full" type="submit">Ubdate product</button>
            </div>
        </div>
    </form>
    <!-- /form-add-product -->
</div>
@endsection