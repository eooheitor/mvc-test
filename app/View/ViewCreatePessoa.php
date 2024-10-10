<?php

namespace app\View;
use app\Model\Pessoa;
/**
 * Classe que irá retornar a view create Pessoa
 * @author Heitor
 * @since 05/10/2024
 */

class ViewCreatePessoa extends ViewMain
{
  public $view;

  public function __construct($inputs, $action, $edit)
  {
    $this->setTitle($edit == null ? 'Cadastro de Pessoa' : 'Edição de pessoa');
    $this->view = $this->head();
    $this->view .= $this->body();
    $this->view .= $this->form($inputs, $action, $edit);
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
$pessoacreateView = new ViewCreatePessoa($columns, $action, $edit);
$pessoacreateView->render();
