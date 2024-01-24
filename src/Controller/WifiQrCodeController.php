<?php

namespace App\Controller;

use App\Form\WifiParamsType;
use chillerlan\QRCode\QRCode;
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

            $encryption = $wifiParams['encryption'];
            $networkName = $wifiParams['networkName'];
            $password = $wifiParams['password'];
            $isHidden = $wifiParams['isHidden'];
            
            $dataQrCode = "WIFI:T:$encryption;S:$networkName;P:$password;H:$isHidden;;";
            $qrCode = (new QRCode)->render($dataQrCode);

            return $this->render('show_qr_code.html.twig', [
                'qrCode' => $qrCode
            ]);
        }

        return $this->render('create_qr_code.html.twig', compact('form'));
    }
}
