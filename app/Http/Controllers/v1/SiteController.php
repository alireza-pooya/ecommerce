<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class SiteController extends Controller
{
    /**
     * @param Request $request
     * @return string|null
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ajaxupload(Request $request)  ///upload with cropper from panel
    {
        $this->validate(request() , [
            'file' => 'required|Image',
        ]);
        $cropped_value = $request->input("cropped_value"); //// Width,height,x,y
        $cp_v = explode("," ,$cropped_value); /// Explode width,height,x etc
        $file = $request->file('file');
        $type = $request->input('cropped_type');
        if ($file) {
            $file_name = time().'-'.str_replace(' ','',$file->getClientOriginalName());
            $img = Image::make($file->getRealPath());
            $path1 = 'upload/'.$type.'/'.$file_name; ///  Cropped Image Path
            $img->crop($cp_v[0],$cp_v[1],$cp_v[2],$cp_v[3]); // Crop
            $img->resize(1024, null, function ($constraint) {$constraint->aspectRatio();$constraint->upsize();})
                    ->save($path1);  /// save

            return $file_name;
        }
        else
            return null;
    }
}
