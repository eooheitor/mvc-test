<?php

namespace app\Controller;

use app\Model\Pessoa;

/**
 * Controller para todas as lógicas do CRUD de Pessoa
 * @author Heitor
 * @since 03/10/2024
 */

class PessoaController extends ControllerMain
{

  protected array $columns = ['Id', 'Nome', 'Cpf'];
  protected array $inputs = ['Nome', 'CPF'];

  /**
   * Método para chamar a tela principal
   */
  public function index($search = null)
  {
    $repository = $this->entityManager->getRepository("app\Model\\Pessoa");
    if ($search) {
      $data = $repository->createQueryBuilder('p')
        ->where('p.nome LIKE :nome')
        ->setParameter('nome', '%' . $search . '%')
        ->getQuery()
        ->getResult();
    } else {
      $data = $this->all('Pessoa');
    }
    $createUrl = '/pessoa';
    $table = 'pessoa';
    $this->view('ViewPessoa', [
      'columns' => $this->columns,
      'data' => $data,
      'createUrl' => $createUrl,
      'table' => $table
    ]);
  }

  /**
   * Método para chamar a tela create
   */
  public function create()
  {
    $action = '/pessoa/store';
    $this->view('ViewCreatePessoa', ['columns' => $this->inputs, 'action' => $action]);
  }

  /**
   * Método para processar o cadastro de uma nova pessoa
   */
  public function store()
  {
    $rules = [
      'nome' => true,
      'cpf' => true
    ];
    $this->storeMain(Pessoa::class, '/', $rules);
  }

  /**
   * Método para deletar uma pessoa
   * public porque é chamado no routes
   */
  public function delete($id)
  {
    $this->deleteMain($id, Pessoa::class, '/');
  }

  /**
   * Método de edição de uma pessoa
   */
  public function edit($id)
  {
    $pessoa = $this->entityManager->find(Pessoa::class, $id);
    $action = '/pessoa/update/' . $id;
    if ($pessoa) {
      $this->view('ViewCreatePessoa', [
        'columns' => $this->inputs,
        'action' => $action,
        'edit' => $pessoa ?? null
      ]);
    } else {
      echo "Pessoa não encontrada.";
    }
  }

  /**
   * Método de update para atualizar pessoa
   */
  public function update($id, array $data)
  {
    $this->updateMain(Pessoa::class, '/', $id, $data);
  }

  /**
   * Método de pesquisa
   */
  public function search() {}
}
