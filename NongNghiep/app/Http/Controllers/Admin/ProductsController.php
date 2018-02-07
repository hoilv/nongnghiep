<?php

namespace App\Http\Controllers\Admin;

use App\Models\CategoriesProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function registerCategoryProduct()
    {
        $categoryProducts = CategoriesProduct::all();
        return view('admin.register_category_product', ['categoryProducts' => $categoryProducts]);
    }

    public function saveCategoryProduct(Request $request)
    {
        if ($request['name_category_prd'] == '') {
            return redirect()->route('register_category_product');
        }
        CategoriesProduct::create([
            'name' => $request['name_category_prd'],
            'slug' => str_slug($request['name_category_prd']),
        ]);
        return redirect()->route('register_category_product');
    }

    public function deleteCategoryProduct($id)
    {
        $categoryProduct = CategoriesProduct::find($id);

        $categoryProduct->delete();

        return redirect()->route('register_category_product');
    }

    public function showEditCategoryProduct($id)
    {
        $categoryProduct = CategoriesProduct::where('id', $id)->first();
        if (empty($categoryProduct)) {
            return redirect()->route('admin_top');
        }
        $categoryProducts = CategoriesProduct::all();
        return view('admin.edit_category_product', [
            'categoryProducts' => $categoryProducts,
            'categoryProduct' => $categoryProduct
        ]);
    }

    public function editCategoryProduct(Request $request)
    {
        $categoryProduct = CategoriesProduct::where('id', $request['id_category_prd'])->first();
        if (empty($categoryProduct)) {
            return redirect()->route('admin_top');
        }
        CategoriesProduct::where('id', $request['id_category_prd'])
            ->update(['name' => $request['name_category_prd']]);

        return redirect()->route('register_category_product');
    }

    public function registerProduct()
    {
        $productCategory = CategoriesProduct::all();
        return view('admin.register_product',[
            'productCategory' => $productCategory
        ]);
    }

    public function saveProduct(Request $request)
    {
        var_dump($request->all());
    }
}
