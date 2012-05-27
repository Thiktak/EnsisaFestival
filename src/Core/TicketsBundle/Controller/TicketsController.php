<?php

namespace Core\TicketsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Core\TicketsBundle\Entity\Tickets;
use Core\TicketsBundle\Form\TicketsType;

/**
 * Tickets controller.
 *
 */
class TicketsController extends Controller
{
    /**
     * Lists all Tickets entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('CoreTicketsBundle:Tickets')->findAll();

        return $this->render('CoreTicketsBundle:Tickets:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Lists all Tickets entities.
     *
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('CoreTicketsBundle:Tickets')->findAll();

        return $this->render('CoreTicketsBundle:Tickets:list.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Tickets entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CoreTicketsBundle:Tickets')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tickets entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CoreTicketsBundle:Tickets:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Tickets entity.
     *
     */
    public function newAction()
    {
        $entity = new Tickets();
        $form   = $this->createForm(new TicketsType(), $entity);

        return $this->render('CoreTicketsBundle:Tickets:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Tickets entity.
     *
     */
    public function createAction()
    {
        $entity  = new Tickets();
        $request = $this->getRequest();
        $form    = $this->createForm(new TicketsType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tickets_show', array('id' => $entity->getId())));
            
        }

        return $this->render('CoreTicketsBundle:Tickets:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Tickets entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CoreTicketsBundle:Tickets')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tickets entity.');
        }

        $editForm = $this->createForm(new TicketsType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CoreTicketsBundle:Tickets:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Tickets entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CoreTicketsBundle:Tickets')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tickets entity.');
        }

        $editForm   = $this->createForm(new TicketsType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tickets_edit', array('id' => $id)));
        }

        return $this->render('CoreTicketsBundle:Tickets:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Tickets entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('CoreTicketsBundle:Tickets')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Tickets entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tickets'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
