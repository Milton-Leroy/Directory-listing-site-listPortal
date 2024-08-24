<?php

namespace App\Traits;

use File;
use Illuminate\Http\Request;

trait FileUploadTrait
{
    function uploadImage(Request $request, string $inputName, ?string $oldPath = "null", string $path = "/uploads"): ?string
    {
        if ($request->hasFile($inputName)) {
            $image = $request->{$inputName};
            $ext = $image->getClientOriginalExtension();
            $imageName = 'media_' . uniqid() .  '.' . $ext;

            $image->move(public_path($path), $imageName);

            //Delete previous image from storage

            $excludedFolder = '/default';

            if ($oldPath && File::exists(public_path($oldPath)) && strpos($oldPath, $excludedFolder) !== 0) {
                File::delete(public_path($oldPath));
            }

            return $path . '/' . $imageName;
        }

        return null;
    }
    function uploadMultipleImage(Request $request, string $inputName, string $path = "/uploads"): ?array
    {
        if ($request->hasFile($inputName)) {

            $images = $request->{$inputName};

            $paths = [];

            foreach ($images as $image) {
                $ext = $image->getClientOriginalExtension();
                $imageName = 'media_' . uniqid() .  '.' . $ext;

                $image->move(public_path($path), $imageName);

                $paths[] = $path . '/' . $imageName;
            }

            return $paths;
        }

        return null;
    }

    function deleteFile($path): void
    {
        $excludedFolder = '/default';

        if ($path && File::exists(public_path($path)) && strpos($path, $excludedFolder) !== 0) {
            File::delete(public_path($path));
        }
    }
}
