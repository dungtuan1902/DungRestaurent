<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    protected function UploadImage($nameFolder, $file)
    {
        $fileName = time() . '_' . $file->getClientOriginalName();
        return $file->storeAs($nameFolder, $fileName, 'public');
    }

    protected function UploadMultiImage($folder, $images): array
    {
        $arr_images = [];
        foreach ($images as $image) {
            $image_path = $this->UploadImage($folder, $image);
            $arr_images[] = $image_path;
        }
        return $arr_images;
    }
    protected function DeleteImage($image)
    {
        $deleteImage = Storage::delete('/public/' . $image);
        return $deleteImage;
    }
    public function SideBar()
    {
        return Department::all();
    }
}
