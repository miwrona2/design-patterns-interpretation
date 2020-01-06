<?php

class PhotoService
{
    public function getPhotosDetailsByUserId(int $userId): array
    {
        return ['photos details from database, for user with id: ' . $userId];
    }
}

class ProxyPhotoService extends PhotoService
{
    public function getAllPhotosDetailsByUserId(int $userId): array
    {
        $key = $this->getKey($userId);
        $photos = [];
        if ($this->keyExistsInCachingEngine($key)) {
            // get Photos details from Cache
            $photos[] = ['Photos details from cache, for key: ' . $key];
        } else {
            $photos[] = $this->getPhotosDetailsByUserId($userId);
            // get Photos details from Database
            // insert Photos details to Cache by key
        }
        return $photos;
    }

    public function getKey(int $userId): string
    {
        return 'Cache_key_for_all_photos_for_user_with_id_' . $userId;
    }

    private function keyExistsInCachingEngine(string $key): bool
    {
        // external caching library logic
        // random value, because we don't know what returns external library
        return rand(0, 1) == 1;
    }
}

class User
{
    private int $id;
    private string $userFullName;

    public function __construct(int $id, string $userFullName)
    {
        $this->id = $id;
        $this->userFullName = $userFullName;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserFullName(): string
    {
        return $this->userFullName;
    }
}

// usage
$user = new User(1, 'John Doe');
$photoService = new ProxyPhotoService();

$photos = $photoService->getAllPhotosDetailsByUserId($user->getId());
print_r($photos);