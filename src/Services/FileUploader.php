<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    /**
     * @var string
     */
    private $uploadPath;

    /**
     * FileUploader constructor.
     *
     * @param string $uploadPath
     */
    public function __construct(string $uploadPath)
    {
        $this->uploadPath = $uploadPath;
    }

    /**
     * @param UploadedFile $file
     *
     * @return string
     *
     * @throws \Exception
     */
    public function upload(UploadedFile $file): string
    {
        $fileName = \bin2hex(\random_bytes(10)) . '.' . $file->guessExtension();

        $file->move($this->uploadPath, $fileName);

        return $fileName;
    }
}
