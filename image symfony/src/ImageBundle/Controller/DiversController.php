<?php

namespace ImageBundle\Controller;

use ImageBundle\Entity\Divers;
use ImageBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Diver controller.
 *
 */
class DiversController extends Controller
{
    /**
     * Lists all diver entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $divers = $em->getRepository('ImageBundle:Divers')->findAll();

        return $this->render('divers/index.html.twig', array(
            'divers' => $divers,
        ));
    }

    /**
     * Creates a new diver entity.
     *
     */
    public function newAction(Request $request)
    {
        $product = new Product();

        $diver = new Divers();
        $form = $this->createForm('ImageBundle\Form\DiversType', null);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $diver->setlibelle($form->getData()['Libelle']);
            $diver->setDescription($form->getData()['Description']);
            $diver->setEmail($form->getData()['Email']);
            $i=0;
            $em->persist($diver);
            $em->flush();
            foreach ($form->getData()['product'] as $item) {
               $product = new Product();
                $product->setimageName("_".$i);
                $product->setimageFile($item);
                $product->setDivers($diver);
                $product->setupdatedAt(new \DateTime());
                $em->persist($product);}
            $em->flush();

                $i++;

            //return $this->redirectToRoute('divers_show', array('Id' => $diver->getId()));
        }

        return $this->render('divers/new.html.twig', array(
            'diver' => $diver,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a diver entity.
     *
     */
    public function showAction(Divers $diver)
    {
        $deleteForm = $this->createDeleteForm($diver);

        return $this->render('divers/show.html.twig', array(
            'diver' => $diver,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing diver entity.
     *
     */
    public function editAction(Request $request, Divers $diver)
    {
        $deleteForm = $this->createDeleteForm($diver);
        $editForm = $this->createForm('ImageBundle\Form\DiversType', $diver);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('divers_edit', array('Id' => $diver->getId()));
        }

        return $this->render('divers/edit.html.twig', array(
            'diver' => $diver,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a diver entity.
     *
     */
    public function deleteAction(Request $request, Divers $diver)
    {
        $form = $this->createDeleteForm($diver);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($diver);
            $em->flush();
        }

        return $this->redirectToRoute('divers_index');
    }

    /**
     * Creates a form to delete a diver entity.
     *
     * @param Divers $diver The diver entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Divers $diver)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('divers_delete', array('Id' => $diver->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
