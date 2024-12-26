<?php

namespace App\Twig\Components;

use App\Form\CreateUserRequestType;
use App\Model\CreateUserRequestDto;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
final class LiveForm extends AbstractController
{
    use ComponentWithFormTrait;
    use DefaultActionTrait;

    #[LiveProp]
    public bool $isSuccessful = false;

    protected function instantiateForm(): FormInterface
    {
        return $this->createForm(CreateUserRequestType::class);
    }

    public function hasValidationErrors(): bool
    {
        return $this->getForm()->isSubmitted() && !$this->getForm()->isValid();
    }

    #[LiveAction]
    public function saveData(LoggerInterface $logger, SerializerInterface $serializer): void
    {
        $this->submitForm();

        $formData = $this->getForm()->getData();
        assert($formData instanceof CreateUserRequestDto);

        $logger->info("Printing data: {data}", [
            'data' => $serializer->serialize($formData, 'json'),
        ]);

        $this->redirectToRoute('liveform');
    }

}
