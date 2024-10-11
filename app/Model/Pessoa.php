<?php

namespace app\Model;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity]
#[ORM\Table(name: 'pessoa')]
class Pessoa
{
  #[ORM\Id]
  #[ORM\Column(type: 'integer')]
  #[ORM\GeneratedValue]
  private int|null $id = null;

  #[ORM\Column(type: 'string')]
  private string $nome;

  #[ORM\Column(type: 'string', length: 14, unique: true)]
  private string $cpf;

  #[ORM\OneToMany(mappedBy: "idPessoa", targetEntity: Contato::class, cascade: ["persist", "remove"])]
  private $contatos;

  public function __construct()
  {
    $this->contatos = new ArrayCollection();
  }

  public function getId(): int
  {
    return $this->id;
  }

  public function getNome(): string
  {
    return $this->nome;
  }

  public function setNome(string $nome): void
  {
    $this->nome = $nome;
  }

  public function getCpf(): string
  {
    return $this->cpf;
  }

  public function setCpf(string $cpf): void
  {
    $this->cpf = $cpf;
  }

  public function getContatos()
  {
    return $this->contatos;
  }
}
