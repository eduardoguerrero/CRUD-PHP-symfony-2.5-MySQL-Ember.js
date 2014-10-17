<?php

namespace Trabajo\TrabajoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Trabajo\TrabajoBundle\Entity\Trabajo;
use Symfony\Component\HttpFoundation\Request;

class MyrestController extends Controller {
    /*
     * @Function index
     * @AcceptVerbs HttpVerbs = Get
     * @return Template
     */

    public function indexAction() {
        try {
            return $this->render('TrabajoBundle:Myrestview:index.html.php');
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /*
     * @Function read
     * @AcceptVerbs HttpVerbs = Post
     * @return JSON
     * @throw  createNotFoundException when resource not found
     */

    public function ReadAction() {
        try {
            $em = $this->getDoctrine()->getManager();
            //Get function VerbRead(src\Trabajo\TrabajoBundle\Entity\TrabajoRepository.php)
            $ListWork = $em->getRepository('TrabajoBundle:Trabajo')->VerbRead();
            if (!$ListWork) {
                throw $this->createNotFoundException(
                        'Resource was not found'
                );
            }
            return new JsonResponse($ListWork);
        } catch (Exception $exc) {
            echo "Found Exception:" . $exc->getTraceAsString();
        }
    }

    /*
     * @Function readid
     * @AcceptVerbs HttpVerbs = Post
     * @param Id integer
     * @return JSON
     * @throw  createNotFoundException when parameter or resource not found
     */

    public function ReadIdAction($id) {
        try {
            if (NULL != $id) {
                $em = $this->getDoctrine()->getManager();
                //Get function VerbRead(src\Trabajo\TrabajoBundle\Entity\TrabajoRepository.php)
                $ListWorkId = $em->getRepository('TrabajoBundle:Trabajo')->VerbRead($id);
                if (!$ListWorkId) {
                    return new JsonResponse(array('Resource was not found'));
                }
                return new JsonResponse($ListWorkId);
            } else {
                throw $this->createNotFoundException('Parameter Not found');
            }
        } catch (Exception $exc) {
            echo "Found Exception:" . $exc->getTraceAsString();
        }
    }

    /*
     * @Function delete
     * @AcceptVerbs HttpVerbs = delete
     * @param Id integer
     * @return JSON
     * @throw  createNotFoundException when parameter not found
     */

    public function DeleteAction($id) {
        try {
            if (NULL != $id) {
                $em = $this->getDoctrine()->getManager();
                $FoundRecord = $em->getRepository('TrabajoBundle:Trabajo')->find($id);
                if (!$FoundRecord) {
                    return new JsonResponse(array("Could not find record with id:" . $id));
                }
                $em->remove($FoundRecord);
                $em->flush();
                return new JsonResponse(array("Deleted record successful #" . $id));
            } else {
                throw $this->createNotFoundException('Parameter Not found');
            }
        } catch (Exception $exc) {
            echo "Found Exception:" . $exc->getTraceAsString();
        }
    }

    /*
     * @Function create
     * @AcceptVerbs HttpVerbs = Post
     * @param Id integer
     * @return JSON
     * @throw  createNotFoundException when parameter or resource not found
     */

    public function CreateAction(Request $request) {
        try {
            $titulo = $request->get('titulo');
            $descripcion = $request->get('descripcion');
            $fechacreado = $request->get('fechacreado');
            $fechaexpiracion = $request->get('fechaexpiracion');
            $InsertObject = new Trabajo();
            $InsertObject->setTitulo($titulo);
            $InsertObject->setDescripcion($descripcion);
            $InsertObject->setFechaExpiracion($fechacreado);
            $InsertObject->setFechaCreado($fechaexpiracion);
            /*$errores = $this->get('validator')->validate($InsertObject);
            if (!empty($errores)) {
                return new JsonResponse(array("Por favor revise la informacion enviada"));
            }*/
            $em = $this->getDoctrine()->getManager();
            $em->persist($InsertObject);
            $em->flush();
            return new JsonResponse(array('Record added  succesful #' . $InsertObject->getId()));
        } catch (Exception $exc) {
            echo "Found Exception:" . $exc->getTraceAsString();
        }
    }

    /*
     * @Function Update
     * @AcceptVerbs HttpVerbs = Put
     * @param request
     * @return JSON
     * @throw  createNotFoundException when parameter or resource not found
     */

    public function UpdateAction() {
        try {
            $em = $this->getDoctrine()->getManager();
            $UpdateRecord = $em->getRepository('TrabajoBundle:Trabajo')->find(1);
            $UpdateRecord->setTitulo('Lorem Ipsum UPDATE');
            $UpdateRecord->setDescripcion('Lorem Ipsum UPDATE');
            $UpdateRecord->setFechaExpiracion('2014-10-11 19:59:12');
            $UpdateRecord->setFechaCreado('2014-10-11 19:59:12');
            $em->persist($UpdateRecord);
            $em->flush();
            return new JsonResponse(array('Record updated  succesful #' . $UpdateRecord->getId()));
        } catch (Exception $exc) {
            echo "Found Exception:" . $exc->getTraceAsString();
        }
    }

}
