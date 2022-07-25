<?php

namespace App\Entity;

use App\Repository\FicheRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FicheRepository::class)]
class Fiche
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Decadaire::class, inversedBy: 'fiches')]
    #[ORM\JoinColumn(nullable: false)]
    private $decadaire;

    #[ORM\Column(type: 'date')]
    private $date;

    #[ORM\Column(type: 'integer')]
    private $nombre;

    #[ORM\ManyToOne(targetEntity: Ticket::class, inversedBy: 'fiches')]
    #[ORM\JoinColumn(nullable: false)]
    private $type;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDecadaire(): ?Decadaire
    {
        return $this->decadaire;
    }

    public function setDecadaire(?Decadaire $decadaire): self
    {
        $this->decadaire = $decadaire;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getNombre(): ?int
    {
        return $this->nombre;
    }

    public function setNombre(int $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getType(): ?Ticket
    {
        return $this->type;
    }

    public function setType(?Ticket $type): self
    {
        $this->type = $type;

        return $this;
    }
}
