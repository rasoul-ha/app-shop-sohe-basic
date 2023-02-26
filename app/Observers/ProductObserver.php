<?php

namespace App\Observers;

use App\Models\Product;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function created(Product $product)
    {
        //
    }

    /**
     * Handle the Product "updated" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function updated(Product $product)
    {
        //
    }

    /**
     * Handle the Product "deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function deleted(Product $product)
    {
        $product->entity()->delete();
        $product->product_options()->delete();
    }

    /**
     * Handle the Product "restored" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function restored(Product $product)
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function forceDeleted(Product $product)
    {
        //
    }
    public function saved(Product $product)
    {
        $newImage = request('image') ? +request('image') : null;
        $imageOldId =  $product->entity ? $product->entity->image_id : null;
        if ($product->entity &&  is_null($newImage)) {
            return $product->entity()->where('image_id', '=', $imageOldId)->delete();
        }
        if ($newImage) {
            $product->entity()->updateOrCreate([], ['image_id' => request('image')]);
        }
    }
}
