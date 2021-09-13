<?php

namespace App\Entity;

use App\Repository\StoreInventoryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StoreInventoryRepository::class)
 */
class StoreInventory
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\ManyToOne(targetEntity="Store", inversedBy="storeInventorys")
     * @ORM\JoinColumn(name="store_id", referencedColumnName="id", nullable=false)
     */
    private $store;

    /**
     * @ORM\ManyToOne(targetEntity="Inventory", inversedBy="storeInventorys")
     * @ORM\JoinColumn(name="inventory_id", referencedColumnName="id", nullable=false)
     */
    private $inventory;

    /**
     * @ORM\Column(type="integer")
     */
    private $stock;

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
    public function getStock(): ?int
    {
        return $this->stock;
    }

    /**
     * @param int $stock
     * @return $this
     */
    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * @return Store|null
     */
    public function getStore(): ?Store
    {
        return $this->store;
    }

    /**
     * @param Store|null $store
     * @return $this
     */
    public function setStore(?Store $store): self
    {
        $this->store = $store;

        return $this;
    }

    /**
     * @return Inventory|null
     */
    public function getInventory(): ?Inventory
    {
        return $this->inventory;
    }

    /**
     * @param Inventory|null $inventory
     * @return $this
     */
    public function setInventory(?Inventory $inventory): self
    {
        $this->inventory = $inventory;

        return $this;
    }
}
