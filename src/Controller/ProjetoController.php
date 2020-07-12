<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use App\Entity\Projeto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProjetoController extends AbstractController{

    /**
     * @Route("/projeto/mostra/{id}")
     */
    public function mostraAction(Projeto $projeto)
    {
        return $this->render('Projeto/mostra.html.twig',["projeto" => $projeto]);
    }

    /**
     * @Route("/projeto/novo",methods="GET")
     */
    public function formulario()
    {
        return $this->render("Projeto/novo.html.twig");
    }

    /**
     * @Route("/projeto/novo",methods="POST")
     */
    public function cria(Request $request)
    {
        $nome = $request->get("nome");

        $projeto = new Projeto();
        $projeto->setNome($nome);

        $em = $this->getDoctrine()->getManager();
        $em->persist($projeto);
        $em->flush();

        return $this->redirect("/projeto/mostra/".$projeto->getNome());
    }

        /**
     * @Route("/projeto/lista",methods="GET")
     */
    public function lista(){
        $repository = $this->getDoctrine()->getManager()->getRepository(Projeto::class);
        return $this->render("Projeto/lista.html.twig",$repository->findAll());
    }

    /**
     * @Route("/projeto/remove/{id}")
     */
    public function delete(Projeto $projeto){
        $em = $this->getDoctrine()->getManager();
        $em->remove($projeto);
        $em->flush();
        return $this->redirect("/projeto/lista");

    }

    /**
     * @Route("/projeto/edita/{id}}",methods="GET")
     */
    public function mostra(Projeto $projeto){
        $form = $this->createFormBuilder($projeto)
        ->add('nome')
        ->add('funcionarios')
        ->setAction("/projeto/edita".$projeto->getId())
        ->getForm();

        return $this->render("Projeto/edita.html.twig",["projeto"=>$projeto, "form"=>$form->creatView()]);
    }

    /**
     * @Route("/projeto/edita/{id}",methods="POST")
     */
    public function edita(Projeto $projeto, Request $request){
        $form = $this->createFormBuilder($projeto)
        ->add('nome')
        ->add('funcionarios')
        ->getForm();
        $form ->handleRequest($request);
        if($form ->isValid()){
            $projeto= $form->getData();
            $em=$this->getDoctrine()->getManager();
            foreach($projeto->getFuncionarios() as $funcionario){
                $funcionario->setProjeto($projeto);
                $em->merge($funcionario);
            }
            $em->merge($projeto);
            $em->flush();
            return $this->redirect("/projeto/edita".$projeto->getId());
        }
        return $this->render("Projeto/edita.html.twig",['projeto'=>$projeto]);
    }
}