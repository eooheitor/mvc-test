<?php

use app\View\ViewMain;

/**
 * View que retorna a lista de contatos
 * @author Heitor
 * @since 08/10/2024
 */

class ViewContato extends ViewMain
{
  public $view;

  public function __construct($columns, $data, $createUrl, $table, $idPessoa)
  {
    $this->setTitle('Lista de contatos');
    $this->view = $this->head();
    $this->view .= $this->body();
    $this->view .= $this->divButtons();
    $this->view .= $this->buttonCreate($createUrl);
    $this->view .= $this->buttonBack();
    $this->view .= $this->endDivButtons();
    $this->view .= $this->tableList();
    $this->view .= $this->tHead($columns);
    $this->view .= $this->tBody($table, false, $data, $columns, $idPessoa);
    $this->view .= $this->endTablelist();
    $this->view .= $this->endBody();
  }

  public function render()
  {
    echo $this->view;
  }
}

$pessoaView = new ViewContato($columns, $data, $createUrl, $table, $idPessoa);
$pessoaView->render();
