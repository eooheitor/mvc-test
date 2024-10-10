<?php

namespace app\View;

use app\Model\Contato;

/**
 * Classe que irá retornar a view create Contato
 * @author Heitor
 * @since 09/10/2024
 */

class ViewCreateContato extends ViewMain
{
  public $view;

  public function __construct($inputs, $action, $edit = null)
  {
    $tipoContato = ($edit ? $edit->getTipo() : '');
    $this->setTitle($edit == null ? 'Cadastro de Contato' : 'Edição de Contato');
    $this->view = $this->head();
    $this->view .= $this->body();
    $this->view .= $this->form($inputs, $action, $edit);
    $this->view .= $this->selectTipo($tipoContato);
    $this->view .= $this->divButtons();
    $this->view .= $this->buttonSubmit();
    $this->view .= $this->buttonBack();
    $this->view .= $this->endDivButtons();
    $this->view .= $this->endForm();
    $this->view .= $this->endBody();
  }

  public function render()
  {
    echo $this->view;
  }
}

$contatocreateView = new ViewCreateContato($columns, $action, $edit);
$contatocreateView->render();
