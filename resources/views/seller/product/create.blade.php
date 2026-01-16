@extends('seller.layouts.layout')

@section('sellerPageTitle')
    Create Product
@endsection

@section('sellerLayout')
    <!-- main-content-wrap -->
<div class="main-content-wrap">
    <div class="flex items-center flex-wrap justify-between gap20 mb-27">
        <h3>Add Product</h3>
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
                <div class="text-tiny">Add product</div>
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
    <form class="tf-section-2 form-add-product" method="POST"  enctype="multipart/form-data"
        action="{{route('product.store')}}" id="uploadForm" onsubmit="return validateImages()">
        @csrf

        <div class="wg-box">
            <fieldset class="name">
                <div class="body-title mb-10">Product name <span class="tf-color-1">*</span>
                </div>
                <input class="mb-10" type="text" placeholder="Enter product name"
                    name="product_name" tabindex="0"  aria-required="true" required>
                <div class="text-tiny">Do not exceed 100 characters when entering the
                    product name.</div>
            </fieldset>

            <fieldset class="name">
                <div class="body-title mb-10">Slug <span class="tf-color-1">*</span></div>
                <input class="mb-10" type="text" placeholder="Enter product slug"
                    name="slug" tabindex="0" value="" aria-required="true" required>
                <div class="text-tiny">Do not exceed 100 characters when entering the
                    product name.</div>
            </fieldset>

            
            <div class="gap22 cols">
                <!-- الكاتيجوري -->
                <fieldset class="category">
                    <div class="body-title mb-10">Category <span class="tf-color-1">*</span></div>
                    <div class="select">
                        <select id="categorySelect" name="category_id" required>
                            <option value="">Choose Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </fieldset>

                <!-- البراند -->
                <fieldset class="brand">
                    <div class="body-title mb-10">Brand <span class="tf-color-1">*</span></div>
                    <div class="select">
                        <select id="brandSelect" name="brand_id" required>
                            <option value="">Choose Brand</option>
                        </select>
                    </div>
                </fieldset>

                <!-- سكريبت فيه البراندات -->
                <script>
                    // هذه البيانات جايبينها من السيرفر
                    const brands = @json($brands);

                    document.getElementById('categorySelect').addEventListener('change', function () {
                        const categoryId = this.value;
                        const brandSelect = document.getElementById('brandSelect');

                        // تنظيف البراندات الحالية
                        brandSelect.innerHTML = '<option value="">Choose Brand</option>';

                        // تصفية البراندات حسب الكاتيجوري المختارة
                        const filteredBrands = brands.filter(brand => brand.category_id == categoryId);

                        // تعبئة البراندات الجديدة
                        filteredBrands.forEach(brand => {
                            const option = document.createElement('option');
                            option.value = brand.id;
                            option.textContent = brand.brand_name;
                            brandSelect.appendChild(option);
                        });
                    });
                </script>
            </div>

            <fieldset class="description">
                <div class="body-title mb-10">Description <span class="tf-color-1">*</span>
                </div>
                <textarea class="mb-10" name="description" placeholder="Description"
                    tabindex="0" aria-required="true" required></textarea>
                <div class="text-tiny">Do not exceed 100 characters when entering the
                    product name.</div>
            </fieldset>
            <div class="cols gap22">
                <fieldset class="name">
                    <div class="body-title mb-10">
                        Select Your store For This product <span class="tf-color-1">*</span></div>
                        <div class="select">
                            <select name="store_id" id="store_id">
                                <option>Select Store</option>
                                @foreach ($stores as $store)
                                    <option value="{{$store->id}}">{{$store->store_name}}</option>
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
                        name="regular_price" tabindex="0"  aria-required="true"
                        required>
                </fieldset>
                <fieldset class="name">
                    <div class="body-title mb-10">Sale Price <span
                            class="tf-color-1">*</span></div>
                    <input class="mb-10" type="number" placeholder="Enter sale price"
                        name="sale_price" tabindex="0"  aria-required="true"
                        required>
                </fieldset>
            </div>

            <div class="cols gap22">
                <fieldset class="name">
                    <div class="body-title mb-10">Discounted price (if any)<span
                            class="tf-color-1">*</span></div>
                    <input class="mb-10" type="number" placeholder="not required"
                        name="discounted_price" tabindex="0"  aria-required="false">
                </fieldset>
                <fieldset class="name">
                    <div class="body-title mb-10">Tax<span
                            class="tf-color-1">*</span></div>
                    <input class="mb-10" type="number" placeholder=""
                        name="tax_rate" tabindex="0"  aria-required="true" required>
                </fieldset>
            </div>
        </div>
        <div class="wg-box">  
            <div class="cols gap22">
                <fieldset class="name">
                    <div class="body-title mb-10">SKU <span class="tf-color-1">*</span>
                    </div>
                    <input class="mb-10" type="text" placeholder="Enter SKU" name="sku"
                        tabindex="0" value="" aria-required="true" required="">
                </fieldset>
                <fieldset class="name">
                    <div class="body-title mb-10">Stock Quantity <span class="tf-color-1">*</span>
                    </div>
                    <input class="mb-10" type="number" placeholder="Enter quantity"
                        name="stock_quantity" tabindex="0" value="" aria-required="true"
                        required>
                </fieldset>
            </div>

            <div class="cols gap22">
                <fieldset class="name">
                    <div class="body-title mb-10">Stock</div>
                    <div class="select mb-10">
                        <select class="" name="stock_status">
                            <option value="In Stock">InStock</option>
                            <option value="Out of Stock">Out of Stock</option>
                        </select>
                    </div>
                </fieldset>
                <fieldset class="name">
                    <div class="body-title mb-10">Featured</div>
                    <div class="select mb-10">
                        <select class="" name="status">
                            <option value="Draft">Draft</option>
                            <option value="Published">Published</option>
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

            
                            <input type="file" id="imageInput"  name="images[]" accept="image/*" multiple required >

                    </div>
            </fieldset>

            <div class="cols gap10">
                <button class="tf-button w-full" type="submit">Add product</button>
            </div>
        </div>
    </form>
    <!-- /form-add-product -->
</div>

@endsection
