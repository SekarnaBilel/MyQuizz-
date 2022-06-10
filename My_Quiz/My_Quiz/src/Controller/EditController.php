<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class EditController extends AbstractController{

    function Edit(){
        return $this->render("edit.html.twig");
    }

    function EditPass(){
        return $this->render("editpass.html.twig");
    }
}
?>