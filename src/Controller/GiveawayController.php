<?php

namespace App\Controller;

use App\Entity\Giveaway;
use App\Form\GiveawayType;
use App\Repository\GiveawayRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\Common\Persistence\ObjectManager;

class GiveawayController extends AbstractController
{
    /**
     * @Route("/", name="giveaway")
     */
    public function index()
    {
        return $this->render('giveaway/giveaway.html.twig', [
            'controller_name' => 'GiveawayController',
        ]);
    }

    /**
     * @Route("/giveaway/new", name="new_giveaway")
     * @Route("/giveaway/{id}/edit", name="edit_giveaway")
     */
    public function form(Request $request, ObjectManager $manager, Giveaway $giveaway = null){
        if(!$giveaway){
            $giveaway = new Giveaway();
        }

        $form = $this->createForm(GiveawayType::class, $giveaway);

        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            if(!$giveaway->getId()){
                $giveaway->setCreatedAt(new \DateTime());
            }

            $manager->persist($giveaway);
            $manager->flush();

            return $this->redirectToRoute('show_giveaway', ['id' => $giveaway->getId()]);
        }
        
        return $this->render('giveaway/new.html.twig', [
            'formGiveaway' => $form->createView(),
            'editMode' => $giveaway->getId() !== null
        ]);
    }
}
