<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Product;
use App\SubImage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function addProduct()
    {
        return view('admin.product.add-product');
    }

    public function saveProduct(Request $request)
    {
        Product::saveProductValidation($request);
        Product::saveProductInformation($request);
        //return redirect()->back();
        return redirect('/product/add-product')->with('message', 'Product information save successfully.');
    }

    public function getCategoryBrandName($categoryId, $brandId)
    {
        //$lastProductId = Product::ordeyBy('id', 'DESC')->first()->id;
        $result = [
            'category_name' =>  Category::find($categoryId)->category_name,
            'brand_name'    =>  Brand::find($brandId)->brand_name,
            //'lastProductId' =>  Product::orderBy('id', 'DESC')->first()->id+1
            //'lastProductId' =>  ($lastProductId+1)
        ];
        return json_encode($result);
    }

    public function manageProduct()
    {
        return view('admin.product.manage-product');
    }

    public function productDetails($id)
    {
        return view('admin.product.product-details', [
            'product'   =>  Product::find($id)
        ]);
    }

    public function unpublishedProduct(Request $request)
    {
        Product::unpublishedProductInformation($request);
        return redirect('/product/manage-product')->with('message', 'Product information unpublished successfully.');
    }

    public function publishedProduct(Request $request)
    {
        Product::publishedProductInformation($request);
        return redirect('/product/manage-product')->with('message', 'Product information published successfully.');
    }

    public function editProduct($id)
    {
        return view('admin.product.edit-product', [
            'product'   =>  Product::find($id),
            'subImages' =>  SubImage::where('product_id', $id)->get()
        ]);
    }

    public function updateProduct(Request $request)
    {
        Product::updateProductInformation($request);
        return redirect('/product/manage-product')->with('message', 'Product information update successfully.');
    }

    public function editCategoryBrandName($editProductId, $editCategoryId, $editBrandId)
    {
        //$lastProductId = Product::ordeyBy('id', 'DESC')->first()->id;
        $edit = [
            'product_id'    =>  $editProductId,
            'category_name' =>  Category::find($editCategoryId)->category_name,
            'brand_name'    =>  Brand::find($editBrandId)->brand_name,
            //'lastProductId' =>  Product::orderBy('id', 'DESC')->first()->id+1
            //'lastProductId' =>  ($lastProductId+1)
        ];
        return json_encode($edit);
    }

    public function deleteProduct(Request $request)
    {
        Product::deleteProductInformation($request);
        return redirect('/product/manage-product')->with('message', 'Product information delete successfully.');
    }
}
