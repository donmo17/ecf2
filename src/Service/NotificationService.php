<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\RequestStack;

class NotificationService
{
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function addSuccess(string $message): void
    {
        $this->addFlash('success', $message);
    }

    public function addError(string $message): void
    {
        $this->addFlash('error', $message);
    }

    public function addWarning(string $message): void
    {
        $this->addFlash('warning', $message);
    }

    private function addFlash(string $type, string $message): void
    {
        $this->requestStack->getSession()->getFlashBag()->add($type, $message);
    }
}