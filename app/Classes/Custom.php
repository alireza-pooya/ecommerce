<?php


namespace App\Classes;


class custom
{
    /**
     * @param $file
     * @param $path
     * @return string|null
     */
    public static function uploader($file, $path)        /// upload file and return path+filename after public_html/
    {
        $extension = $file->getClientOriginalExtension();

        /// postfix allowed
        $ext = ['jpg','JPG','jpeg','JPEG','png','PNG','gif','GIF'];

        if (in_array($extension, $ext))
        {
            $name = time().'-'.str_replace(' ','',$file->getClientOriginalName());
            $file->move($path, $name);
            return $path.$name;
        }
        return null;   /// postfix not allowed
    }
}