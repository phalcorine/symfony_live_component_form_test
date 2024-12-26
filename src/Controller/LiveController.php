<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\CreateUserRequestType;
use App\Model\CreateUserRequestDto;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/live', name: 'live_')]
class LiveController extends AbstractController
{
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly SerializerInterface $serializer,
    ) {
    }

    #[Route('/form', name: 'form', methods: ['GET', 'POST'])]
    public function form(Request $request): Response
    {
        $form = $this->createForm(CreateUserRequestType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            assert($data instanceof CreateUserRequestDto);

            $this->logger->info("Printing data: {data}", [
                'data' => $this->serializer->serialize($data, 'json'),
            ]);
        }

        return $this->render('live/form.html.twig', [
            // 'form' => $form,
        ]);
    }
}
