<?php

namespace App\Observers;

use App\Models\Category;

class CategoryObserver
{
    /**
     * Handle the Category "created" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function created(Category $category)
    {
        //
    }

    /**
     * Handle the Category "updated" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function updated(Category $category)
    {
        //
    }

    /**
     * Handle the Category "deleted" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function deleted(Category $category)
    {
        $category->entity()->delete();

    }

    /**
     * Handle the Category "restored" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function restored(Category $category)
    {
        //
    }

    /**
     * Handle the Category "force deleted" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function forceDeleted(Category $category)
    {
        //
    }
    public function saved(Category $category)
    {
        $newImage = request('image') ? +request('image') : null;
        $imageOldId =  $category->entity ? $category->entity->image_id : null;
        if ($category->entity &&  is_null($newImage)) {
            return $category->entity()->where('image_id', '=', $imageOldId)->delete();
        }
        if ($newImage) {
            $category->entity()->updateOrCreate([], ['image_id' => request('image')]);
        }
    }
}
