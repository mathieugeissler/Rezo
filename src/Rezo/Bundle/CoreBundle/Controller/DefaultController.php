<?php

namespace Rezo\Bundle\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $this->addFlash(
            'notice',
            'Site en construction !'
        );
        return $this->render('CoreBundle:Default:index.html.twig');
    }
}
