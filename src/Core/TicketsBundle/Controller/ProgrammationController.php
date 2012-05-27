<?php

namespace Core\TicketsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Core\TicketsBundle\Entity\Programmation;
use Core\TicketsBundle\Form\ProgrammationType;

/**
 * Programmation controller.
 *
 * @Route("/programmation")
 */
class ProgrammationController extends Controller
{

    public function indexAction()
    {
        $datas = array();

        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('CoreTicketsBundle:Artist')->findAll();

        foreach( $entities as $row )
        {
          foreach($row->getProgrammations() as $programmation)
            $datas[$programmation->getDate()->format('Y-m-d')][] = array('artist' => $row, 'programmation' => $programmation);
        }

        ksort($datas);

        return $this->render('CoreTicketsBundle:Programmation:index.html.twig', array(
            'entities' => $datas
        ));
    }

    /**
     * Lists all Programmation entities.
     *
     * @Route("/admin/programmation", name="admin_programmation")
     * @Template()
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('CoreTicketsBundle:Programmation')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Programmation entity.
     *
     * @Route("/{id}/show", name="programmation_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CoreTicketsBundle:Programmation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Programmation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new Programmation entity.
     *
     * @Route("/new", name="programmation_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Programmation();
        $form   = $this->createForm(new ProgrammationType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new Programmation entity.
     *
     * @Route("/create", name="programmation_create")
     * @Method("post")
     * @Template("CoreTicketsBundle:Programmation:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Programmation();
        $request = $this->getRequest();
        $form    = $this->createForm(new ProgrammationType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('programmation_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Programmation entity.
     *
     * @Route("/{id}/edit", name="programmation_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CoreTicketsBundle:Programmation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Programmation entity.');
        }

        $editForm = $this->createForm(new ProgrammationType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Programmation entity.
     *
     * @Route("/{id}/update", name="programmation_update")
     * @Method("post")
     * @Template("CoreTicketsBundle:Programmation:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CoreTicketsBundle:Programmation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Programmation entity.');
        }

        $editForm   = $this->createForm(new ProgrammationType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('programmation_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Programmation entity.
     *
     * @Route("/{id}/delete", name="programmation_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('CoreTicketsBundle:Programmation')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Programmation entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('programmation'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
