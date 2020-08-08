<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function addBrand()
    {
        return view('admin.brand.add-brand');
    }

    public function saveBrand(Request $request)
    {
        Brand::saveBrandValidation($request);
        Brand::saveBrandInformation($request);
        return redirect('brand/add-brand')->with('message', 'Brand information save successfully.');
    }

    public function manageBrand()
    {
        return view('admin.brand.manage-brand');
    }

    public function brandDetails($id)
    {
        return view('admin.brand.brand-details', ['brand' => Brand::find($id)]);
    }

    public function unpublishedBrand(Request $request)
    {
        Brand::unpublishedBrandInformation($request);
        return redirect('brand/manage-brand')->with('message', 'Brand information unpublished successfully.');
    }

    public function publishedBrand(Request $request)
    {
        Brand::publishedBrandInformation($request);
        return redirect('brand/manage-brand')->with('message', 'Brand information published successfully.');
    }

    public function editBrand($id)
    {
        return view('admin.brand.edit-brand', ['brand' => Brand::find($id)]);
    }

    public function updateBrand(Request $request)
    {
        Brand::saveBrandValidation($request);
        Brand::updateBrandInformation($request);
        return redirect('brand/manage-brand')->with('message', 'Brand information updated successfully.');
    }

    public function deleteBrand(Request $request)
    {
        $category = Brand::find($request->id);
        $category->delete();
        return redirect('brand/manage-brand')->with('message', 'Brand information delete successfully.');
    }
}
