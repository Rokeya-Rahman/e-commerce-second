@extends('admin.master')

@section('title')
    Edit Product
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

                            {{ Form::open(['route' => 'update-product', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'name'=>'editProductFrom']) }}

                                <div class="card">
                                    <div class="card-header card-title bg-cyan text-white text-center pt-4">
                                        <h3>Edit Product Module</h3>
                                    </div>

                                    <div class="card-body mt-3">
                                        <div class="col-md-11 mx-auto">
                                            <div class="form-group row">
                                                <label class="col-md-3 text-secondary font-weight-bold">Category Name</label>
                                                <div class="col-md-9">
                                                    <select name="category_id" class="form-control" id="editCategoryId">
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
                                                    <select name="brand_id" class="form-control" id="editBrandId">
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
                                                    <input type="text" name="product_name" id="editProductName" class="form-control" value="{{ $product->product_name }}" onblur="editProductCode()">
                                                    <input type="hidden" name="id" class="form-control" value="{{ $product->id }}">
                                                    <span class="text-danger font-weight-bold text-monospace">{{ $errors->has('product_name') ? $errors->first('product_name') : '' }}</span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 text-secondary font-weight-bold">Product Code</label>
                                                <div class="col-md-9">
                                                    <input type="text" name="product_code" id="editproductCode" class="form-control" value="" readonly>
                                                    {{--<input type="text" name="product_code" id="editProductCode" class="form-control" value="{{ $product->product_code }}" readonly>--}}
                                                    <span class="text-danger font-weight-bold text-monospace">{{ $errors->has('product_code') ? $errors->first('product_code') : '' }}</span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 text-secondary font-weight-bold">Product Price</label>
                                                <div class="col-md-9">
                                                    <input type="number" name="product_price" class="form-control" value="{{ $product->product_price }}">
                                                    <span class="text-danger font-weight-bold text-monospace">{{ $errors->has('product_price') ? $errors->first('product_price') : '' }}</span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 text-secondary font-weight-bold">Product Quantity</label>
                                                <div class="col-md-9">
                                                    <input type="number" name="product_quantity" class="form-control" value="{{ $product->product_quantity }}">
                                                    <span class="text-danger font-weight-bold text-monospace">{{ $errors->has('product_quantity') ? $errors->first('product_quantity') : '' }}</span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 text-secondary font-weight-bold">Short Description</label>
                                                <div class="col-md-9">
                                                    <textarea name="short_description" rows="3" class="form-control">{{ $product->short_description }}</textarea>
                                                    <span class="text-danger font-weight-bold text-monospace">{{ $errors->has('short_description') ? $errors->first('short_description') : '' }}</span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 text-secondary font-weight-bold">Long Description</label>
                                                <div class="col-md-9">
                                                    <textarea id="editor" name="long_description" class="form-control">{{ $product->long_description }}</textarea>
                                                    <span class="text-danger font-weight-bold text-monospace">{{ $errors->has('long_description') ? $errors->first('long_description') : '' }}</span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 text-secondary font-weight-bold">Product Image</label>
                                                <div class="col-md-9">
                                                    <input type="file" name="product_image" accept="image/*"/>
                                                    <br />
                                                    <img src="{{ asset($product->product_image) }}" alt="{{ $product->product_name }}" height="100" width="130" class="mt-3"/>
                                                    <span class="text-danger font-weight-bold text-monospace">{{ $errors->has('product_image') ? $errors->first('product_image') : '' }}</span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 text-secondary font-weight-bold">Product sub Image</label>
                                                <div class="col-md-9">
                                                    <input type="file" name="file[]" accept="image/*" multiple/>
                                                    <br />
                                                    @foreach($subImages as $subImage)
                                                        <img src="{{ asset($subImage->sub_image) }}" alt="{{ $product->product_name }}" height="100" width="130" class="mt-3"/>
                                                    @endforeach
                                                    <span class="text-danger font-weight-bold text-monospace">{{ $errors->has('file') ? $errors->first('file') : '' }}</span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 text-secondary font-weight-bold">Publication Status</label>
                                                <div class="col-md-9">
                                                    <label><input type="radio" name="publication_status" {{ $product->publication_status == 1 ? 'checked' : '' }} value="1" class="mr-2">Published</label>
                                                    <label><input type="radio" name="publication_status" {{ $product->publication_status == 0 ? 'checked' : '' }} value="0" class="mr-2 ml-3">Unpublished</label>
                                                    <br/>
                                                    <span class="text-danger font-weight-bold text-monospace">{{ $errors->has('publication_status') ? $errors->first('publication_status') : '' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer text text-center">
                                        <input type="submit" class="btn bg-cyan btn-rounded text-white my-1" value="Update Product Information">
                                        <a href="{{ route('manage-product') }}" class="btn btn-rounded btn-cyan" title="Back to manage product"><i class="far fa-window-close mr-2"></i>Cancel</a>
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
        document.forms['editProductFrom'].elements['category_id'].value = '{{ $product->category_id }}';
        document.forms['editProductFrom'].elements['brand_id'].value = '{{ $product->brand_id }}';
    </script>

    <script>
        function editProductCode() {
            var editCategoryId  = $('#editCategoryId').val();
            var editBrandId     = $('#editBrandId').val();
            var editProductName = $('#editProductName').val();
            var editProductId   = '{{ $product->id }}';

            $.ajax({
                url     : "edit-category-brand-name/"+editProductId+'/'+editCategoryId+'/'+editBrandId,
                method  : "GET",
                dataType: "JSON",
                success : function (response) {

                    console.log(response);
                    console.log(response.category_name);
                    console.log(response.brand_name);

                    // var editCategoryName    =   response.category_name;
                    // var editBrandName       =   response.brand_name;
                    // //var idCode          =   response.lastProductId;
                    // var editCategoryCode    =   editCategoryName.slice(0,2).toUpperCase();
                    // var editBrandCode       =   editBrandName.slice(0,2).toUpperCase();
                    // var editNameCode        =   editProductName.slice(0,2).toUpperCase();
                    // var editProductcode     =   editCategoryCode+'-'+editBrandCode+'-'+editNameCode;
                    // //var productcode     =   categoryCode+'-'+brandCode+'-'+nameCode+'-'+idCode;
                    // $('#editProductCode').val(editProductcode);
                }
            });

            alert(editCategoryId);
            alert(editBrandId);
            alert(editProductName);
        }
    </script>

@endsection