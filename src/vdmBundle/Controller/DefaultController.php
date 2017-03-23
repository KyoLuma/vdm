<?php

namespace vdmBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('vdmBundle:Default:index.html.twig');
    }
}
