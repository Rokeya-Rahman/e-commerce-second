<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;
use File;

class Product extends Model
{
    protected $fillable = ['category_id', 'brand_id', 'product_name', 'product_code', 'product_price', 'product_quantity', 'short_description', 'long_description', 'product_image', 'publication_status', 'hit_count'];

    public static function saveProductValidation($request)
    {
        $request->validate([
            'category_id'           => 'required',
            'brand_id'              => 'required',
            'product_name'          => 'required|regex:/(^([a-zA-Z _]+)(\d+)?$)/u|max:30|min:3',
            'product_code'          => 'required',
            'product_price'         => 'required',
            'product_quantity'      => 'required',
            'short_description'     => 'required|max:300',
            'long_description'      => 'required|max:1000',
            'product_image'         => 'required',
            'file'                  => 'required',
            'publication_status'    => 'required',
        ]);
    }

    public static function saveProductInformation($request)
    {
        /*$productImage = $request->file('product_image');
        $imageName = $productImage->getClientOriginalName();
        $directory = './product-images/';
        $productImage->move($directory, $imageName);
        $imageUrl = $directory.$imageName;*/

        /*$productImage = $request->file('product_image');
        $fileType = $productImage->getClientOriginalExtension();
        $imageName = $request->product_name.'.'.$fileType;
        $directory = './product-images/';
        $productImage->move($directory, $imageName);
        $imageUrl = $directory.$imageName;*/

        $productImage   =   $request->file('product_image');
        $fileType       =   $productImage->getClientOriginalExtension();
        $imageName      =   $request->product_name.'.'.$fileType;
        $directory      =   './product-images/';
        if (!File::isDirectory($directory))
        {
            File::makeDirectory($directory, true);
        }
        $imageUrl = $directory.$imageName;

        Image::make($productImage)->resize(800, 450)->save($imageUrl);

        $product = new Product();
        $product->category_id           =   $request->category_id;
        $product->brand_id              =   $request->brand_id;
        $product->product_name          =   $request->product_name;
        $product->product_code          =   $request->product_code;
        $product->product_price         =   $request->product_price;
        $product->product_quantity      =   $request->product_quantity;
        $product->short_description     =   $request->short_description;
        $product->long_description      =   $request->long_description;
        $product->product_image         =   $imageUrl;
        $product->publication_status    =   $request->publication_status;
        $product->save();

        $productCode = Product::find($product->id);
        $productCode->product_code      =   $productCode->product_code.'-'.$product->id;
        $productCode->update();

        $files = $request->file('file');
        $i = 1;
        foreach ($files as $file)
        {
            /*$newImageName = $file->getClientOriginalName();
            $newDirectory = './product-sub-images/';
            $file->move($newDirectory, $newImageName);
            $imagePath = $newDirectory.$newImageName;*/

            /*$fileType = $file->getClientOriginalExtension();
            $newImageName = $request->product_name.$i++.'.'.$fileType;
            $newDirectory = './product-sub-image/';
            $file->move($newDirectory, $newImageName);
            $imagePath = $newDirectory.$newImageName;*/

            $fileType       =   $file->getClientOriginalExtension();
            $newImageName   =   $request->product_name.'_'.$i++.'.'.$fileType;
            $newDirectory   =   './product-sub-image/';
            if (!File::isDirectory($newDirectory)) {
                File::makeDirectory($newDirectory, true);
            }
            $imagePath = $newDirectory.$newImageName;;

            Image::make($file)->resize(800, 450)->save($imagePath);

            $subImage = new SubImage();
            $subImage->product_id   =   $product->id;
            $subImage->sub_image    =   $imagePath;
            $subImage->save();
        }
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }

    public static function unpublishedProductInformation($request)
    {
        $product = Product::find($request->id);
        $product->publication_status = 0;
        $product->save();
    }

    public static function publishedProductInformation($request)
    {
        $product = Product::find($request->id);
        $product->publication_status = 1;
        $product->save();
    }

    public static function updateProductInformation($request)
    {
        $product = Product::where('id', $request->id)->first();
        $productImage   =   $request->file('product_image');

        if ($productImage) {
            unlink($product->product_image);
            $fileType       =   $productImage->getClientOriginalExtension();
            $imageName      =   $request->product_name.'.'.$fileType;
            $directory      =   './product-images/';
            if (!File::isDirectory($directory)) {
                File::makeDirectory($directory, true);
            }
            $imageUrl = $directory.$imageName;

            Image::make($productImage)->resize(800, 450)->save($imageUrl);

        }
        $product->category_id           =   $request->category_id;
        $product->brand_id              =   $request->brand_id;
        $product->product_name          =   $request->product_name;
        $product->product_code          =   $request->product_code;
        $product->product_price         =   $request->product_price;
        $product->product_quantity      =   $request->product_quantity;
        $product->short_description     =   $request->short_description;
        $product->long_description      =   $request->long_description;
        if ($productImage)
        {
            $product->product_image     =   $imageUrl;
        }
        $product->publication_status    =   $request->publication_status;
        $product->save();

        /*$productCode = Product::find($product->id);
        $productCode->product_code      =   $productCode->product_code.'-'.$product->id;
        $productCode->update();*/

        $subImages = SubImage::where('product_id', $request->id)->get();
        $files = $request->file('file');
        $i = 1;
        if ($files) {
            foreach ($subImages as $subImage) {
                unlink($subImage->sub_image);
            }

            foreach ($files as $file)
            {
                $fileType       =   $file->getClientOriginalExtension();
                $newImageName   =   $request->product_name.'_'.$i++.'.'.$fileType;
                $newDirectory   =   './product-sub-image/';
                if (!File::isDirectory($newDirectory)) {
                    File::makeDirectory($newDirectory, true);
                }
                $imagePath = $newDirectory.$newImageName;;

                Image::make($file)->resize(800, 450)->save($imagePath);

                $subImage->product_id       =   $product->id;
                if ($imagePath)
                {
                    $subImage->sub_image    =   $imageUrl;
                }
                $subImage->save();
            }
        }
    }

    public static function deleteProductInformation($request)
    {
        $product = Product::find($request->id);
        $subImages = SubImage::where('product_id', $request->id)->get();
        if (file_exists($product->product_image)) {
            unlink($product->product_image);
        }
        foreach ($subImages as $subImage) {
            if (file_exists($subImage->sub_image)) {
                unlink($subImage->sub_image);
            }
            $subImage->delete();
        }
        $product->delete();
    }
}
