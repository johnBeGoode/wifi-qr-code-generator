<?php

namespace App\Controller;

use App\Form\WifiParamsType;
use chillerlan\QRCode\QRCode;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class WifiQrCodeController extends AbstractController
{
    #[Route('/', name: 'app_home', methods: ['GET', 'POST'])]
    public function create(Request $request): Response
    {
        $form = $this->createForm(WifiParamsType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $wifiParams = $form->getData();

            $networkName = $wifiParams['networkName'];
            $encryption = $wifiParams['encryption'];
            $password = $wifiParams['password'];
            $isHidden = $wifiParams['isHidden'] ? 'true' : 'false';

            $dataQrCode = "WIFI:T:$encryption;S:$networkName;P:$password;H:$isHidden;;";
            $qrCode = (new QRCode())->render($dataQrCode);

            return $this->render('wifi_qr_code/show.html.twig', [
                'qrCode' => $qrCode,
            ]);
        }

        return $this->render('wifi_qr_code/create.html.twig', [
            'form' => $form,
        ]);
    }
}
