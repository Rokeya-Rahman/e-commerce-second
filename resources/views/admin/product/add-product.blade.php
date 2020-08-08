@extends('admin.master')

@section('title')
    Add Product
@endsection

@section('body')

    <div id="main-wrapper">
        <div class="page-wrapper">
            <div class="page-breadcrumb pb-5">

                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            @if(Session::has('message'))
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <strong>{{ Session::get('message') }}</strong>
                                </div>
                            @endif

                            {{ Form::open(['route' => 'save-product', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}

                                    <div class="card">
                                        <div class="card-header card-title bg-cyan text-white text-center pt-4">
                                            <h3>Add Product Module</h3>
                                        </div>

                                        <div class="card-body mt-3">
                                            <div class="col-md-11 mx-auto">
                                                <div class="form-group row">
                                                    <label class="col-md-3 text-secondary font-weight-bold">Category Name</label>
                                                    <div class="col-md-9">
                                                        <select name="category_id" class="form-control" id="categoryId">
                                                            <option disabled selected>--- Select Category Name ---</option>
                                                            @foreach($categories as $category)
                                                                <option value="{{ $category->id }}" {{ $category->id == old('category_id') ? 'selected' : '' }}>{{ $category->category_name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="text-danger font-weight-bold text-monospace">{{ $errors->has('category_id') ? $errors->first('category_id') : '' }}</span>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 text-secondary font-weight-bold">Brand Name</label>
                                                    <div class="col-md-9">
                                                        <select name="brand_id" class="form-control" id="brandId">
                                                            <option disabled selected>--- Select Brand Name ---</option>
                                                            @foreach($brands as $brand)
                                                                <option value="{{ $brand->id }}" {{ $brand->id == old('brand_id') ? 'selected' : '' }}>{{ $brand->brand_name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="text-danger font-weight-bold text-monospace">{{ $errors->has('brand_id') ? $errors->first('brand_id') : '' }}</span>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 text-secondary font-weight-bold">Product Name</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="product_name" id="productName" class="form-control" value="{{ old('product_name') }}" onblur="setProductCode()">
                                                        <span class="text-danger font-weight-bold text-monospace">{{ $errors->has('product_name') ? $errors->first('product_name') : '' }}</span>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 text-secondary font-weight-bold">Product Code</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="product_code" id="productCode" class="form-control" value="{{ old('product_code') }}" readonly>
                                                        <span class="text-danger font-weight-bold text-monospace">{{ $errors->has('product_code') ? $errors->first('product_code') : '' }}</span>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 text-secondary font-weight-bold">Product Price</label>
                                                    <div class="col-md-9">
                                                        <input type="number" name="product_price" class="form-control" value="{{ old('product_price') }}">
                                                        <span class="text-danger font-weight-bold text-monospace">{{ $errors->has('product_price') ? $errors->first('product_price') : '' }}</span>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 text-secondary font-weight-bold">Product Quantity</label>
                                                    <div class="col-md-9">
                                                        <input type="number" name="product_quantity" class="form-control" value="{{ old('product_quantity') }}">
                                                        <span class="text-danger font-weight-bold text-monospace">{{ $errors->has('product_quantity') ? $errors->first('product_quantity') : '' }}</span>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 text-secondary font-weight-bold">Short Description</label>
                                                    <div class="col-md-9">
                                                        <textarea name="short_description" rows="3" class="form-control">{{ old('short_description') }}</textarea>
                                                        <span class="text-danger font-weight-bold text-monospace">{{ $errors->has('short_description') ? $errors->first('short_description') : '' }}</span>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 text-secondary font-weight-bold">Long Description</label>
                                                    <div class="col-md-9">
                                                        <textarea id="editor" name="long_description" class="form-control">{{ old('long_description') }}</textarea>
                                                        <span class="text-danger font-weight-bold text-monospace">{{ $errors->has('long_description') ? $errors->first('long_description') : '' }}</span>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 text-secondary font-weight-bold">Product Image</label>
                                                    <div class="col-md-9">
                                                        <input type="file" name="product_image" accept="image/*"/>
                                                        <br />
                                                        <span class="text-danger font-weight-bold text-monospace">{{ $errors->has('product_image') ? $errors->first('product_image') : '' }}</span>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 text-secondary font-weight-bold">Product sub Image</label>
                                                    <div class="col-md-9">
                                                        <input type="file" name="file[]" accept="image/*" multiple/>
                                                        <br />
                                                        <span class="text-danger font-weight-bold text-monospace">{{ $errors->has('file') ? $errors->first('file') : '' }}</span>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 text-secondary font-weight-bold">Publication Status</label>
                                                    <div class="col-md-9">
                                                        <label><input type="radio" name="publication_status" value="1" class="mr-2">Published</label>
                                                        <label><input type="radio" name="publication_status" value="0" class="mr-2 ml-3">Unpublished</label>
                                                        <br/>
                                                        <span class="text-danger font-weight-bold text-monospace">{{ $errors->has('publication_status') ? $errors->first('publication_status') : '' }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-footer text text-center">
                                            <input type="submit" class="btn bg-cyan btn-rounded text-white my-1" value="Save Product Information">
                                        </div>
                                    </div>

                            {{ Form::close() }}

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        function setProductCode() {
            var categoryId  = $('#categoryId').val();
            var brandId     = $('#brandId').val();
            var productName = $('#productName').val();

            $.ajax({
                url     : "get-category-brand-name/"+categoryId+'/'+brandId,
                method  : "GET",
                dataType: "JSON",
                success : function (response) {
                    //console.log(response);
                    //console.log(response.category_name);
                    //console.log(response.brand_name);

                    //var categoryName = response.category_name;
                    //var c = categoryName.slice(0,2);
                    //console.log(c.toUpperCase());

                    //var categoryName = response.category_name;
                    //var brandName = response.brand_name;
                    //var a = categoryName.slice(0,2);
                    //var b = a.toUpperCase();
                    //var c = brandName.slice(0,2);
                    //var d = c.toUpperCase();
                    //var e = productName.slice(0,2).toUpperCase();
                    //var result = b+'-'+d+'-'+e+'-'+response.lastProductId;
                    //$('#productCode').val(result);

                    var categoryName    =   response.category_name;
                    var brandName       =   response.brand_name;
                    //var idCode          =   response.lastProductId;
                    var categoryCode    =   categoryName.slice(0,2).toUpperCase();
                    var brandCode       =   brandName.slice(0,2).toUpperCase();
                    var nameCode        =   productName.slice(0,2).toUpperCase();
                    var productcode     =   categoryCode+'-'+brandCode+'-'+nameCode;
                    //var productcode     =   categoryCode+'-'+brandCode+'-'+nameCode+'-'+idCode;
                    $('#productCode').val(productcode);

                    //var categorycode    =   response.category_name.slice(0,2).toUpperCase();
                    //var brandcode       =   response.brand_name.slice(0,2).toUpperCase();
                    //var nameCode        =   productName.slice(0,2).toUpperCase();
                    //var productcode     =   categorycode+'-'+brandcode+'-'+nameCode+'-'+response.lastProductId;
                    //$('#productCode').val(productcode);
                }
            });

            //alert(categoryId);
            //alert(brandId);
            //alert(productName);
        }
    </script>

@endsection