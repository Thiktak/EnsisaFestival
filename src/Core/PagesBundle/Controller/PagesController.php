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
}
