<?php

namespace App\Entity;

use App\Repository\SongRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints\IsNull;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=SongRepository::class)
 * @Vich\Uploadable
 */
class Song
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="integer")
     */
    private $duration;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $thumbnail;

    /**
     * @ORM\ManyToOne(targetEntity=Genre::class, inversedBy="songs")
     */
    private $genre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="song_images", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

        /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $mix;

    /**
     * @Vich\UploadableField(mapping="song_mix", fileNameProperty="mix")
     * @var File
     */
    private $mixFile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $thumbnail_description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $file_name;

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * Get the value of image
     *
     * @return  string
     */ 
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Get the value of mix
     *
     * @return  string
     */ 
    public function getMix()
    {
        return $this->mix;
    }

    /**
     * Set the value of mix
     *
     * @param  string  $mix
     *
     * @return  self
     */ 
    public function setMix(?string $mix): self
    {
        $this->mix = $mix;

        return $this;
    }

    public function getMixFile()
    {
        return $this->mixFile;
    }

    public function setMixFile(File $mix = null)
    {
        $this->mixFile = $mix;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($mix) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getThumbnail(): ?string
    {
        return $this->thumbnail;
    }

    public function setThumbnail(string $thumbnail): self
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    public function getGenre(): ?Genre
    {
        return $this->genre;
    }

    public function setGenre(?Genre $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getThumbnailDescription(): ?string
    {
        return $this->thumbnail_description;
    }

    public function setThumbnailDescription(?string $thumbnail_description): self
    {
        $this->thumbnail_description = $thumbnail_description;

        return $this;
    }

    /**
     * Set the value of image
     *
     * @param  string  $image
     *
     * @return  self
     */ 
    public function setImage(string $image)
    {
        $this->image = $image;

        return $this;
    }

    public function __toString() {
        return [$this->getTitle(), $this->duration];
    }

    public function getFileName(): ?string
    {
        return $this->file_name;
    }

    public function setFileName(string $file_name): self
    {
        $this->file_name = $file_name;

        return $this;
    }
}
