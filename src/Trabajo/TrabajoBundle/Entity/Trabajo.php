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
    protected $id;

    /** @ORM\Column(type="string", length=100) */
    protected $titulo;

    /** @ORM\Column(type="string", length=300) */
    protected $descripcion;

    /** @ORM\Column(type="string") */
    protected $fechaexpiracion;

    /** @ORM\Column(type="string") */
    protected $fechacreado;
    
    /**
     * Construct
     * Set default FechaCreado
     */    
    public function __construct() {
        $this->fechacreado = new \DateTime();
    }

   

    /**
     * Get Id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set Titulo
     *
     * @param string $titulo
     * @return Trabajo
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get Titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set Descripcion
     *
     * @param string $descripcion
     * @return Trabajo
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get Descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set FechaExpiracion
     *
     * @param \DateTime $fechaExpiracion
     * @return Trabajo
     */
    public function setFechaExpiracion($fechaExpiracion)
    {
        $this->fechaexpiracion = $fechaExpiracion;

        return $this;
    }

    /**
     * Get FechaExpiracion
     *
     * @return \DateTime 
     */
    public function getFechaExpiracion()
    {
        return $this->fechaexpiracion;
    }

    /**
     * Set FechaCreado
     *
     * @param \DateTime $fechaCreado
     * @return Trabajo
     */
    public function setFechaCreado($fechaCreado)
    {
        $this->fechacreado = $fechaCreado;

        return $this;
    }

    /**
     * Get FechaCreado
     *
     * @return \DateTime 
     */
    public function getFechaCreado()
    {
        return $this->fechacreado;
    }
}
