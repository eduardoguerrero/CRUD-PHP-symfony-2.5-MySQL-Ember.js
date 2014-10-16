<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appProdUrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appProdUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $context = $this->context;
        $request = $this->request;

        // trabajo_homepage
        if (0 === strpos($pathinfo, '/hello') && preg_match('#^/hello/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'trabajo_homepage')), array (  '_controller' => 'TrabajoBundle:Default:index',));
        }

        if (0 === strpos($pathinfo, '/read')) {
            // verbread
            if ($pathinfo === '/read') {
                return array (  '_controller' => 'Trabajo\\TrabajoBundle\\Controller\\MyrestController::readAction',  '_route' => 'verbread',);
            }

            // _verbread
            if ($pathinfo === '/read/') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not__verbread;
                }

                return array (  '_controller' => 'Symfony\\Bundle\\FrameworkBundle\\Controller\\RedirectController::redirectAction',  'route' => 'verbread',  '_route' => '_verbread',);
            }
            not__verbread:

            // verbreadid
            if (preg_match('#^/read/(?P<id>\\d+)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'verbreadid')), array (  '_controller' => 'Trabajo\\TrabajoBundle\\Controller\\MyrestController::readidAction',));
            }

            // _verbreadid
            if (preg_match('#^/read/(?P<id>\\d+)/$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not__verbreadid;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => '_verbreadid')), array (  '_controller' => 'Symfony\\Bundle\\FrameworkBundle\\Controller\\RedirectController::redirectAction',  'route' => 'verbreadid',));
            }
            not__verbreadid:

        }

        if (0 === strpos($pathinfo, '/delete')) {
            // verbdeleteid
            if (preg_match('#^/delete/(?P<id>\\d+)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'DELETE') {
                    $allow[] = 'DELETE';
                    goto not_verbdeleteid;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'verbdeleteid')), array (  '_controller' => 'Trabajo\\TrabajoBundle\\Controller\\MyrestController::deleteAction',));
            }
            not_verbdeleteid:

            // _verbdeleteid
            if (preg_match('#^/delete/(?P<id>\\d+)/$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'DELETE') {
                    $allow[] = 'DELETE';
                    goto not__verbdeleteid;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => '_verbdeleteid')), array (  '_controller' => 'Symfony\\Bundle\\FrameworkBundle\\Controller\\RedirectController::redirectAction',  'route' => 'verbdeleteid',));
            }
            not__verbdeleteid:

        }

        // verbacreate
        if ($pathinfo === '/create') {
            return array (  '_controller' => 'Trabajo\\TrabajoBundle\\Controller\\MyrestController::createAction',  '_route' => 'verbacreate',);
        }

        // _verbacreate
        if (rtrim($pathinfo, '/') === '/read') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', '_verbacreate');
            }

            return array (  '_controller' => 'Symfony\\Bundle\\FrameworkBundle\\Controller\\RedirectController::redirectAction',  'route' => 'verbacreate',  '_route' => '_verbacreate',);
        }

        if (0 === strpos($pathinfo, '/update')) {
            // verupdate
            if ($pathinfo === '/update') {
                return array (  '_controller' => 'Trabajo\\TrabajoBundle\\Controller\\MyrestController::updateAction',  '_route' => 'verupdate',);
            }

            // _verbupdate
            if (rtrim($pathinfo, '/') === '/update') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', '_verbupdate');
                }

                return array (  '_controller' => 'Symfony\\Bundle\\FrameworkBundle\\Controller\\RedirectController::redirectAction',  'route' => 'verupdate',  '_route' => '_verbupdate',);
            }

        }

        if (0 === strpos($pathinfo, '/index')) {
            // index
            if ($pathinfo === '/index') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_index;
                }

                return array (  '_controller' => 'Trabajo\\TrabajoBundle\\Controller\\MyrestController::indexAction',  '_route' => 'index',);
            }
            not_index:

            // _index
            if (rtrim($pathinfo, '/') === '/index') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not__index;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', '_index');
                }

                return array (  '_controller' => 'Symfony\\Bundle\\FrameworkBundle\\Controller\\RedirectController::redirectAction',  'route' => 'index',  '_route' => '_index',);
            }
            not__index:

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
