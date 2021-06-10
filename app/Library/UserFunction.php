<?php


namespace App\Library;
use Image;
use Illuminate\Support\Facades\Storage;

class UserFunction
{
    const THUMB_WIDTH = 600; //サムネの幅は600とする
    public static function ImageTrance($image)
    {

        // オリジナル画像に名前をつける
        $file_name = time().'.'.$image->getClientOriginalExtension();

        // オリジナル画像を public/bbs_imageにコピー
        $image->move(
            base_path() . '/public/bbs_image/', $file_name
        );

        // オリジナル画像のサムネイルを作成
        $path = public_path('bbs_image/'.$file_name);
        $thumb = Image::make($path);
        $thumb->resize(self::THUMB_WIDTH, null, function($constraint){
            $constraint->upsize();
            $constraint->aspectRatio();
        });
        // サムネイルに名前を付ける
        $save_path = public_path('bbs_thumb/'.$file_name);
        $thumb->save($save_path);

        // オリジナルファイル名とサムネイル名を返す
        return($file_name);
    }
}
