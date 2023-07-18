<?php

namespace Ahmadjabali\LaravelFileManager;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class FileManager
{
    public static function upload(string $dir, string $format, $image = null)
    {
        if ($image != null) {
            $imageName = Carbon::now()->toDateString() . "-" . uniqid() . "." . $format;
            if (!Storage::disk('public')->exists($dir)) {
                Storage::disk('public')->makeDirectory($dir);
            }
            Storage::disk('public')->put($dir . $imageName, file_get_contents($image));
        } else {
            $imageName = 'null.png';
        }

        return $imageName;
    }

    public static function update(string $dir, $old_image, string $format, $image = null)
    {
        if (Storage::disk('public')->exists($dir . $old_image)) {
            Storage::disk('public')->delete($dir . $old_image);
        }
        $imageName = ImageManager::upload($dir, $format, $image);
        return $imageName;
    }

    public static function delete($full_path)
    {
        if (Storage::disk('public')->exists($full_path)) {
            Storage::disk('public')->delete($full_path);
        }

        return [
            'success' => 1,
            'message' => 'Removed successfully !'
        ];

        
    }
    private static function get_file_name($path)
    {
        $temp = explode('/', $path);
        return end($temp);
    }

    private static function get_file_ext($name)
    {
        $temp = explode('.', $name);
        return end($temp);
    }

    private static function get_path_for_db($full_path)
    {
        $temp = explode('/', $full_path, 3);
        return end($temp);
    }

    public static function format_file_and_folders($files, $type)
    {
        $data = [];
        foreach ($files as $file) {
            $name = self::get_file_name($file);
            $ext = self::get_file_ext($name);
            $path = '';
            if ($type == 'file') {
                $path = $file;
            }
            if ($type == 'folder') {
                $path = $file;
            }
            if (in_array($ext, ['jpg', 'png', 'jpeg', 'gif', 'bmp', 'tif', 'tiff']) || $type == 'folder')
            $data[] = [
                'name' => $name,
                'path' =>  $path,
                'db_path' =>  self::get_path_for_db($file),
                'type' => $type
            ];
        }
        return $data;
    }

}
