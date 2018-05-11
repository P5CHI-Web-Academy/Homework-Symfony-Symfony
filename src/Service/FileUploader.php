<?php

namespace App\Service;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    /**
     * @var string
     */
    private $targetDirectory;
    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * @param string $targetDirectory
     * @param Filesystem $filesystem
     */
    public function __construct(string $targetDirectory, Filesystem $filesystem)
    {
        $this->targetDirectory = $targetDirectory;
        $this->filesystem = $filesystem;
    }

    /**
     * @return string
     */
    public function getTargetDirectory(): string
    {
        return $this->targetDirectory;
    }

    /**
     * @param string $fileName
     * @return null|File
     */
    public function getFile(string $fileName): ?File
    {
        $fullFileName = $this->getTargetDirectory().'/'.$fileName;

        if ($this->filesystem->exists($fullFileName)) {
            return new File($fullFileName);
        }

        return null;
    }

    /**
     * @param UploadedFile $file
     * @return string
     * @throws \Exception
     */
    public function upload(UploadedFile $file): string
    {
        $fileName = \bin2hex(\random_bytes(10)).'.'.$file->guessExtension();

        $file->move($this->targetDirectory, $fileName);

        return $fileName;
    }
}
