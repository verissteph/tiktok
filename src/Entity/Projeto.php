<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Projeto
{
    public function __construct()
    {
        $this->funcionarios = new ArrayCollection();
        $this->horasLancadas = new ArrayCollection();

        
    }
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $nome;

    /**
     * @ORM\OneToMany(targetEntity="Funcionario", mappedBy="projeto")
     */
    private $funcionarios;

     /**
     * @ORM\ManyToOne(targetEntity="Projeto", inversedBy="horasLancadas")
     */
    private $projeto;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getFuncionarios()
    {
        return $this->funcionarios;
    }

    /**
     * @param mixed $funcionarios
     */
    public function setFuncionarios($funcionarios)
    {
        $this->funcionarios = $funcionarios;
    }

    public function addFuncionario(Funcioario $funcionario){
        $this->funcionarios->add($funcionario);
     }
    public function removeFuncionario(Funcioario $funcionario){
        $this->funcionarios->remove($funcionario);
     }

}