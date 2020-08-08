@extends('admin.master')

@section('title')
    Product Details
@endsection

@section('body')

    <div id="main-wrapper">
        <div class="page-wrapper">
            <div class="page-breadcrumb pb-5">

                <div class="container">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="card">
                                <div class="card-header card-title bg-cyan text-white text-center pt-4">
                                    <h3>Product Module Details</h3>
                                </div>

                                <div class="card-body mt-3">
                                    <div class="col-md-11 mx-auto">

                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <tbody>

                                                <tr>
                                                    <td>Category Name</td>
                                                    <td>{{ $product->category_id}}</td>
                                                </tr>

                                                <tr>
                                                    <td>Category Name</td>
                                                    <td>{{ $product->category->category_name }}</td>
                                                </tr>

                                                <tr>
                                                    <td>Brand Name</td>
                                                    <td>{{ $product->brand_id }}</td>
                                                </tr>

                                                <tr>
                                                    <td>Brand Name</td>
                                                    <td>{{ $product->brand->brand_name }}</td>
                                                </tr>

                                                <tr>
                                                    <td>Product Name</td>
                                                    <td>{{ $product->product_name }}</td>
                                                </tr>

                                                <tr>
                                                    <td>Product Code</td>
                                                    <td>{{ $product->product_code }}</td>
                                                </tr>

                                                <tr>
                                                    <td>Product Price</td>
                                                    <td>{{ $product->product_price }}</td>
                                                </tr>

                                                <tr>
                                                    <td>Product Quantity</td>
                                                    <td>{{ $product->product_quantity }}</td>
                                                </tr>

                                                <tr>
                                                    <td>Product Short Description</td>
                                                    <td>{!! $product->short_description !!}</td>
                                                </tr>

                                                <tr>
                                                    <td>Product Long Description</td>
                                                    <td>{!! $product->long_description !!}</td>
                                                </tr>

                                                <tr>
                                                    <td>Product Image</td>
                                                    <td>
                                                        <img src="{{ asset($product->product_image) }}" alt="{{ $product->product_name }}" height="100" width="200"/>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>Product Sub Image</td>
                                                    <td>
                                                        <?php $productSubImages = \App\SubImage::where('product_id', $product->id)->get(); ?>
                                                        @foreach($productSubImages as $productSubImage)
                                                            <img src="{{ asset($productSubImage->sub_image) }}" alt="{{ $product->product_name }}" height="100" width="200" class="mb-3"/> |||
                                                        @endforeach
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>Publication Status</td>
                                                    <td>{{ $product->publication_status == 1 ? 'Published' : 'Unpublished' }}</td>
                                                </tr>

                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer text text-center">
                                    <a href="{{ route('manage-product') }}" class="btn btn-rounded btn-cyan" title="Back to manage product"><i class="fas fa-backward mr-2"></i>Back</a>
                                    <a href="{{ route('edit-product', ['id' => $product->id]) }}" class="btn btn-rounded btn-cyan" title="Edit Product"><i class="far fa-edit mr-2"></i>Edit</a>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

@endsection