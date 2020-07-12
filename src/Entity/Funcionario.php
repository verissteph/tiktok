<?php
namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Funcioario {
     /**@ORM\Id
      * @ORM\GeneratedValue
      @ORM\Column(type="integer")
      */
    private $id;
    /** */
    private $nome;
     /**@ORM\Column(type="datetime") */
    private $dataDeNascimento;
     /**@ORM\Column(type="datetime") */
    private $dataDeEntrada;
    /**
     * @ORM\ManyToOne(targetEntity="Projeto", inversedBy="funcionarios")
     */
    private $projeto;
     /**
     * @ORM\OneToMany(targetEntity="HoraLancada", mappedBy="funcionario")
     */
    private $horasLancadas;


    public function getTempoNaEmpresa(){
        $hoje = new \DateTime();
        $diferenca = $hoje->diff($this->dataDeEntrada);
        return $diferenca;
    }

    public function getNome(){
        return $this->nome;
    }
    public function setNome($nome){
         $this->nome = $nome;
    }

    public function getDataDeNascimento(){
        return $this->dataDeNascimento;
    }
    public function setDataDeNascimento($dataDeNascimento){
        $this->dataDeNascimento = $dataDeNascimento;
    }

    public function getDataDeEntrada(){
        return $this->dataDeEntrada;
    }
    public function setDataDeEntrada($dataDeEntrada){
        $this->dataDeEntrada = $dataDeEntrada;
    }
}