<?php

class UploadFile
{
    public function __construct($upload_path, $image)
    {
    }

    public function uploadImage()
    {
        require_once BULLETPROOF_LIB;

        $file = new Bulletproof\Image($_FILES);

        $file->setLocation('uploads');

        if ($file["image"]) {
            $upload = $file->upload();

            if ($upload) {
                echo $upload->getFullPath();
            } else {
                echo $file->getError();
            }
        }
    }
}
