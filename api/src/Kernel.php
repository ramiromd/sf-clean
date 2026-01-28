<?php

namespace Ramiromd\Sfclean\Rest;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    /**
     * Override to allow mono repo path. 
     */
    public function getProjectDir(): string
    {
        $defaultProjectDir = parent::getProjectDir();
        return $defaultProjectDir . "/api";
    }
}