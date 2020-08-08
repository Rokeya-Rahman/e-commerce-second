@extends('admin.master')

@section('title')
    Manage Product
@endsection

@section('body')

    <div id="main-wrapper">
        <div class="page-wrapper">
            <div class="page-breadcrumb pb-5">

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            @if(Session::has('message'))
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <strong>{{ Session::get('message') }}</strong>
                                </div>
                            @endif

                            <div class="card">
                                <div class="card-header card-title bg-cyan text-white text-center pt-4">
                                    <h3>Manege Product Module</h3>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="zero_config" class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Serial No.</th>
                                                <th>Category Name</th>
                                                <th>Brand Name</th>
                                                <th>Product Name</th>
                                                <th>Product Code</th>
                                                <th>Product Price</th>
                                                <th>Product Quantity</th>
                                                {{--<th>Short Description</th>--}}
                                                {{--<th>Long Description</th>--}}
                                                {{--<th>Product Image</th>--}}
                                                {{--<th>Product sub Image</th>--}}
                                                <th>Publication Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php($i = 1)
                                            @foreach($products as $product)

                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $product->category->category_name }}</td>
                                                    <td>{{ $product->brand->brand_name }}</td>
                                                    <td>{{ $product->product_name }}</td>
                                                    <td>{{ $product->product_code }}</td>
                                                    <td>{{ $product->product_price }}</td>
                                                    <td>{{ $product->product_quantity }}</td>
                                                    {{--<td>--}}
                                                        {{--<img src="{{ asset($product->product_image) }}" alt="{{ $product->product_name }}" height="70" width="100"/>--}}
                                                    {{--</td>--}}
                                                    <td>{{ $product->publication_status == 1 ? 'Published' : 'Unpublished' }}</td>

                                                    <td class="custom-control-inline">
                                                        <a href="{{ route('product-details', ['id' => $product->id]) }}" class="btn btn-rounded btn-sm btn-info mr-1" title="View Details"><i class="fas fa-folder-plus"></i></a>

                                                        @if($product->publication_status == 1)
                                                            <a href=""
                                                               onclick="event.preventDefault(); document.getElementById('unpublishedProduct'+'{{ $product->id }}').submit();"
                                                               class="btn btn-rounded btn-sm btn-success mr-1" title="Published"><i class="fas fa-sort-amount-up"></i>
                                                                <form id="unpublishedProduct{{ $product->id }}" action="{{ route('unpublished-product')}}" method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="id" value="{{ $product->id }}"/>
                                                                </form>
                                                            </a>
                                                        @else
                                                            <a href=""
                                                               onclick="event.preventDefault(); document.getElementById('publishedProduct'+'{{ $product->id }}').submit();"
                                                               class="btn btn-rounded btn-sm btn-warning mr-1" title="Unpublished"><i class="fas fa-sort-amount-down"></i>
                                                                <form id="publishedProduct{{ $product->id }}" action="{{ route('published-product')}}" method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="id" value="{{ $product->id }}"/>
                                                                </form>
                                                            </a>
                                                        @endif

                                                        <a href="{{ route('edit-product', ['id' => $product->id]) }}" class="btn btn-rounded btn-sm btn-primary mr-1" title="Edit"><i class="far fa-edit"></i></a>

                                                        <a href=""
                                                           onclick="event.preventDefault();
                                                           var check = confirm('Are you sure to delete this product');
                                                           if (check) {
                                                               document.getElementById('deleteProduct'+'{{ $product->id }}').submit();
                                                                   }"
                                                           class="btn btn-rounded btn-sm btn-danger" title="delete"><i class="fas fa-trash-restore"></i>
                                                            <form id="deleteProduct{{ $product->id }}" action="{{ route('delete-product') }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="id" value="{{ $product->id }}"/>
                                                            </form>
                                                        </a>
                                                    </td>
                                                </tr>

                                            @endforeach
                                            </tbody>

                                            <tfoot>
                                            <tr>
                                                <th>Serial No.</th>
                                                <th>Category Name</th>
                                                <th>Brand Name</th>
                                                <th>Product Name</th>
                                                <th>Product Code</th>
                                                <th>Product Price</th>
                                                <th>Product Quantity</th>
                                                {{--<th>Short Description</th>--}}
                                                {{--<th>Long Description</th>--}}
                                                {{--<th>Product Image</th>--}}
                                                {{--<th>Product sub Image</th>--}}
                                                <th>Publication Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection