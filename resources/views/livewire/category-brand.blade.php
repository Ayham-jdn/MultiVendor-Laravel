<div class="gap22 cols">
    
    <fieldset class="category">
        <div class="body-title mb-10">Category <span class="tf-color-1">*</span>
        </div>
        <div class="select">
            <select class="" wire:model.live="selectedCategory" name="category_id">
                <option>Choose categor</option>
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                @endforeach
            </select>
        </div>
    </fieldset>
    <fieldset class="brand">
        <div class="body-title mb-10">Brand <span class="tf-color-1">*</span>
        </div>
        <div class="select">
            <select class="" name="brand_id">
                <option value="">Choose Brand</option>
                @foreach ($brands as $brand)
                    <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                @endforeach
            </select>

        </div>
    </fieldset>
</div>