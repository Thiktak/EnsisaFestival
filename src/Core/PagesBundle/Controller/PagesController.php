<?php

namespace Core\PagesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class PagesController extends Controller
{
    public function indexAction()
    {
        $aSlide = array();
        
        // On parcours le répertoire du slider
        foreach( new \DirectoryIterator('../web/img/slider') as $file )
          if( $file->isFile() )
            $aSlide[] = 'img/slider/' . ((string) $file);

        return $this->render('CorePagesBundle:Pages:index.html.twig', array(
          'slide' => $aSlide,
        ));
    }

    public function infosAction()
    {
        return $this->render('CorePagesBundle:Pages:infos.html.twig');
    }

    public function festivalAction()
    {
        return $this->render('CorePagesBundle:Pages:festival.html.twig');
    }


    public function menuAction()
    {

        $em = $this->getDoctrine()->getEntityManager();

        $tickets = $em->getRepository('CoreTicketsBundle:Tickets')->findAll();

        $artist  = $em->getRepository('CoreTicketsBundle:Artist')->findAll();
        // Pas de ORDER BY RAND() avec Doctrine2
        // On simule (au détriment des resources)

        return $this->render('CorePagesBundle:Pages:menu.html.twig', array(
            'tickets' => $tickets,
            'artist'  => $artist[array_rand($artist)],
        ));
    }



    public function error403Action() {
        // get the previous requests
       /* $requests = $this->container->getCurrentScopedStack('request');
     
        // get the previous controller
        $controllerResolver = new \Symfony\Component\HttpKernel\Controller\ControllerResolver();
        list($controller, $method) = $controllerResolver->getController($requests['request']['request']);
        // isolate the method
        $method = new \ReflectionMethod($controller, $method);
        // load the metas
        $reader = new \JMS\SecurityExtraBundle\Mapping\Driver\AnnotationReader();
        $converter = new \JMS\SecurityExtraBundle\Mapping\Driver\AnnotationConverter();
        $annotations = $reader->getMethodAnnotations($method);
        $metadata = $converter->convertMethodAnnotations($method, $annotations)->getAsArray();
        // isolate the required roles
        $requiredRoles = $metadata['roles'];
     
        return array('requiredRoles' => $requiredRoles);*/
        return $this->render('CorePagesBundle:Pages:error403.html.twig', array(
            'requiredRoles' => null
        ));
    }
}
