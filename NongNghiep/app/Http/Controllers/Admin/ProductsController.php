<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EditProductRequest;
use App\Http\Requests\SaveProductRequest;
use App\Models\CategoriesProduct;
use App\Models\ItemProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

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

    public function saveProduct(SaveProductRequest $request)
    {
        $image = $request->file('fileToUpload');
        $filename = time() . '.' . $image->extension();
        $image->move('upload/', $filename);

        ItemProduct::create([
            'category_product_id' => $request['select_cate_prd'] or null,
            'content' => $request['content'],
            'image' => $filename,
            'author' => $request['author'],
            'title' => $request['title_prd']
        ]);
        return redirect()->route('list_product');
    }

    public function listProduct()
    {
        $itemProducts = DB::table('items_products')
            ->where('items_products.deleted_at', null)
            ->leftJoin('categories_products', 'categories_products.id', '=', 'items_products.category_product_id')
            ->select('items_products.*', 'categories_products.name as categories_products_name')
            ->get();

        return view('admin.list_product', [
            'itemProducts' => $itemProducts
        ]);
    }

    public function deleteProduct($id)
    {
        $product = ItemProduct::find($id);
        $delete = $product->delete();
        if ($delete) {
            \Session::flash('alert-success', 'Xoá Sản Phẩm Thành Công');
        } else {
            \Session::flash('alert-warning', 'Xoá Sản Phẩm Lỗi');
        }
        return redirect()->route('list_product');
    }

    public function showEditProduct($id)
    {
        $productCategory = CategoriesProduct::all();

        $itemProducts = DB::table('items_products')
            ->where('items_products.id', $id)
            ->where('items_products.deleted_at', null)
            ->leftjoin('categories_products', 'categories_products.id', '=', 'items_products.category_product_id')
            ->select('items_products.*', 'categories_products.name as categories_products_name')
            ->first();

        if (isset($itemProducts) && !empty($itemProducts)) {
            $itemProducts = (array) $itemProducts;
            return view('admin.edit_product', [
                'itemProducts' => $itemProducts,
                'productCategory' => $productCategory
                ]);
        }
        return redirect()->route('list_product');
    }

    public function editProduct(EditProductRequest $request)
    {

        if (!empty($request->file('fileToUpload'))) {
            $image = $request->file('fileToUpload');
            $filename = time() . '.' . $image->extension();
            $image->move('upload/', $filename);
        } else{
            $products = ItemProduct::where('id', $request['product_id'])->first();
            $filename = $products['image'];
        }

        $productEdit = ItemProduct::where('id', $request['product_id'])
            ->update([
                'category_product_id' => $request['select_cate_prd'] or null,
                'content' => $request['content'],
                'image' => $filename,
                'author' => $request['author'],
                'title' => $request['title_prd']
            ]);
        if ($productEdit) {
            \Session::flash('alert-success', 'Sửa Sản Phẩm Thành Công');
        } else {
            \Session::flash('alert-warning', 'Sửa Sản Phẩm Lỗi');
        }
        return redirect()->route('list_product');

    }
}
