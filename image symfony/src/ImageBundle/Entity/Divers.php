<?php
namespace ImageBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity
 */
class Divers
{
    /**
     * @ORM\GeneratedValue
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $Id;
    /**
     * @ORM\Column(type="string",length=255)
     * @Assert\NotBlank(message="cette valeur ne doit etre vide")
     */
    private $Libelle;
    /**
     * @ORM\Column(type="string",length=255)
     * @Assert\Length(min = "5", max="255" , minMessage="au minimaum 5 caractere")
     */
    private $Description;
    /**
     * @ORM\Column(type="string",length=255)
     * @Assert\Email(message="adresse non valide",checkMX = true)
     */
    private $Email;
    /**
    *
    * @ORM\OneToMany(targetEntity="Product", mappedBy="Divers", cascade={"persist"})
    *
    */
    private $product;
    

  public function getId()
    {
        return $this->Id;
    }

    /**
     * @param mixed $Id
     */
    public function setId($Id)
    {
        $this->Id = $Id;
    }        public function getDescription()
    {
        return $this->Description;
    }

    /**
     * @param mixed $Description
     */
    public function setDescription($Description)
    {
        $this->Description = $Description;
    }
            public function getLibelle()
    {
        return $this->Libelle;
    }

    /**
     * @param mixed $Libelle
     */
    public function setLibelle($Libelle)
    {
        $this->Libelle = $Libelle;
    }
            public function getEmail()
    {
        return $this->Email;
    }

    /**
     * @param mixed $Email
     */
    public function setEmail($Email)
    {
        $this->Email = $Email;
    }
  

    /**
     * @return mixed
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param mixed $products
     *
     * @return self
     */
    public function setProducts($products)
    {
        $this->products = $products;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param mixed $product
     *
     * @return self
     */
    public function setProduct($product)
    {
        $this->product = $product;

        return $this;
    }
}