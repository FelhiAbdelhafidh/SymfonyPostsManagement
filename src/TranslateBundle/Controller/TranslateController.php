<?php

namespace TranslateBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TranslateController extends Controller
{
    
    /**
     * @Route("{_locale}/translate")
     */
    public function showAction()
    {
        return $this->render('TranslateBundle:Default:translate.html.twig');
    }
}
