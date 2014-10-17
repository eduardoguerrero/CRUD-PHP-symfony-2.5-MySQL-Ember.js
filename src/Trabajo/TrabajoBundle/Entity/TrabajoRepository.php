<?php

namespace Trabajo\TrabajoBundle\Entity;

use Doctrine\ORM\EntityRepository;

class TrabajoRepository extends EntityRepository {

    public function VerbRead($id = null) {
        try {
            $em = $this->getEntityManager();
            if (NULL != $id) {
                $QueryStringHeredoc = <<<Query
                    SELECT 
                    o.id,
                    o.titulo,
                    o.descripcion,
                    o.fechaexpiracion,
                    o.fechacreado
                    FROM 
                    TrabajoBundle:Trabajo o 
                    Where o.id=:id                    
Query;
                $QueryVerbRead = $em->createQuery($QueryStringHeredoc);
                $QueryVerbRead->setParameter('id', $id);
                $QueryVerbRead->setMaxResults(1);
            } else {
                $QueryStringHeredoc = <<<Query
                    SELECT 
                    o.id,
                    o.titulo,
                    o.descripcion,
                    o.fechaexpiracion,
                    o.fechacreado
                    FROM 
                    TrabajoBundle:Trabajo o 
Query;
                $QueryVerbRead = $em->createQuery($QueryStringHeredoc);
            }
            return $QueryVerbRead->getResult();
        } catch (Exception $exc) {
            echo "Exception found:" . $exc->getTraceAsString();
        }
    }

  
}
