<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
}
