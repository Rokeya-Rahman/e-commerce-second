@extends('admin.master')

@section('title')
    Manage Category
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
                                        <h3>Manege Category Module</h3>
                                    </div>

                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="zero_config" class="table table-striped table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Serial No.</th>
                                                    <th>Category Name</th>
                                                    <th>Publication Status</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php($i = 1)
                                                @foreach($categories as $category)

                                                    <tr>
                                                        <td>{{ $i++ }}</td>
                                                        <td>{{ $category->category_name }}</td>

                                                        <td>{{ $category->publication_status ==1 ? 'Published' : 'Unpublished' }}</td>
                                                        <td>
                                                            <a href="{{ route('category-details', ['id' => $category->id]) }}" class="btn btn-rounded btn-sm btn-info mr-1" title="View Details"><i class="fas fa-folder-plus"></i></a>

                                                            @if($category->publication_status == 1)
                                                                <a href=""
                                                                   onclick="event.preventDefault(); document.getElementById('unpublishedCategory'+'{{ $category->id }}').submit();"
                                                                   class="btn btn-rounded btn-sm btn-success mr-1" title="Published"><i class="fas fa-sort-amount-up"></i>
                                                                    <form id="unpublishedCategory{{ $category->id }}" action="{{ route('unpublished-category')}}" method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="id" value="{{ $category->id }}"/>
                                                                    </form>
                                                                </a>
                                                            @else
                                                                <a href=""
                                                                   onclick="event.preventDefault(); document.getElementById('publishedCategory'+'{{ $category->id }}').submit();"
                                                                   class="btn btn-rounded btn-sm btn-warning mr-1" title="Unpublished"><i class="fas fa-sort-amount-down"></i>
                                                                    <form id="publishedCategory{{ $category->id }}" action="{{ route('published-category')}}" method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="id" value="{{ $category->id }}"/>
                                                                    </form>
                                                                </a>
                                                            @endif

                                                            <a href="{{ route('edit-category', ['id' => $category->id]) }}" class="btn btn-rounded btn-sm btn-primary mr-1" title="Edit"><i class="far fa-edit"></i></a>

                                                            <a href=""
                                                               onclick="event.preventDefault();
                                                               var check = confirm('Are you sure to delete this category');
                                                               if (check) {
                                                                   document.getElementById('deleteCategory'+'{{ $category->id }}').submit();
                                                               }"
                                                               class="btn btn-rounded btn-sm btn-danger" title="delete"><i class="fas fa-trash-restore"></i>
                                                                <form id="deleteCategory{{ $category->id }}" action="{{ route('delete-category') }}" method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="id" value="{{ $category->id }}"/>
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