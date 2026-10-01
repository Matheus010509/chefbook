<?php

namespace App\Services;

use Cloudinary\Cloudinary;
use Illuminate\Http\UploadedFile;

class ImageService
{
    public function __construct(private Cloudinary $cloudinary) {}

    /** @return array{url: string, public_id: string} */
    public function upload(UploadedFile $file, string $folder = 'receitas'): array
    {
        $result = $this->cloudinary->uploadApi()->upload($file->getRealPath(), [
            'folder' => $folder,
            'transformation' => [
                'width' => 1200,
                'crop' => 'limit',
                'quality' => 'auto',
                'fetch_format' => 'auto',
            ],
        ]);

        return [
            'url' => $result['secure_url'],
            'public_id' => $result['public_id'],
        ];
    }

    public function delete(?string $publicId): void
    {
        if ($publicId) {
            $this->cloudinary->uploadApi()->destroy($publicId);
        }
    }
}