<?php

namespace app\View;

use src\Helpers;

/**
 * View principal que servirá de base para todas as outras
 * @author Heitor
 * @since 03/10/2024
 */

class ViewMain
{

  protected $title;

  /**
   * Setar title por view
   */
  protected function setTitle($title)
  {
    $this->title = $title;
  }

  /**
   * Chamar title por view
   */
  protected function getTitle()
  {
    return $this->title;
  }

  /**
   * Retorna header html com os links úteis
   */
  protected function head()
  {
    return '
    <head>
      <meta charset="UTF-8">
      <title>' . $this->getTitle() . '</title>  
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    </head>';
  }

  /**
   * Inicia body html
   */
  protected function body()
  {
    return '
      <body>
      <div class="container">
        <div class="row mt-5">
          <h1 class="text-center">' .  $this->getTitle()  . '</h1>
          <div class="col-8 mx-auto card">';
  }

  /**
   * Finaliza body html
   */
  protected function endBody()
  {
    return '
          </div>
        </div>
      </div>
      </body>';
  }

  /**
   * Inicia card e table principais do list
   */
  protected function tableList()
  {
    return '
      <table class="table">';
  }

  /**
   * Finaliza card e table principais do list
   */
  protected function endTablelist()
  {
    return '
      </table>';
  }

  /**
   * Retorna Thead e th da table esperando as colunas
   */
  protected function tHead(array $columns)
  {
    $thead = '<thead><tr>';

    foreach ($columns as $column) {
      $thead .= "<th scope=\"col\">{$column}</th>";
    }
    $thead .= "<th scope=\"col\">Ações</th>";

    $thead .= '</tr></thead>';
    return $thead;
  }

  /**
   * Retorna TBody e tr da table esperando as colunas
   */
  protected function tBody(array $data = [], array $columns = [], string $table, bool $btnContato)
  {

    $tbody = '<tbody>';

    foreach ($data as $row) {
      $tbody .= '<tr>';

      foreach ($columns as $column) {
        $column = Helpers::removeAccents($column);
        $getter = 'get' . ucfirst(strtolower($column));
        if (method_exists($row, $getter)) {
          if ($getter == 'getTipo') {
            $value = Helpers::returnTipo($row->$getter());
          } else {
            $value = $row->$getter();
          }
        } else {
          $value = '';
        }
        $tbody .= '<td>' . $value . '</td>';
      }
      if (method_exists($row, 'getId')) {
        $id = $row->getId();
        $tbody .= $this->buttonsRight($table, $id, $btnContato);
      }
      $tbody .= '</tr>';
    }

    $tbody .= '</tbody>';
    return $tbody;
  }

  /**
   * Retorna botões laterais
   */
  protected function buttonsRight($table, $id, $btnContato = true, $contatoId = null)
  {
    $buttons = '<td>';
    if ($btnContato) {
      $buttons .= '<a href="/' . strtolower($table) . '/' . $id . '/contato"><i class="bi bi-telephone-fill text-black"></i></a> ';
      $buttons .= '<a href="/' . strtolower($table) . '/edit/' . $id . '"><i class="bi bi-pencil-square text-black p-1"></i></a>
                     <a href="/' . strtolower($table) . '/delete/' . $id . '"><i class="bi bi-trash text-black"></i></a>';
    }
    if (!$btnContato) {
      $buttons .= '<a href="/' . strtolower($table) . '/edit/' . $id . '"><i class="bi bi-pencil-square text-black p-1"></i></a>
                   <a href="/' . strtolower($table) . '/delete/' . $id . '"><i class="bi bi-trash text-black"></i></a>';
    }

    $buttons .= '</td>';

    return $buttons;
  }

  /**
   * Abre a div de Botões
   */
  protected function divButtons()
  {
    return '<div class="botoes mt-3 mb-2">';
  }

  /**
   * Fecha a div de Botões
   */
  protected function endDivButtons()
  {
    return '</div>';
  }

  /**
   * Retorna o botão Cadastrar
   */
  protected function buttonCreate($sUrl = '#')
  {
    return '<a class="btn btn-primary mx-2" href="' . $sUrl . '">
              Cadastrar
            </a>';
  }

  /**
   * Retorna o botão para voltar a home
   */
  protected function buttonBack()
  {
    return '<a class="btn btn-info text-white" href="/">
              Voltar para a home
            </a>';
  }

  /**
   * Retorna botão de submit do form
   */
  protected function buttonSubmit()
  {
    return '<button class="btn btn-primary mx-2" type="submit">
              Cadastrar
            </button>';
  }

  /**
   * Retorna o forms para cadastro e edição
   */
  protected function form(array $columns, string $action, $editData = null)
  {
    $form = '<div class="p-3">
      <form method="POST" action="' . $action . '">';

    foreach ($columns as $column) {
      $column = Helpers::removeAccents($column);
      $value = $editData ? $editData->{'get' . ucfirst($column)}() : '';
      $form .= '<div class="mb-3">
          <label for="" class="form-label text-uppercase text-danger fw-bold">' . $column . '*</label>
          <input type="text" class="form-control" id="" name="' . strtolower($column) . '" value="' . $value . '">
          </div>';
    }

    return $form;
  }

  /**
   * Retorna select para campo Tipo
   */
  protected function selectTipo($value = null)
  {
    $value = (string) $value;
    $form = '
        <div class="mb-3">
            <label class="text-danger fw-bold mb-1">SELECIONE O TIPO*</label>
            <select name="tipo" class="form-select">
                <option value="0" ' . ($value == "0" ? 'selected' : '') . '>Telefone</option>
                <option value="1" ' . ($value == "1" ? 'selected' : '') . '>Email</option>
            </select>
        </div>';

    return $form;
  }

  protected function formSearch()
  {
    return '
        <form method="GET" action="/">
            <label class="fw-bold"> Pesquisa por nome </label>
            <input class="form-control" name="search" placeholder="Digite e pressione ENTER" maxlength="50" style="width: 300px;">
        </form>
    ';
  }
  /**
   * Finaliza form
   */
  protected function endForm()
  {
    return '</form></div>';
  }
}
