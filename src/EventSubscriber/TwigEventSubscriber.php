<?php

namespace App\EventSubscriber;

use App\Repository\ZinfoRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Twig\Environment;

class TwigEventSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private Environment $twig,
        private ZinfoRepository $zinfoRepository,
    ) {
    }

    public function onKernelController(ControllerEvent $event): void
    {
        $this->twig->addGlobal('info_pages', $this->zinfoRepository->getInfoPagesFooter());
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
        ];
    }
}