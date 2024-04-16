<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Oeuvreart
 *
 * @ORM\Table(name="oeuvreart", indexes={@ORM\Index(name="id_cat", columns={"id_cat"})})
 * @ORM\Entity
 */
class Oeuvreart
{
    /**
     * @var int
     *
     * @ORM\Column(name="idOeuvre", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idoeuvre;

    /**
     * @var string
     * @Assert\NotBlank(message="Ce champ est requis")
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     */
    private $nom;

    /**
     * @var string
     * @Assert\NotBlank(message="Ce champ est requis")
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var float
     * @Assert\NotBlank(message="Ce champ est requis")
     * @Assert\Type(
     *     type="float",
     *     message="Ce champ doit être un nombre flottant"
     * )
     * @Assert\GreaterThan(
     *     value=100,
     *     message="Ce champ doit être supérieur à 100"
     * )
     * @ORM\Column(name="prix", type="float", precision=10, scale=0, nullable=false)
     */
    private $prix;

    /**
     * @var int
     *@Assert\GreaterThan(
     *     value=3,
     *     message="Ce champ doit être supérieur à 3"
     * )
     * NotBlank(message="Ce champ est requis")
     * @ORM\Column(name="quantite", type="integer", nullable=false)
     */
    private $quantite;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=false)
     */
    private $image;

    /**
     * @var string
     * @Assert\NotBlank(message="Ce champ est requis")
     * @ORM\Column(name="certif", type="string", length=255, nullable=false)
     */
    private $certif;

    /**
     * @var \Categorie
     *
     * @ORM\ManyToOne(targetEntity="Categorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cat", referencedColumnName="id_categori")
     * })
     */
    private $idCat;

    /**
     * @return int
     */
    public function getIdoeuvre(): ?int
    {
        return $this->idoeuvre;
    }

    /**
     * @param int $idoeuvre
     */
    public function setIdoeuvre(int $idoeuvre): void
    {
        $this->idoeuvre = $idoeuvre;
    }

    /**
     * @return string
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return float
     */
    public function getPrix(): ?float
    {
        return $this->prix;
    }

    /**
     * @param float $prix
     */
    public function setPrix(float $prix): void
    {
        $this->prix = $prix;
    }

    /**
     * @return int
     */
    public function getQuantite(): ?int
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
     * @return string
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getCertif(): ?string
    {
        return $this->certif;
    }

    /**
     * @param string $certif
     */
    public function setCertif(string $certif): void
    {
        $this->certif = $certif;
    }

    /**
     * @return ?Categorie
     */
    public function getIdCat(): ?Categorie
    {
        return $this->idCat;
    }

    /**
     * @param ?Categorie $idCat
     */
    public function setIdCat(?Categorie $idCat): void
    {
        $this->idCat = $idCat;
    }

    /**
     * @Assert\File(maxSize="500000000k")
     */
    public  $file;
    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file): void
    {
        $this->file = $file;
    }
    public function getWebpath(){


        return null === $this->image ? null : $this->getUploadDir().'/'.$this->image;
    }
    protected  function  getUploadRootDir(){

        return __DIR__.'/../../public/Upload'.$this->getUploadDir();
    }
    protected function getUploadDir(){

        return'';
    }
    public function getUploadFile(){
        if (null === $this->getFile()) {
            $this->image = "3.jpg";
            return;
        }


        $this->getFile()->move(
            $this->getUploadRootDir(),
            $this->getFile()->getClientOriginalName()

        );

        // set the path property to the filename where you've saved the file
        $this->image = $this->getFile()->getClientOriginalName();

        // clean up the file property as you won't need it anymore
        $this->file = null;
    }
}
