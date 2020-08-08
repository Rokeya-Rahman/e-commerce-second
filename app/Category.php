<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['category_name', 'category_description', 'publication_status'];

    public static function saveCategoryValidation($request)
    {
        $request->validate([
            'category_name'         =>   'required|regex:/(^([a-zA-Z _]+)(\d+)?$)/u|max:30|min:3',
            'category_description'  =>   'required|max:300',
            'publication_status'    =>   'required'
        ]);
    }

    public static function saveCategoryInformation($request)
    {
        $category   =   new Category();
        $category->category_name        =   $request->category_name;
        $category->category_description =   $request->category_description;
        $category->publication_status   =   $request->publication_status;
        $category->save();
    }

    public static function unpublishedCategoryInformation($request)
    {
        $category = Category::find($request->id);
        $category->publication_status = 0;
        $category->save();
    }

    public static function publishedCategoryInformation($request)
    {
        $category = Category::find($request->id);
        $category->publication_status = 1;
        $category->save();
    }

    public static function updateCategoryInformation($request)
    {
        $category = Category::find($request->id);
        $category->category_name        = $request->category_name;
        $category->category_description = $request->category_description;
        $category->publication_status   = $request->publication_status;
        $category->save();
    }


}
