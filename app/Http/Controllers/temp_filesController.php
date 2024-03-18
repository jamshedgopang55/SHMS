<?php

namespace App\Http\Controllers;

use App\Models\temp_file;
use Illuminate\Http\Request;

class temp_filesController extends Controller
{
    public function create(Request $request)
    {


        $images = $request->file('images');
        $uploadedImages = [];

        foreach ($images as $image) {
            if (!empty($image)) {
                $ext = $image->getClientOriginalExtension();
                $newName = time() . '_' . mt_rand() . '.' . $ext;
                $image->move(public_path('temp'), $newName);

                $tempImage = new temp_file();
                $tempImage->source = $newName;
                $tempImage->save();

                $uploadedImages[] = [
                    'image_id' => $tempImage->id,
                    'image_path' => asset('temp/' . $newName),
                    'ext' => $ext,
                ];
            }
        }
        return response()->json([
            'status' => true,
            'images' => $uploadedImages,
            'message' => 'Images uploaded successfully',
        ]);


        // if ($request->hasFile('image')) {
        //     $image = $request->file('image');
        //     $ext = $image->getClientOriginalExtension();

        //     $newName = time() . '.' . $ext;
        //     $temImage = new temp_file();
        //     $temImage->source = $newName;
        //     $temImage->save();

        //     $image->move(public_path('temp'), $newName);

        //     return response()->json([
        //         'status' => true,
        //         'ext' => $ext,
        //         'image_id' => $temImage->id,
        //         'image_path' => asset('temp/' . $newName),
        //         'message' => 'Image uploaded successfully'
        //     ]);
        // } else {
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'No image uploaded'
        //     ], 400);
        // }
    }
}
