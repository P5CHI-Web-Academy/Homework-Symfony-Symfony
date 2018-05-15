<?php

namespace App\Form\DataTransformer;

use App\Services\FileUploader;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\HttpFoundation\File\File;

class StringToFileTransformer implements DataTransformerInterface
{
    /**
     * @var FileUploader
     */
    private $fileUploader;

    /**
     * JobFileUploadListener constructor.
     *
     * @param FileUploader $fileUploader
     */
    public function __construct(FileUploader $fileUploader)
    {

        $this->fileUploader = $fileUploader;
    }

    /**
     * {@inheritdoc}
     */
    public function transform($fileName): ?File
    {
        $filePath = $this->fileUploader->getUploadPath() . '/' . $fileName;

        if ($fileName && file_exists($filePath)) {
            return new File($filePath);
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function reverseTransform($file)
    {
        return $file;
    }
}
