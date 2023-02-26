<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ImageResource;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ImageController extends Controller
{
    public function index()
    {
        $images = Image::orderBy('id','desc')->paginate();
        return ImageResource::collection($images);
    }

    protected function uploadFile(Request $request)
    {
        $uploadFile = $request->file;

        $size = $uploadFile->getSize();
        $filename = $uploadFile->getClientOriginalName();
        $extension = $uploadFile->getClientOriginalExtension();
        $mimetype = $uploadFile->getMimeType();

        $newName =  date("Y-m-d") . "-" . uniqid('', false) . "." . $extension;
        if (file_exists(public_path("/assets/images/".$filename))) {
            $filename = $newName;
        }

        $request->file->move(public_path('/assets/images'), $filename);

        $image = new Image();
        $image->filename = $filename;
        $image->path = '/assets/images/' . $filename;
        $image->extension = $extension;
        $image->mime = $mimetype;
        $image->size = $size;
        $image->save();
        return $image->id;
    }

    public function destroy(Image $image)
    {
        try {

            if ($image->delete()) {
                unlink(public_path($image->path));
                return response()->json(['message' =>'Image deleted successfully']);
            } else {
                return response()->json(['message' =>"There was a problem deleting the image."], 500);
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

}
