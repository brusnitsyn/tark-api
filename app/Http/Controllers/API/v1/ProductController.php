<?php

namespace App\Http\Controllers\API\v1;

use App\Data\ProductData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Resources\Product\ProductResource;
use App\Models\OrgUser;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->filled('search')) {
            $products = Product::search($request->search)->get();
        } else {
            $products = Product::all();
        }
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Product\ProductStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request, ProductService $service)
    {
        $data = ProductData::fromRequest($request);

        $product = $service->store($data);

        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $user = Auth()->user();
        $orgUser = OrgUser::where('user_id', $user->id)->first();

        if ($product->pub_user_id == $user->id || $product->pub_org_id == $orgUser->org_id)
            $product->delete();
    }

    public function getProductByOrgId()
    {
        $user = Auth()->user();
        $orgUser = OrgUser::where('user_id', $user->id)->first();
        $products = Product::where('pub_org_id', $orgUser->org_id)->get();
        return ProductResource::collection($products);
    }
}
