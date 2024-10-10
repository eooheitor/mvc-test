<?php

use app\View\ViewMain;

/**
 * View que retorna a lista de pessoas
 * @author Heitor
 * @since 03/10/2024
 */

class ViewPessoa extends ViewMain
{
  public $view;

  public function __construct($columns, $data, $createUrl, $table)
  {
    $this->setTitle('Lista de pessoas');
    $this->view = $this->head();
    $this->view .= $this->body();
    $this->view .= $this->divButtons();
    $this->view .= $this->buttonCreate($createUrl);
    $this->view .= $this->endDivButtons();
    $this->view .= $this->formSearch();
    $this->view .= $this->tableList();
    $this->view .= $this->tHead($columns);
    $this->view .= $this->tBody($data, $columns, $table, $btnContato = true);
    $this->view .= $this->endTablelist();
    $this->view .= $this->endBody();
  }

  public function render()
  {
    echo $this->view;
  }
}

$pessoaView = new ViewPessoa($columns, $data, $createUrl, $table);
$pessoaView->render();
