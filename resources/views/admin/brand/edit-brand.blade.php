@extends('admin.master')

@section('title')
    Edit Brand
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

                            {{ Form::open(['route' => 'update-brand', 'method' => 'POST']) }}

                                <div class="card">
                                    <div class="card-header card-title bg-cyan text-white text-center pt-4">
                                        <h3>Update Blade Module</h3>
                                    </div>

                                    <div class="card-body mt-3">
                                        <div class="col-md-11 mx-auto">
                                            <div class="form-group row">
                                                <label class="col-md-3 text-secondary font-weight-bold">Brand Name</label>
                                                <div class="col-md-9">
                                                    <input type="text" name="brand_name" class="form-control" value="{{ $brand->brand_name }}">
                                                    <input type="hidden" name="id" class="form-control" value="{{ $brand->id }}">
                                                    <span class="text-danger font-weight-bold text-monospace">{{ $errors->has('brand_name') ? $errors->first('brand_name') : '' }}</span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 text-secondary font-weight-bold">Brand Description</label>
                                                <div class="col-md-9">
                                                    <textarea id="editor" name="brand_description" class="form-control">{{ $brand->brand_description }}</textarea>
                                                    <span class="text-danger font-weight-bold text-monospace">{{ $errors->has('brand_description') ? $errors->first('brand_description') : '' }}</span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 text-secondary font-weight-bold">Publication Status</label>
                                                <div class="col-md-9">
                                                    <label><input type="radio" name="publication_status" {{ $brand->publication_status == 1 ? 'checked' : '' }} value="1" class="mr-2">Published</label>
                                                    <label><input type="radio" name="publication_status" {{ $brand->publication_status == 0 ? 'checked' : '' }} value="0" class="mr-2 ml-3">Unpublished</label>
                                                    <br/>
                                                    <span class="text-danger font-weight-bold text-monospace">{{ $errors->has('publication_status') ? $errors->first('publication_status') : '' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer text text-center">
                                        <input type="submit" class="btn bg-cyan btn-rounded text-white my-1" value="Update Category Information">
                                        <a href="{{ route('manage-brand') }}" class="btn btn-rounded btn-cyan" title="Back to manage brand"><i class="far fa-window-close mr-2"></i>Cancel</a>
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