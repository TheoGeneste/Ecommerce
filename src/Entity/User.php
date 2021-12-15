<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
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
    private $login;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity=Avis::class, mappedBy="user")
     */
    private $fk_avis;

    public function __construct()
    {
        $this->fk_avis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection|Avis[]
     */
    public function getFkAvis(): Collection
    {
        return $this->fk_avis;
    }

    public function addFkAvi(Avis $fkAvi): self
    {
        if (!$this->fk_avis->contains($fkAvi)) {
            $this->fk_avis[] = $fkAvi;
            $fkAvi->setUser($this);
        }

        return $this;
    }

    public function removeFkAvi(Avis $fkAvi): self
    {
        if ($this->fk_avis->removeElement($fkAvi)) {
            // set the owning side to null (unless already changed)
            if ($fkAvi->getUser() === $this) {
                $fkAvi->setUser(null);
            }
        }

        return $this;
    }
}
