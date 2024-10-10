<?php

namespace app\Controller;

use app\Model\Pessoa;
use Doctrine\ORM\EntityManager;
use Exception;
use src\Helpers;

/**
 * Controller Principal que será chamado em todos os outros
 * @author Heitor
 * @since 03/10/2024
 */

class ControllerMain
{

  protected EntityManager $entityManager;

  /**
   * Construct retornando $entityManager para fazer as transaçoes no bd
   */
  public function __construct()
  {
    $this->entityManager = require __DIR__ . '/../../src/Bootstrap.php';
  }

  /**
   * Método para controlar a chamada das views
   */
  public static function view($view, $data = [])
  {
    extract($data);
    $viewPath = "../app/View/{$view}.php";
    if (file_exists($viewPath)) {
      require $viewPath;
    } else {
      echo "View não encontrada";
    }
  }

  /**
   * Método para trazer todos os dados de uma tabela e listar
   */
  protected function all($table)
  {
    $repository = $this->entityManager->getRepository("app\Model\\$table");
    $data = $repository->findAll();
    return $data;
  }

  /**
   * Método para trazer todos os contatos filtrando pelo pessoaId
   */
  protected function allByPessoaId($table, $pessoaId)
  {
    $repository = $this->entityManager->getRepository("app\Model\\$table");
    $data = $repository->findBy(['idPessoa' => $pessoaId]);
    return $data;
  }

  /**
   * Método para deletar do bd
   */
  protected function deleteMain($id, $tableClass, $location)
  {
    $delete = $this->entityManager->find($tableClass, $id);
    if ($delete) {
      $this->entityManager->remove($delete);
      $this->entityManager->flush();
      header("Location:" . $location);
      exit;
    } else {
      echo "Não encontrado" . "<br>";
      echo "ID recebido para deletar: " . $id . "<br>";
      echo "Na table: " . $tableClass;
    }
  }

  /**
   * Método para remover caracteres desnecessários na validação de setter
   */
  protected function sanitize($value)
  {
    return trim(strip_tags($value));
  }

  /**
   * Método para não precisar chamar os setters e os posts manualmente
   */
  protected function dinamicPost($entity, $data)
  {
    foreach ($data as $field => $value) {
      $fieldCleaned = Helpers::removeAccents($field);
      $setter = 'set' . ucfirst($fieldCleaned);
      if (method_exists($entity, $setter)) {
        if (!is_null($value) && $value !== '') {
          $entity->$setter($this->sanitize($value));
        }
      } else {
        throw new Exception("Método {$setter} não existe na entidade " . get_class($entity));
      }
    }
  }

  /**
   * Método para controlar as validações dos forms
   */
  protected function validateData($data, $rules)
  {
    $errors = [];
    foreach ($rules as $field => $isRequired) {
      if ($isRequired && empty($data[$field])) {
        $errors[] = ucfirst($field) . ' é obrigatório';
      }
    }
    return $errors;
  }

  /**
   * Método que controlará todo o store dos controllers 
   */
  protected function storeMain($entityOrClass, $location, $rules)
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $validationErrors = $this->validateData($_POST, $rules);
      if (!empty($validationErrors)) {
        echo 'Erros de validação: ' . implode(', ', $validationErrors);
        return;
      }
      try {
        if (is_string($entityOrClass)) {
          $entity = new $entityOrClass();
        } else {
          $entity = $entityOrClass;
        }
        $this->dinamicPost($entity, $_POST);
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
        header("Location:" . $location);
        exit;
      } catch (Exception $e) {
        echo 'Erro ao fazer cadastro: ' . $e->getMessage();
      }
    } else {
      echo 'Método inválido';
    }
  }
  /**
   * Método para servir de base para os updates
   */
  public function updateMain($class, $location, $id, array $data)
  {
    $entity = $this->entityManager->find($class, $id);
    if (!$entity) {
      echo "Entidade não encontrada.";
      return;
    }
    try {
      $this->dinamicPost($entity, $data);
      $this->entityManager->flush();
      header("Location:" . $location);
    } catch (Exception $e) {
      echo "Erro ao atualizar entidade: " . $e->getMessage();
    }
  }
}
