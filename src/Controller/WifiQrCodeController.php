<?php

namespace App\Controller;

use App\Form\WifiParamsType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class WifiQrCodeController extends AbstractController
{
    #[Route('/', name: 'app_home', methods:['GET', 'POST'])]
    public function create(Request $request): Response
    {   
        $form = $this->createForm(WifiParamsType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $wifiParams = $form->getData();
        }

        return $this->render('create_qr_code.html.twig', compact('form'));
    }

    #[Route('/qr-code', name: 'app_qr_code', methods:['GET'])]
    public function show(): Response
    {
        return $this->render('show_qr_code.html.twig');
    }
}
