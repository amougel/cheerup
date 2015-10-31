<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration as Config;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    /**
     * @Config\Route("/", name="cheerup_home")
     * @Config\Template()
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return;
    }
}
