<?php

namespace App\Controller;

use App\Entity\Giveaway;
use App\Entity\Category;
use App\Entity\Comment;
use App\Form\GiveawayType;
use App\Form\CommentType;
use App\Repository\GiveawayRepository;
use App\Repository\CommentRepository;
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
     * @Route("/", name="home")
     */
    public function home(){
        return $this->render('giveaway/giveaway.html.twig', [
            'controller_name' => 'GiveawayController',
        ]);
    }

    /**
     * @Route("/giveaway", name="giveaways")
     */
    public function index(GiveawayRepository $repo){
        $giveaways = $repo->findAll();

        return $this->render('giveaway/index.html.twig', [
            'controller_name' => 'GiveawayController',
            'giveaways' => $giveaways
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

    /**
     * @Route("/giveaway/{id}", name="show_giveaway", requirements={"id"="\d+"})
     */
    public function show(Giveaway $giveaway, Request $request, ObjectManager $manager){
        $comment = new Comment();

        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $comment->setCreatedAt(new \DateTime())
                    ->setGiveaway($giveaway);
            $manager->persist($comment);
            $manager->flush();

            return $this->redirectToRoute('show_giveaway', ['id' => $giveaway->getId()]);
        }

        return $this->render('giveaway/show.html.twig', [
            'giveaway' => $giveaway,
            'formComment' => $form->createView()
        ]);
    }
}
