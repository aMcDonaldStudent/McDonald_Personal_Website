<?php
Class ImageUtilities {
    //function to get a list of .png and .jpg files
    public static function GetBaseImagesList($dir) {
        //scandir gives all files and directories
        //process to get just the files
        $images = array();

        foreach(scandir($dir) as $file) {
            $ext = pathinfo($file, PATHINFO_EXTENSION);

            //make sure it a file and is a .jpg or .png type
            if (is_file($dir . $file) && (strtolower($ext) == 'png' 
                || strtolower($ext) == 'jpg' 
                || strtolower($ext) == 'jpeg')) {
                $images[] = $file;
            }
        }
        return $images;
    }

    //function to create resized image directories, if needed
    private static function CreateDirectories($dir) {
        if (!file_exists($dir . '/200')) {
            mkdir($dir . '/200');
        }
    }

    //helper functions to perform image resize operations
    //resize will keep aspect ratio same as original, but will
    //resize the image to fit within a $max x $max square
    private static function ResizeImage($orig, $type, $max) {
        //get original image, along with it's height and width
        $origImage = '';

        if ($type === IMAGETYPE_PNG) {
            $origImage = imagecreatefrompng($orig);
        } else if ($type === IMAGETYPE_JPEG) {
            $origImage = imagecreatefromjpeg($orig);
        }

        $origWidth = imagesx($origImage);
        $origHeight = imagesy($origImage);

        //calculate image ratios
        $ratioWidth = $origWidth / $max;
        $ratioHeight = $origHeight / $max;
        $ratio = max($ratioWidth, $ratioHeight);

        //determine new height & width
        $newWidth = round($origWidth / $ratio);
        $newHeight = round($origHeight / $ratio);

        //create the new image
        $newImg = imagecreatetruecolor($newWidth, $newHeight);

        //copy the old image to the new, providing new height &
        //width, which will resize the image
        imagecopyresampled($newImg, $origImage, 0, 0, 0, 0,
            $newWidth, $newHeight, $origWidth, $origHeight);
        imagedestroy($origImage);
        return $newImg;
    }

    //function to process an image file into different sizes
    public static function ProcessImage($file) {
        //get file/path information in an array that contains:
        // [dirname], [basename], [extension]
        $fInfo = pathinfo($file);
        $file200 = $fInfo['dirname'] . '/200/' . $fInfo['basename'];
        self::CreateDirectories($fInfo['dirname']);

        $imgType = getimagesize($file)[2];
        $newImg200 = self::ResizeImage($file, $imgType, 200);

        //based on image type, create the files
        switch($imgType) {
            case IMAGETYPE_PNG:
                imagepng($newImg200, $file200);
                break;
            case IMAGETYPE_JPEG:
                imagejpeg($newImg200, $file200);
                break;
            default:
                exit;
        }

        //free up any image resources
        imagedestroy($newImg200);
    }

    //function to delete the base and associated images
    public static function DeleteImageFiles($dir, $base) {
        unlink($dir . $base);
        unlink($dir . '200/' . $base);
    }
}