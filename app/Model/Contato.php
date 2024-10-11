<?php

namespace app\Model;

use Doctrine\ORM\Mapping as ORM;
use app\Model\Pessoa;

#[ORM\Entity]
#[ORM\Table(name: 'contato')]
class Contato
{
  #[ORM\Id]
  #[ORM\Column(type: 'integer')]
  #[ORM\GeneratedValue]
  private int $id;

  #[ORM\Column(type: 'boolean')]
  private bool $tipo;

  #[ORM\Column(type: 'string', length: 250)]
  private string $descricao;

  #[ORM\ManyToOne(targetEntity: "app\Model\Pessoa", inversedBy: "contatos")]
  #[ORM\JoinColumn(name: "idPessoa", referencedColumnName: "id", nullable: false, onDelete: "CASCADE")]
  private Pessoa $idPessoa;

  // Getters e Setters

  public function getId(): int
  {
    return $this->id;
  }

  public function getTipo(): bool
  {
    return $this->tipo;
  }

  public function setTipo(bool $tipo): void
  {
    $this->tipo = $tipo;
  }

  public function getDescricao(): string
  {
    return $this->descricao;
  }

  public function setDescricao(string $descricao): void
  {
    $this->descricao = $descricao;
  }

  public function getIdPessoa(): Pessoa
  {
    return $this->idPessoa;
  }

  public function setIdPessoa(Pessoa $idPessoa): void
  {
    $this->idPessoa = $idPessoa;
  }
}
