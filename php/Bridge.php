<?php

abstract class Platform
{
    protected Gallery $gallery;

    public function __construct(Gallery $gallery)
    {
        $this->gallery = $gallery;
    }

    public function getDataSetForUI(): array
    {
        return $this->gallery->getGallery();
    }
}

interface Gallery
{
    public function setPhotosPerPage(int $photosPerPage): Gallery;

    public function getPhotosPerPage(): int;

    public function getPhotos(?int $current);

    public function getGallery(?int $current = null): array;
}

class Slider implements Gallery
{
    private int $thumbnailsAmount;
    private int $photosPerPage;

    public function setThumbnailsAmount(int $thumbnails)
    {
        $this->thumbnailsAmount = $thumbnails;
    }

    public function getThumbnailsAmount(): array
    {
        return ['array of ' . $this->thumbnailsAmount . ' thumbnails details from storage'];
    }

    public function setPhotosPerPage(int $photosPerPage): Gallery
    {
        $this->photosPerPage = $photosPerPage;
        return $this;
    }

    public function getPhotosPerPage(): int
    {
        return $this->photosPerPage;
    }

    public function getPhotos(?int $current = null)
    {
        return $this->getPhotosPerPage() . ' last photos for slider';
    }

    public function getGallery(?int $current = null): array
    {
        return [
            'photos' => $this->getPhotos($current),
            'thumbnails' => $this->getThumbnailsAmount()
        ];
    }
}

class GalleryWithPagination implements Gallery
{
    private int $photosPerPage;

    public function setPhotosPerPage(int $photosPerPage): Gallery
    {
        $this->photosPerPage = $photosPerPage;
        return $this;
    }

    public function getPhotosPerPage(): int
    {
        return $this->photosPerPage;
    }

    public function getPhotos(?int $current)
    {
        //photos from storage
        return $this->photosPerPage . ' last photos, starting from current';
    }

    private function getPagination(int $limit, int $current)
    {
        //data from storage of photos
        $wholeNrOfPhotos = 201;
        return 1 . '...' . $current . '...' . ceil($wholeNrOfPhotos / $limit);
    }

    public function getGallery(?int $current = null): array
    {
        return [
            'photos' => $this->getPhotos($current),
            'pagination' => $this->getPagination($this->getPhotosPerPage(), $current)
        ];
    }
}

class Mobile extends Platform
{
    // any mobile specific business logic
}

class Desktop extends Platform
{
    private const PHOTO_WIDTH = 400;
    private const THUMBNAIL_WIDTH = 50;

    public function getDataSetForUI(): array
    {
        $dataset = parent::getDataSetForUI();
        $dataset['photo_width'] = self::PHOTO_WIDTH;
        $dataset['thumbnail_width'] = self::THUMBNAIL_WIDTH;
        return $dataset;
    }
}

$sliderForMobile = new Slider();
$sliderForMobile->setPhotosPerPage(1);
$sliderForMobile->setThumbnailsAmount(0);
$mobile = new Mobile($sliderForMobile);
print_r($mobile->getDataSetForUI());

$sliderForDesktop = new Slider();
$sliderForDesktop->setPhotosPerPage(3);
$sliderForDesktop->setThumbnailsAmount(12);
$desktop = new Desktop($sliderForDesktop);
print_r($desktop->getDataSetForUI());

/**
 * returns:
 *
 * Array
 * (
     * [photos] => 1 photos for slider
     * [thumbnails] => Array
         * (
         * [0] => array of 0 thumbnails details from storage
         * )
 * )
 * Array
 * (
     * [photos] => 3 photos for slider
     * [thumbnails] => Array
         * (
         * [0] => array of 12 thumbnails details from storage
         * )
     *
     * [photo_width] => 400
     * [thumbnail_width] => 50
 * )
 */
