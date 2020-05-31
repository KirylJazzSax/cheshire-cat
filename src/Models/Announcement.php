<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 29.05.2020
 * Time: 17:43
 */

namespace Src\Models;

use PDO;

class Announcement
{
    public $id;
    public $title;
    public $description;
    public $price;
    private $errors;
    private $pdo;
    private $perPage = 10;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findAll($queryParams = null)
    {
        $sql = 'SELECT id, title, price, created_at FROM announcements';

        if ($queryParams && count($queryParams) > 0) {
            $sql = $this->buildSqlFromQuery($sql, $queryParams);
        } else {
            $sql .= ' LIMIT ' . $this->perPage;
        }

        $result = $this->pdo->query($sql);
        return $result ? $result->fetchAll(PDO::FETCH_ASSOC) : false;
    }

    public function findOne($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM announcements WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getPages()
    {
        $count = $this->pdo->query('SELECT COUNT(*) FROM announcements')->fetchColumn();
        return ceil($count / $this->perPage);
    }

    public function validate(): bool
    {
        $this->errors = [];

        if ($this->title === '') {
            $this->setError('title', 'Заголовок не должен быть пустым');
        }

        if (empty($this->price) || !is_numeric($this->price)) {
            $this->setError('price', 'Цена не должена быть пуста и значиние должно быть число');
        }

        if (empty($this->description)) {
            $this->setError('description', 'Описание не должно быть пусто');
        }

        if (empty($this->errors)) {
            return true;
        }
        return false;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function save(): bool
    {
        $data = [
            'title' => $this->title,
            'price' => $this->price,
            'description' => $this->description
        ];
        $sql = "INSERT INTO announcements (title, price, description) VALUE (:title, :price, :description);";
        return $this->pdo->prepare($sql)->execute($data);
    }

    public function setPerPage(int $page): void
    {
        $this->perPage = $page;
    }

    private function setError($attribute, $error): void
    {
        $this->errors[$attribute] = $error;
    }

    private function buildSqlFromQuery($sql, $queryParams): string
    {

        if (isset($queryParams['sort'])) {
            $sql .= ' ORDER BY ' . $queryParams['sort'];

            if (isset($queryParams['order'])) {
                $sql .= ' ' . $queryParams['order'];
            }
        }

        if (isset($queryParams['page'])) {
            $offset = ($this->perPage * $queryParams['page']) - $this->perPage;
            $sql .= ' LIMIT ' . $this->perPage . ' OFFSET ' . $offset;
        }

        return $sql;
    }
}