<?php

if (!function_exists('uploadProductImages')) {
    function uploadProductImages($images)
    {
        if (!empty($images)) {
            $uploaded = [];
            foreach ($images as $file) {
                $extension = $file->extension();
                $filename = time() . '.' . $extension;
                $file->move(public_path('uploads/products/'), $filename);
                array_push($uploaded, '/uploads/products/' . $filename);
            }

            return $uploaded;
        }

        return null;
    }
}

if (!function_exists('selectedSize')) {
    function selectedSize($value, $arr)
    {
        return in_array($value, json_decode($arr)) ? 'selected' : '';
    }
}
