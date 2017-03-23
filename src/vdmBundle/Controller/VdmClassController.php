<?php

namespace vdmBundle\Controller;

use vdmBundle\Entity\VdmClass;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Vdmclass controller.
 *
 */
class VdmClassController extends Controller
{
    /**
     * Lists all vdmClass entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $vdmClasses = $em->getRepository('vdmBundle:VdmClass')->findAll();

        return $this->render('vdmclass/index.html.twig', array(
            'vdmClasses' => $vdmClasses,
        ));
    }

    /**
     * Creates a new vdmClass entity.
     *
     */
    public function newAction(Request $request)
    {
        $vdmClass = new Vdmclass();
        $form = $this->createForm('vdmBundle\Form\VdmClassType', $vdmClass);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($vdmClass);
            $em->flush($vdmClass);

            return $this->redirectToRoute('vdmclass_show', array('id' => $vdmClass->getId()));
        }

        return $this->render('vdmclass/new.html.twig', array(
            'vdmClass' => $vdmClass,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a vdmClass entity.
     *
     */
    public function showAction(VdmClass $vdmClass)
    {
        $deleteForm = $this->createDeleteForm($vdmClass);

        return $this->render('vdmclass/show.html.twig', array(
            'vdmClass' => $vdmClass,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing vdmClass entity.
     *
     */
    public function editAction(Request $request, VdmClass $vdmClass)
    {
        $deleteForm = $this->createDeleteForm($vdmClass);
        $editForm = $this->createForm('vdmBundle\Form\VdmClassType', $vdmClass);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('vdmclass_edit', array('id' => $vdmClass->getId()));
        }

        return $this->render('vdmclass/edit.html.twig', array(
            'vdmClass' => $vdmClass,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a vdmClass entity.
     *
     */
    public function deleteAction(Request $request, VdmClass $vdmClass)
    {
        $form = $this->createDeleteForm($vdmClass);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($vdmClass);
            $em->flush($vdmClass);
        }

        return $this->redirectToRoute('vdmclass_index');
    }

    /**
     * Creates a form to delete a vdmClass entity.
     *
     * @param VdmClass $vdmClass The vdmClass entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(VdmClass $vdmClass)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('vdmclass_delete', array('id' => $vdmClass->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
