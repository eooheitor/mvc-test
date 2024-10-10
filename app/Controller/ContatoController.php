<?php

namespace app\Controller;

use app\Model\Contato;
use app\Model\Pessoa;

/**
 * Controller para todas as lógicas do CRUD Contato
 * @author Heitor
 * @since 08/10/2024
 */
class ContatoController extends ControllerMain
{
  protected array $columns = ['Id', 'Tipo', 'Descrição'];
  protected array $inputs = ['Descrição'];

  /**
   * Método para chamar a tela principal
   */
  public function index($idPessoa)
  {
    $data = $this->allByPessoaId('Contato', ['pessoaId' => $idPessoa]);
    $createUrl = '/pessoa/' . $idPessoa . '/contato/create';
    $table = 'contato';
    $this->view('ViewContato', [
      'columns' => $this->columns,
      'data' => $data,
      'createUrl' => $createUrl,
      'table' => $table
    ]);
  }

  /**
   * Método para chamar a tela create
   */
  public function create($id)
  {
    $action = '/pessoa/' . $id . '/contato/store';
    $this->view('ViewCreateContato', ['columns' => $this->inputs, 'action' => $action]);
  }

  /**
   * Método para processar o cadastro de um novo contato
   */
  public function store($idPessoa)
  {
    $rules = [
      'descricao' => true,
    ];
    $contato = new Contato();
    $pessoa = $this->entityManager->find(Pessoa::class, $idPessoa);
    $contato->setIdPessoa($pessoa);
    $this->storeMain($contato, "/pessoa/{$idPessoa}/contato", $rules);
  }
  /**
   * Método para deletar um contato 
   */
  public function delete($id)
  {
    $this->deleteMain($id, Contato::class, "/");
  }

  /**
   * Método para editar o contato
   */
  public function edit($id)
  {
    $contato = $this->entityManager->find(Contato::class, $id);
    $action = '/contato/update/' . $id;
    if ($contato) {
      $this->view('ViewCreateContato', [
        'columns' => $this->inputs,
        'action' => $action,
        'edit' => $contato ?? null
      ]);
    } else {
      echo "Contato não encontrada.";
    }
  }

  /**
   * Método para atualizar o contato
   */
  public function update($id, array $data)
  {
    $this->updateMain(Contato::class, '/', $id, $data);
  }
}
