@extends('admin.master')

@section('title')
    Category Details
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
                                    <h3>Category Module Details</h3>
                                </div>

                                <div class="card-body mt-3">
                                    <div class="col-md-11 mx-auto">

                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <tbody>

                                                <tr>
                                                    <td>Category Name</td>
                                                    <td>{{ $category->category_name }}</td>
                                                </tr>

                                                <tr>
                                                    <td>Category Description</td>
                                                    <td>{!! $category->category_description !!}</td>
                                                </tr>

                                                <tr>
                                                    <td>Publication Status</td>
                                                    <td>{{ $category->publication_status == 1 ? 'Published' : 'Unpublished' }}</td>
                                                </tr>

                                                </tbody>
                                            </table>

                                    </div>
                                </div>
                            </div>

                            <div class="card-footer text text-center">
                                <a href="{{ route('manage-category') }}" class="btn btn-rounded btn-cyan" title="Back to manage category"><i class="fas fa-backward mr-2"></i>Back</a>
                                <a href="{{ route('edit-category', ['id' => $category->id]) }}" class="btn btn-rounded btn-cyan" title="Edit category"><i class="far fa-edit mr-2"></i>Edit</a>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection