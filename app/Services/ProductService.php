<?php

namespace App\Services;

use Illuminate\Support\Str;
use App\Data\ProductData;
use App\Models\Attachment;
use App\Models\OrgUser;
use App\Models\Product;
use App\Models\ProductSale;
use Illuminate\Support\Facades\Auth;

class ProductService
{
    public function store(ProductData $data)
    {
        /*
         *  Создание товара
         */

        // Пользователь компании
        $orgUser = OrgUser::where('user_id', Auth::user()->id)->first();

        $product = new Product();
        $product->name = $data->name;

        if ($data->article)
            $product->article = $data->article;

        if ($data->manufacturer)
            $product->manufacturer = $data->manufacturer;

        if ($data->machines)
            $product->machines = $data->machines;

        if ($data->desc)
            $product->desc = $data->desc;

        $product->pub_user_id = Auth::user()->id;

        $product->pub_org_id = $orgUser->org_id;
        $product->slug = Str::slug($data->name);

        $product->save();

        /*
         *  Добавить изображения
         */
        if ($data->images) {
            $product->addMediaFromRequest('images')->withResponsiveImages()->toMediaCollection('images');
            // $host = request()->root();
            // foreach ($data->images as $image) {
            //     $uploadedImagePaths = $product->upload($image, 'public', 'products');
            //     foreach ($uploadedImagePaths as $item) {
            //         $attachmentImage = new Attachment();
            //         $attachmentImage->name = $item->filename;
            //         $attachmentImage->type = $item->image->mime();
            //         $attachmentImage->url = $host . "/storage/" . $item->path;
            //         $attachmentImage->is_published = $image->is_published;

            //         $product->attachments()->save($attachmentImage);
            //     }
            // }
        }

        /*
         *  Добавить стоимость
         */
        $sale = new ProductSale();
        $sale->product_id = $product->id;
        $sale->price = (float)$data->price;
        $sale->save();

        return $product;
    }
}
