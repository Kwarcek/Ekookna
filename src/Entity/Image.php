<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ImageRepository::class)
 * @Vich\Uploadable
 */
class Image
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @Vich\UploadableField(mapping="name", fileNameProperty="name")
     */
    private $file;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BusStation", inversedBy="image")
     * @ORM\JoinColumn(name="bus_station_id", referencedColumnName="id", nullable=false)
     */
    private $busStation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getBusStationId(): ?BusStation
    {
        return $this->busStation;
    }

    public function setBusStationId(?BusStation $busStation): self
    {
        $this->busStation = $busStation;

        return $this;
    }

    public function getBusStation(): ?BusStation
    {
        return $this->busStation;
    }

    public function setBusStation(?BusStation $busStation): self
    {
        $this->busStation = $busStation;

        return $this;
    }
}