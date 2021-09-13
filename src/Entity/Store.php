<?php

namespace App\Entity;

use App\Repository\StoreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StoreRepository::class)
 */
class Store
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\Column(type="integer")
     */
    private int $priority;

    /**
     * @ORM\OneToMany(targetEntity="StoreInventory", mappedBy="store")
     */
    private $storeInventorys;


    public function __construct()
    {
        $this->storeInventorys = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPriority(): ?int
    {
        return $this->priority;
    }

    /**
     * @param int $priority
     * @return $this
     */
    public function setPriority(int $priority): self
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @return Collection|StoreInventory[]
     */
    public function getStoreInventorys(): Collection
    {
        return $this->storeInventorys;
    }

    /**
     * @param StoreInventory $storeInventory
     * @return $this
     */
    public function addStoreInventory(StoreInventory $storeInventory): self
    {
        if (!$this->storeInventorys->contains($storeInventory)) {
            $this->storeInventorys[] = $storeInventory;
            $storeInventory->setStore($this);
        }

        return $this;
    }

    /**
     * @param StoreInventory $storeInventory
     * @return $this
     */
    public function removeStoreInventory(StoreInventory $storeInventory): self
    {
        if ($this->storeInventorys->removeElement($storeInventory)) {
            // set the owning side to null (unless already changed)
            if ($storeInventory->getStore() === $this) {
                $storeInventory->setStore(null);
            }
        }

        return $this;
    }
}
