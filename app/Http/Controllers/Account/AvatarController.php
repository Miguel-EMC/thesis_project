<?php

namespace App\Http\Controllers\Account;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;

class AvatarController extends Controller
{
    public function store(Request $request)
    {
        // dd($request);
        // Validación de los datos de entrada
        $request->validate([
            'image' => ['required', 'image', 'mimes:jpg,png,jpeg', 'max:512'],
        ]);

        // Se obtiene el usario que esta haciendo el Request
        $user = $request->user();
        $file = $request->file('image');
        $obj = Cloudinary::upload($file->getRealPath(), ['folder' => 'avatars']);
        $image_url = $obj->getSecurePath();

        // Se hace uso del Trait para asociar esta imagen con el modelo user
        $user->attachImage($image_url);

        return $this->sendResponse('Avatar updated successfully');
    }

}
