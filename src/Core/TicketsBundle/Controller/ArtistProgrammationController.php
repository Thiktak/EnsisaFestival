<?php

namespace Core\TicketsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Core\TicketsBundle\Entity\ArtistProgrammation;
use Core\TicketsBundle\Form\ArtistProgrammationType;

/**
 * ArtistProgrammation controller.
 *
 * @Route("/artistprogrammation")
 */
class ArtistProgrammationController extends Controller
{
    /**
     * Lists all ArtistProgrammation entities.
     *
     * @Route("/", name="artistprogrammation")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('CoreTicketsBundle:ArtistProgrammation')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a ArtistProgrammation entity.
     *
     * @Route("/{id}/show", name="artistprogrammation_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CoreTicketsBundle:ArtistProgrammation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ArtistProgrammation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new ArtistProgrammation entity.
     *
     * @Route("/new", name="artistprogrammation_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new ArtistProgrammation();
        $form   = $this->createForm(new ArtistProgrammationType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new ArtistProgrammation entity.
     *
     * @Route("/create", name="artistprogrammation_create")
     * @Method("post")
     * @Template("CoreTicketsBundle:ArtistProgrammation:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new ArtistProgrammation();
        $request = $this->getRequest();
        $form    = $this->createForm(new ArtistProgrammationType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('artistprogrammation_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing ArtistProgrammation entity.
     *
     * @Route("/{id}/edit", name="artistprogrammation_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CoreTicketsBundle:ArtistProgrammation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ArtistProgrammation entity.');
        }

        $editForm = $this->createForm(new ArtistProgrammationType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing ArtistProgrammation entity.
     *
     * @Route("/{id}/update", name="artistprogrammation_update")
     * @Method("post")
     * @Template("CoreTicketsBundle:ArtistProgrammation:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CoreTicketsBundle:ArtistProgrammation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ArtistProgrammation entity.');
        }

        $editForm   = $this->createForm(new ArtistProgrammationType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('artistprogrammation_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a ArtistProgrammation entity.
     *
     * @Route("/{id}/delete", name="artistprogrammation_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('CoreTicketsBundle:ArtistProgrammation')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ArtistProgrammation entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('artistprogrammation'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
