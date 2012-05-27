<?php

namespace Core\PagesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class AdminController extends Controller
{
    public function indexAction()
    {
        $modules['artist'] = array(
            'image'   => 'i-icons/artist-icon.png',
            'text'    => 'Artistes',

            'actions' => array(
                'artist' => '<i class="icon-eye-open"></i> Page visiteur</a>',
                '-',
                'artist_list' => '<i class="icon-list"></i> Liste</a>',
                'artist_new'  => '<i class="icon-plus"></i> Ajouter</a>',
            )
        );

        $modules['programmation'] = array(
            'image'   => 'i-icons/programmation-icon.png',
            'text'    => 'Programmations',

            'actions' => array(
                'programmation' => '<i class="icon-eye-open"></i> Page visiteur</a>',
                '-',
                'programmation_list' => '<i class="icon-list"></i> Liste</a>',
                'programmation_new'  => '<i class="icon-plus"></i> Ajouter</a>',
            )
        );

        $modules['tickets'] = array(
            'image'   => 'i-icons/tickets-icon.png',
            'text'    => 'Tickets',

            'actions' => array(
                'tickets' => '<i class="icon-eye-open"></i> Page visiteur</a>',
                '-',
                'tickets_list' => '<i class="icon-list"></i> Liste</a>',
                'tickets_new'  => '<i class="icon-plus"></i> Ajouter</a>',
            )
        );

        $modules['pass'] = array(
            'image'   => 'i-icons/pass-icon.png',
            'text'    => 'Pass',

            'actions' => array(
                'pass' => '<i class="icon-eye-open"></i> Page visiteur</a>',
                '-',
                'pass_list' => '<i class="icon-list"></i> Liste</a>',
                'pass_new'  => '<i class="icon-plus"></i> Ajouter</a>',
            )
        );

        $modules['user'] = array(
            'image'   => 'i-icons/user-icon.png',
            'text'    => 'Utilisateurs',

            'actions' => array(
                'user_list' => '<i class="icon-list"></i> Liste</a>',
            )
        );

        ksort($modules);

        return $this->render('CorePagesBundle:Pages:admin.index.html.twig', array(
            'modules' => $modules
        ));
    }
}

/*
  <li class="btn dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
      <figure><img src="{{ asset('img/i-icons/artist-icon.png') }}" alt="Artistes" /></figure>
      Artistes
      <b class="caret"></b>
    </a>
    <ul class="dropdown-menu">
      <li><a href="{{ path('artist') }}"><i class="icon-eye-open"></i> Page visiteur</a></li>
      <li class="divider"></li>
      <li><a href="{{ path('artist_list') }}"><i class="icon-list"></i> Liste</a></li>
      <li><a href="{{ path('artist_new') }}"><i class="icon-plus"></i> Ajouter</a></li>
    </ul>
  </li>
*/