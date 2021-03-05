<?php

namespace App\Controller;

use App\Entity\PublicationEquipement;
use App\Form\EchangematerielType;
use App\Repository\PublicationEquipementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MaterielController extends AbstractController
{
    /**
     * @Route("/materiel", name="materiel")
     */
    public function index(): Response
    {   $repo=$this->getDoctrine()->getManager()->getRepository(PublicationEquipement::class)->findAll();
        return $this->render('materiel/index.html.twig', [
            'controller_name' => 'MaterielController',
        ]);
    }
    /**
     * @Route("/materiels", name="allmateriel")
     */
    public function affichage(PublicationEquipementRepository $repo){
        $materiel=$repo->findAll();
        return $this->render('materiel/index.html.twig', [
            'materiel' => $materiel,
        ]); 
    }
     /**
     * @Route("/addmateriel", name="addmateriel")
     */
    public function ajouter(Request $request)
    {
        $materiel = new PublicationEquipement();
        $form = $this->createForm(EchangematerielType::class, $materiel);
        $form->add("ajouter", SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $materiel->getDate=$materiel->setDate(new \DateTime());
            $em->persist($materiel);
            $em->flush();
            return $this->redirectToRoute("allmateriel");
        }
        return $this->render("materiel/ajoutM.html.twig", [
            "form" => $form->createView()
        ]);
    }
    /**
     * @param $id
     * @param PublicationEquipementRepository $repo
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route ("/updateM/{id}",name="updateM")
     */
    public function update($id,PublicationEquipementRepository  $repo, Request $request)
    {
        $materiel = $repo->find($id);
        $form = $this->createForm(EchangematerielType::class, $materiel);
        $form->add("update", SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("allmateriel");
        }
        return $this->render("materiel/updateM.html.twig", [
            "form" => $form->createView()
        ]);
    }

    /**
     * @param $id
     * @param PublicationEquipementRepository $repo
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route ("deleteM/{id}",name="deleteM")
     */
    public function delete($id,PublicationEquipementRepository $repo){
        $materiel=$repo->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($materiel);
        $em->flush();
        return $this->redirectToRoute("allmateriel");


    }
}
