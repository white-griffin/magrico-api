<?php

namespace App\Http\Controllers\Api;

use App\Constants\Constant;
use App\Helpers\Api\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoriesResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    public function productCategories()
    {
        $categories = CategoriesResource::collection(
            Category::where('type',Constant::PRODUCT)
                ->whereNull('parent_id')
                ->where('status',Constant::ACTIVE)
                ->get()
        );

        return ApiResponse::Success('',$categories);
    }

    public function blogCategories()
    {
        $categories = CategoriesResource::collection(
            Category::where('type',Constant::BLOG)
                ->whereNull('parent_id')
                ->where('status',Constant::ACTIVE)
                ->get()
        );

        return ApiResponse::Success('',$categories);
    }

    public function single()
    {
        $category = Category::findOrFail(request('category_id'));

        return ApiResponse::Success('',[
            'id' => $category->id,
            'parent_id' => $category->parent_id,
            'title' => $category->title,
			'description' => $category->description,
            'slug' => $category->slug,
            'image' => $category->apiPresent()->image,
            'products' => $this->getProducts($category),
            'sub_categories' => CategoriesResource::collection(
                $category->subCategories
            ),
            'meta_title' => $category->meta_title,
            'meta_description' => $category->meta_description
        ]);
    }

    public function detail($slug)
    {
        $category = Category::where('slug',$slug)->first();

        return ApiResponse::Success('',[
            'id' => $category->id,
            'parent_id' => $category->parent_id,
            'title' => $category->title,
			'description' => $category->description,
            'slug' => $category->slug,
            'image' => $category->apiPresent()->image,
            'products' => $this->getProducts($category),
            'sub_categories' => CategoriesResource::collection(
                $category->subCategories
            ),
            'meta_title' => $category->meta_title,
            'meta_description' => $category->meta_description
        ]);
    }

    private function getProducts($category)
    {
        $allCategoryIds = $category->allCategoryIds();
        return ProductResource::collection(Product::whereIn('category_id', $allCategoryIds)->where('status',Constant::ACTIVE)->get());
    }
}
