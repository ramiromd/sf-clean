<?php

namespace Ramiromd\Sfclean\Rest\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HealthCheckGetController extends AbstractController
{
    #[Route('/api/v1/health-check', name: 'api_health-check_get', methods: ['GET'])]
    public function __invoke(Request $request) : Response
    {
        $payload = array('status' => 'live', 'time' => time());
        return new Response(json_encode($payload));
    }
}