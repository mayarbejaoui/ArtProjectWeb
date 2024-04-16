<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Panier
 *
 * @ORM\Table(name="panier", indexes={@ORM\Index(name="id_oeuvre", columns={"id_oeuvre"})})
 * @ORM\Entity
 */
class Panier
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_panier", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPanier;

    /**
     * @var int
     *
     * @ORM\Column(name="quantite", type="integer", nullable=false)
     */
    private $quantite;

    /**
     * @var \Oeuvreart
     *
     * @ORM\ManyToOne(targetEntity="Oeuvreart")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_oeuvre", referencedColumnName="idOeuvre")
     * })
     */
    private $idOeuvre;

    /**
     * @return int
     */
    public function getIdPanier(): ?int
    {
        return $this->idPanier;
    }

    /**
     * @param int $idPanier
     */
    public function setIdPanier(int $idPanier): void
    {
        $this->idPanier = $idPanier;
    }

    /**
     * @return int
     */
    public function getQuantite(): int
    {
        return $this->quantite;
    }

    /**
     * @param int $quantite
     */
    public function setQuantite(int $quantite): void
    {
        $this->quantite = $quantite;
    }

    /**
     * @return ?Oeuvreart
     */
    public function getIdOeuvre(): ?Oeuvreart
    {
        return $this->idOeuvre;
    }

    /**
     * @param ?Oeuvreart $idOeuvre
     */
    public function setIdOeuvre(?Oeuvreart $idOeuvre): void
    {
        $this->idOeuvre = $idOeuvre;
    }


}
