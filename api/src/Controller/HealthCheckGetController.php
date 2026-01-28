<?php

namespace Ramiromd\Sfclean\Rest\Controller;

use Random\RandomException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HealthCheckGetController extends AbstractController
{
    /**
     * @throws RandomException
     */
    #[Route('/api/v1/health-check', name: 'api_health-check_get', methods: ['GET'])]
    public function __invoke(Request $request) : Response
    {
        $payload = array('status' => 'live', 'random' => random_int(1000, 9999));
        return new Response(json_encode($payload));
    }
}