<?php
namespace Trabajo\TrabajoBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 *@ORM\Entity
 *@ORM\Table(name="Trabajo") 
 * @ORM\Entity(repositoryClass="Trabajo\TrabajoBundle\Entity\TrabajoRepository")
*/
class Trabajo {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer") 
     * @ORM\GeneratedValue
     */
    protected $Id;

    /** @ORM\Column(type="string", length=100) */
    protected $Titulo;

    /** @ORM\Column(type="string", length=300) */
    protected $Descripcion;

    /** @ORM\Column(type="string") */
    protected $FechaExpiracion;

    /** @ORM\Column(type="string") */
    protected $FechaCreado;
    
    /**
     * Construct
     * Set default FechaCreado
     */    
    public function __construct() {
        $this->FechaCreado = new \DateTime();
    }

   

    /**
     * Get Id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->Id;
    }

    /**
     * Set Titulo
     *
     * @param string $titulo
     * @return Trabajo
     */
    public function setTitulo($titulo)
    {
        $this->Titulo = $titulo;

        return $this;
    }

    /**
     * Get Titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->Titulo;
    }

    /**
     * Set Descripcion
     *
     * @param string $descripcion
     * @return Trabajo
     */
    public function setDescripcion($descripcion)
    {
        $this->Descripcion = $descripcion;

        return $this;
    }

    /**
     * Get Descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->Descripcion;
    }

    /**
     * Set FechaExpiracion
     *
     * @param \DateTime $fechaExpiracion
     * @return Trabajo
     */
    public function setFechaExpiracion($fechaExpiracion)
    {
        $this->FechaExpiracion = $fechaExpiracion;

        return $this;
    }

    /**
     * Get FechaExpiracion
     *
     * @return \DateTime 
     */
    public function getFechaExpiracion()
    {
        return $this->FechaExpiracion;
    }

    /**
     * Set FechaCreado
     *
     * @param \DateTime $fechaCreado
     * @return Trabajo
     */
    public function setFechaCreado($fechaCreado)
    {
        $this->FechaCreado = $fechaCreado;

        return $this;
    }

    /**
     * Get FechaCreado
     *
     * @return \DateTime 
     */
    public function getFechaCreado()
    {
        return $this->FechaCreado;
    }
}
