<?php

declare(strict_types= 1);

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController{

    #[Route (path:"", name:"home")]
    public function index(){
        return $this->render("index.html.twig");
    }
}
