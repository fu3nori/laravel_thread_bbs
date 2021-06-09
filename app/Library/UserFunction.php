<?php


namespace App\Library;


class UserFunction
{
    public static function ImageTrance($image)
    {
        $thumb =null;
        // オリジナル画像に名前をつける
        $fileName = time().$image->getClientOriginalName();

        // オリジナル画像を public/bbs_imageにコピー
        $image->move(
            base_path() . '/public/bbs_image/', $fileName
        );

        // オリジナル画像のサムネイルを作成

        // サムネイルに名前を付ける

        // サムネイルを public/bbs_thumbにコピー

        // サムネイルに名前を付ける

        // オリジナルファイル名とサムネイル名を返す
        return($fileName);
    }
}
