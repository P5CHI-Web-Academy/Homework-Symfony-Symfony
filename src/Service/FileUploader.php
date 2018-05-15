<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    private $targetDirectory;

    public function __construct(string $targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
    }

    public function upload(UploadedFile $file) : string
    {
        $fileName = \bin2hex(\random_bytes(10)) . '.' . $file->guessExtension();

        $file->move($this->targetDirectory, $fileName);

        return $fileName;
    }
}
