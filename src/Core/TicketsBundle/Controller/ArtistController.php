<?php

namespace Core\TicketsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Core\TicketsBundle\Entity\Artist;
use Core\TicketsBundle\Form\ArtistType;

/**
 * Artist controller.
 *
 */
class ArtistController extends Controller
{
    /**
     * Lists all Artist entities.
     *
     */
    public function indexAction()
    {
        $get_country = $this->getRequest()->query->get('filter-country');
        $get_gender  = $this->getRequest()->query->get('filter-gender');

        $em = $this->getDoctrine()->getEntityManager();

        # FILTRES
        $filters['countries'] = array();
        $filters['genders']   = array();

        ## Récupération des élèments des filtres (country, gender)
        $filtersEntities = $em->createQueryBuilder()
            ->from('CoreTicketsBundle:Artist', 'a')
            ->select('a.country, a.gender')
            ->getQuery()
            ->getResult();

        ## Stockage
        foreach( $filtersEntities as $row ) {
            if( $row['country'] ) $filters['countries'][] = $row['country'];
            if( $row['gender'] )  $filters['genders'][]   = $row['gender'];
        }

        array_unique($filters['countries']);
        array_unique($filters['genders']);

        # DATAS
        $entities = $em->createQueryBuilder()
            ->from('CoreTicketsBundle:Artist', 'a')
            ->select('a');

        if( $get_country )
            $entities = $entities->andWhere('a.country = :country')->setparameter('country', $get_country);
        if( $get_gender )
            $entities = $entities->andWhere('a.gender = :gender')->setparameter('gender', $get_gender);


        return $this->render('CoreTicketsBundle:Artist:index.html.twig', array(
            'entities'  => $entities->getQuery()->getResult(), // On récupère toutes les données avec les filtres
            'countries' => $filters['countries'],
            'genders'   => $filters['genders']
        ));
    }

    /**
     * Finds and displays a Artist entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CoreTicketsBundle:Artist')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Artist entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CoreTicketsBundle:Artist:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Artist entity.
     *
     */
    public function newAction()
    {
        $entity = new Artist();
        $form   = $this->createForm(new ArtistType(), $entity);

        return $this->render('CoreTicketsBundle:Artist:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Artist entity.
     *
     */
    public function createAction()
    {
        $entity  = new Artist();
        $request = $this->getRequest();
        $form    = $this->createForm(new ArtistType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('artist_show', array('id' => $entity->getId())));
            
        }

        return $this->render('CoreTicketsBundle:Artist:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Artist entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CoreTicketsBundle:Artist')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Artist entity.');
        }

        $editForm = $this->createForm(new ArtistType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CoreTicketsBundle:Artist:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Artist entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CoreTicketsBundle:Artist')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Artist entity.');
        }

        $editForm   = $this->createForm(new ArtistType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('artist_edit', array('id' => $id)));
        }

        return $this->render('CoreTicketsBundle:Artist:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Artist entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('CoreTicketsBundle:Artist')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Artist entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('artist'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
