<?php

namespace App\Entity;

use App\Repository\InventoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InventoryRepository::class)
 */
class Inventory
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="integer", unique=true)
     */
    private int $sdk;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $sku;

    /**
     * @ORM\OneToMany(targetEntity="StoreInventory", mappedBy="inventory")
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
     * @return int|null
     */
    public function getSdk(): ?int
    {
        return $this->sdk;
    }

    /**
     * @param int $sdk
     * @return $this
     */
    public function setSdk(int $sdk): self
    {
        $this->sdk = $sdk;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSku(): ?string
    {
        return $this->sku;
    }

    /**
     * @param string $sku
     * @return $this
     */
    public function setSku(string $sku): self
    {
        $this->sku = $sku;

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
            $storeInventory->setInventory($this);
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
            if ($storeInventory->getInventory() === $this) {
                $storeInventory->setInventory(null);
            }
        }

        return $this;
    }
}
