<?php

namespace Core\TicketsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Core\TicketsBundle\Entity\Tickets as Tickets;
use Core\TicketsBundle\Entity\ShoppedTickets;
use Core\TicketsBundle\Form\ShoppedTicketsType;
use Core\TicketsBundle\Form\AdminShoppedTicketsType;

/**
 * ShoppedTickets controller.
 *
 */
class ShoppedTicketsController extends Controller
{
    /**
     * Lists all ShoppedTickets entities.
     *
     */
    public function indexAction()
    {
        $paid = array(
            'total' => 0,
        );

        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('CoreTicketsBundle:ShoppedTickets')->findBy(array('user' => $user->getID()), array('paid' => 'desc'));
        
        foreach( $entities as $entity )
            if( !$entity->getPaid() )
                $paid['total'] += $entity->getTickets()->getPrice();

        $tickets  = $em->getRepository('CoreTicketsBundle:Tickets')->findAll();

        return $this->render('CoreTicketsBundle:ShoppedTickets:index.html.twig', array(
            'entities' => $entities,
            'tickets'  => $tickets,
            'paid'     => $paid,
        ));
    }

    public function printAction($id)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CoreTicketsBundle:ShoppedTickets')->findOneBy(array(
            'id'   => $id,
            'user' => $user->getID()
        ));

        $url = $this->generateUrl('pass_check', array('id' => $id, 'salt' => $entity->getSalt()));

        return $this->render('CoreTicketsBundle:ShoppedTickets:print.html.twig', array(
            'entity' => $entity,
            'url'    => $url,
            'qrcode' => 'http://qrcode.kaywa.com/img.php?s=3&d=' . urlencode($url),
        ));
    }

    public function checkAction($id, $salt) {
        $now = new \DateTime();
        $return = array(
            'exists' => null,
            'paid'   => null,
            'date'   => null,
        );

        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('CoreTicketsBundle:ShoppedTickets')->findOneBy(array(
            'id' => $id,
            'salt' => $salt,
        ));
        
        $return['exists'] = (boolean) count($entity);

        if( $return['exists'] ) {
            $return['paid'] = (boolean) $entity->getPaid();
            $return['date'] = false;

            if( $entity->getTickets() )
                foreach( $entity->getTickets()->getProgrammations() as $prog ) 
                {
                    if( $prog->getDate()->format('d/m/Y') == $now->format('d/m/Y') )
                        $return['date'] = true;
                }
        }


        return $this->render('CoreTicketsBundle:ShoppedTickets:check.html.twig', array(
            'return' => $return,
            'entity' => $entity,
            'now'    => $now,
        ));
    }


    public function listAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('CoreTicketsBundle:ShoppedTickets')->findAll();

        return $this->render('CoreTicketsBundle:ShoppedTickets:list.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a ShoppedTickets entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CoreTicketsBundle:ShoppedTickets')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ShoppedTickets entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CoreTicketsBundle:ShoppedTickets:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new ShoppedTickets entity.
     *f
     */
    public function newAction($id = null)
    {
        $em = $this->getDoctrine()->getEntityManager();
        if( $id )
        {
            $ticket = $em->getRepository('CoreTicketsBundle:Tickets')->find($id);
        
            if (!$ticket) {
                throw $this->createNotFoundException('Unable to find Tickets entity.');
            }
        }

        $entity = new ShoppedTickets();
        if( $id )
            $entity->setTickets($ticket);

        $form   = $this->createForm(new ShoppedTicketsType(), $entity);

        return $this->render('CoreTicketsBundle:ShoppedTickets:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new ShoppedTickets entity.
     *
     */
    public function createAction()
    {
        $user = $this->get('security.context')->getToken()->getUser();

        $entity  = new ShoppedTickets();
        $request = $this->getRequest();
        $form    = $this->createForm(new ShoppedTicketsType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity->setUser($user);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('billeterie'));
            
        }

        return $this->render('CoreTicketsBundle:ShoppedTickets:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing ShoppedTickets entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CoreTicketsBundle:ShoppedTickets')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ShoppedTickets entity.');
        }

        $editForm = $this->createForm(new ShoppedTicketsType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CoreTicketsBundle:ShoppedTickets:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing ShoppedTickets entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CoreTicketsBundle:ShoppedTickets')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ShoppedTickets entity.');
        }

        $editForm   = $this->createForm(new ShoppedTicketsType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('pass_edit', array('id' => $id)));
        }

        return $this->render('CoreTicketsBundle:ShoppedTickets:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ShoppedTickets entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('CoreTicketsBundle:ShoppedTickets')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ShoppedTickets entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('pass'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}