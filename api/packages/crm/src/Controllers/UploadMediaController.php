<?php

namespace SHOP\CRM\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use SHOP\CRM\Models\UploadMedia;
use Error;
use Storage;

class UploadMediaController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file'      => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'user_id'   => 'required',
            'oa_id'     => 'required'
        ]);

        $authUser   = auth()->user();
        $user_id    = $request->input('user_id');
        $oa_id      = $request->input('oa_id');
        $file       = $request->file('file');

        if ($file->isValid()) {
            $fileExtension = $file->getClientOriginalExtension();
            $fileName = time() . "_" . md5($file->getFilename()) . "." . $fileExtension;
            $path = 'public/chat/'. date('Y/m/d');
            Storage::putFileAs($path, $file, $fileName);

            $url = env('APP_URL') . Storage::url($path .'/'. $fileName);

            $media = new UploadMedia();
            $media->type    = 'image';
            $media->path    = $path;
            $media->url     = $url;
            $media->oa_id   = $oa_id;
            $media->to_id   = $user_id;
            $media->status  = 1;
            $media->save();

            return $media;
        }

        throw new Error('Invalid', 500);
    }
}
