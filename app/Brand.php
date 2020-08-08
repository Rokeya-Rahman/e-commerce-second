<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = ['brand_name', 'brand_description', 'publication_status'];

    public static function saveBrandValidation($request)
    {
        $request->validate([
            'brand_name'            =>   'required|regex:/(^([a-zA-Z _]+)(\d+)?$)/u|max:30|min:3',
            'brand_description'     =>   'required|max:300',
            'publication_status'    =>   'required'
        ]);
    }

    public static function saveBrandInformation($request)
    {
        $brand = new Brand();
        $brand->brand_name           =   $request->brand_name;
        $brand->brand_description    =   $request->brand_description;
        $brand->publication_status   =   $request->publication_status;
        $brand->save();
    }

    public static function unpublishedBrandInformation($request)
    {
        $brand = Brand::find($request->id);
        $brand->publication_status = 0;
        $brand->save();
    }

    public static function publishedBrandInformation($request)
    {
        $brand = Brand::find($request->id);
        $brand->publication_status = 1;
        $brand->save();
    }

    public static function updateBrandInformation($request)
    {
        $brand = Brand::find($request->id);
        $brand->brand_name          = $request->brand_name;
        $brand->brand_description   = $request->brand_description;
        $brand->publication_status  = $request->publication_status;
        $brand->save();
    }
}
