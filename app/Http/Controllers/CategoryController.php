<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function addCategory()
    {
        return view('admin.category.add-category');
    }

    public function saveCategory(Request $request)
    {
        Category::saveCategoryValidation($request);
        Category::saveCategoryInformation($request);

        return redirect('category/add-category')->with('message', 'Category information save successfully.');
    }

    public function manageCategory()
    {
        return view('admin.category.manage-category');
    }

    public function categoryDetails($id)
    {
        return view('admin.category.category-details', ['category' => Category::find($id)]);
    }

    public function unpublishedCategory(Request $request)
    {
        Category::unpublishedCategoryInformation($request);
        return redirect('category/manage-category')->with('message', 'Category information unpublished successfully.');
    }

    public function publishedCategory(Request $request)
    {
        Category::publishedCategoryInformation($request);
        return redirect('category/manage-category')->with('message', 'Category information published successfully.');
    }

    public function editCategory($id)
    {
        return view('admin.category.edit-category', ['category' => Category::find($id)]);
    }

    public function updateCategory(Request $request)
    {
        Category::saveCategoryValidation($request);
        Category::updateCategoryInformation($request);
        return redirect('category/manage-category')->with('message', 'Category information updated successfully.');
    }

    public function deleteCategory(Request $request)
    {
        $category = Category::find($request->id);
        $category->delete();
        return redirect('category/manage-category')->with('message', 'Category information delete successfully.');
    }
}
