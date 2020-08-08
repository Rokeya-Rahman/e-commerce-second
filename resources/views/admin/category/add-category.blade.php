@extends('admin.master')

@section('title')
    Add Category
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

                            {{ Form::open(['route' => 'save-category', 'method' => 'POST']) }}

                                <div class="card">
                                    <div class="card-header card-title bg-cyan text-white text-center pt-4">
                                        <h3>Add Category Module</h3>
                                    </div>

                                    <div class="card-body mt-3">
                                        <div class="col-md-11 mx-auto">
                                            <div class="form-group row">
                                                <label class="col-md-3 text-secondary font-weight-bold">Category Name</label>
                                                <div class="col-md-9">
                                                    <input type="text" name="category_name" class="form-control" value="{{ old('category_name') }}">
                                                    <span class="text-danger font-weight-bold text-monospace">{{ $errors->has('category_name') ? $errors->first('category_name') : '' }}</span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 text-secondary font-weight-bold">Category Description</label>
                                                <div class="col-md-9">
                                                    <textarea id="editor" name="category_description" class="form-control">{{ old('category_description') }}</textarea>
                                                    <span class="text-danger font-weight-bold text-monospace">{{ $errors->has('category_description') ? $errors->first('category_description') : '' }}</span>
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
                                        <input type="submit" class="btn bg-cyan btn-rounded text-white my-1" value="Save Category Information">
                                    </div>
                                </div>

                            {{ Form::close() }}

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection