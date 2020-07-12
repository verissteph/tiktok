<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Funcioario;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;



class FuncionarioController extends AbstractController{
  /**
     * @Route("/funcionario/mostra/{id}")
     */
    public function mostraAction(Funcioario $funcionario)
    {
        return $this->render('Funcionario/mostra.html.twig',["funcionario" => $funcionario]);
    }

    /**
     * @Route("/funcionario/novo", methods = "GET")
     */
    public function formulario(){
        return $this-> render('Funcionario/novo.html.twig');
    }

    /**
     * @Route("/funcionario/novo", methods = "POST")
     */
    public function cria(Request $request){
        //cria funcionario 
        $nome = $request->get("nome");
        $dataDeNascimento = new \ DateTime($request->get("dataDeNascimento"));

        $funcionario= new Funcioario();
        $funcionario ->setNome($nome);
        $funcionario ->setDataDeNascimento($dataDeNascimento);
        $funcionario ->setDataDeEntrada(new \DateTime());
        //e manda pro BD

        $em = $this->getDoctrine()->getManager();
        $em -> persist($funcionario);
        $em->flush();

        return $this->redirect("/funcionario/mostra/".$funcionario->getNome());



    }
}