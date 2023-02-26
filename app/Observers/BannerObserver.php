<?php

namespace App\Observers;

use App\Models\Banner;

class BannerObserver
{
    /**
     * Handle the Banner "created" event.
     *
     * @param  \App\Models\Banner  $banner
     * @return void
     */
    public function created(Banner $banner)
    {
        //
    }

    /**
     * Handle the Banner "updated" event.
     *
     * @param  \App\Models\Banner  $banner
     * @return void
     */
    public function updated(Banner $banner)
    {
        //
    }

    /**
     * Handle the Banner "deleted" event.
     *
     * @param  \App\Models\Banner  $banner
     * @return void
     */
    public function deleted(Banner $banner)
    {
        $banner->entity()->delete();
    }

    /**
     * Handle the Banner "restored" event.
     *
     * @param  \App\Models\Banner  $banner
     * @return void
     */
    public function restored(Banner $banner)
    {
        //
    }

    /**
     * Handle the Banner "force deleted" event.
     *
     * @param  \App\Models\Banner  $banner
     * @return void
     */
    public function forceDeleted(Banner $banner)
    {
        //
    }
    public function saved(Banner $banner)
    {
        $newImage = request('image') ? +request('image') : null;
        $imageOldId =  $banner->entity ? $banner->entity->image_id : null;
        if ($banner->entity &&  is_null($newImage)) {
            return $banner->entity()->where('image_id', '=', $imageOldId)->delete();
        }
        if ($newImage) {
            $banner->entity()->updateOrCreate([], ['image_id' => request('image')]);
        }
    }
}
