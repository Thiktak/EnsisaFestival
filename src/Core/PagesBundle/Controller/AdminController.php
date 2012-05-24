<?php

namespace Core\PagesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class AdminController extends Controller
{
    public function indexAction()
    {
        return $this->render('CorePagesBundle:Pages:admin.index.html.twig', array(
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
