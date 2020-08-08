@extends('admin.master')

@section('title')
    Manage Brand
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

                            <div class="card">
                                <div class="card-header card-title bg-cyan text-white text-center pt-4">
                                    <h3>Manege Brand Module</h3>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="zero_config" class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Serial No.</th>
                                                <th>Brand Name</th>
                                                <th>Publication Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php($i = 1)
                                            @foreach($brands as $brand)

                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $brand->brand_name }}</td>

                                                    <td>{{ $brand->publication_status ==1 ? 'Published' : 'Unpublished' }}</td>
                                                    <td>
                                                        <a href="{{ route('brand-details', ['id' => $brand->id]) }}" class="btn btn-rounded btn-sm btn-info mr-1" title="View Details"><i class="fas fa-folder-plus"></i></a>

                                                        @if($brand->publication_status == 1)
                                                            <a href=""
                                                               onclick="event.preventDefault(); document.getElementById('unpublishedBrand'+'{{ $brand->id }}').submit();"
                                                               class="btn btn-rounded btn-sm btn-success mr-1" title="Published"><i class="fas fa-sort-amount-up"></i>
                                                                <form id="unpublishedBrand{{ $brand->id }}" action="{{ route('unpublished-brand')}}" method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="id" value="{{ $brand->id }}"/>
                                                                </form>
                                                            </a>
                                                        @else
                                                            <a href=""
                                                               onclick="event.preventDefault(); document.getElementById('publishedBrand'+'{{ $brand->id }}').submit();"
                                                               class="btn btn-rounded btn-sm btn-warning mr-1" title="Unpublished"><i class="fas fa-sort-amount-down"></i>
                                                                <form id="publishedBrand{{ $brand->id }}" action="{{ route('published-brand')}}" method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="id" value="{{ $brand->id }}"/>
                                                                </form>
                                                            </a>
                                                        @endif

                                                        <a href="{{ route('edit-brand', ['id' => $brand->id]) }}" class="btn btn-rounded btn-sm btn-primary mr-1" title="Edit"><i class="far fa-edit"></i></a>

                                                        <a href=""
                                                           onclick="event.preventDefault();
                                                                   var check = confirm('Are you sure to delete this brand');
                                                                   if (check) {
                                                                   document.getElementById('deleteBrand'+'{{ $brand->id }}').submit();
                                                                   }"
                                                           class="btn btn-rounded btn-sm btn-danger" title="delete"><i class="fas fa-trash-restore"></i>
                                                            <form id="deleteBrand{{ $brand->id }}" action="{{ route('delete-brand') }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="id" value="{{ $brand->id }}"/>
                                                            </form>
                                                        </a>
                                                    </td>
                                                </tr>

                                            @endforeach
                                            </tbody>

                                            <tfoot>
                                            <tr>
                                                <th>Serial No.</th>
                                                <th>Brand Name</th>
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