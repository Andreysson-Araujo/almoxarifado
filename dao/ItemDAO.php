<?php

include_once("models/Items.php");
include_once("models/Message.php");
require_once("dao/CategoryDAO.php");

class ItemDAO implements ItemDAOInterface {
    private $conn;
    private $url;
    private $message;

    public function __construct(PDO $conn, $url) {
        $this->conn = $conn;
        $this->url = $url;
        $this->message = new Message($url);
    }

    public function buildItems($data) {
        $item = new Item();
        $item->id = $data['id'];
        $item->name = $data['name'];
        $item->patrimony = $data['patrimony'];
        $item->categories_id = $data['categories_id'];
        $item->register_as = $data['register_as'];
        $item->public_date = $data['public_date'];
        $item->made_by = $data['made_by'];
        $item->observations = $data['observations'];
        return $item;
    }
    
    public function create(Item $item) {
        $stmt = $this->conn->prepare("INSERT INTO items (name, patrimony, categories_id, register_as, public_date, made_by, observations) VALUES (:name, :patrimony, :categories_id, :register_as, :public_date, :made_by, :observations)");
        $stmt->bindParam(":name", $item->name);
        $stmt->bindParam(":patrimony", $item->patrimony);
        $stmt->bindParam(":categories_id", $item->categories_id); // Corrigido
        $stmt->bindParam(":register_as", $item->register_as);
        $stmt->bindParam(":public_date", $item->public_date);
        $stmt->bindParam(":made_by", $item->made_by);
        $stmt->bindParam(":observations", $item->observations);

        $stmt->execute();

        $this->message->setMessage("item criado com sucesso!", "success", "back");

    }

    public function findAll() {
        $stmt = $this->conn->prepare("SELECT * FROM items ORDER BY id DESC");
        $stmt->execute();

        $items = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $items[] = $this->buildItems($row);
        }

        return $items;
    }

    public function findById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM items WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            return $this->buildItems($data);
        }
        return null; // Retornar null se o item não for encontrado
    }

    public function findByDate($public_date) {
        // Implemente a lógica para encontrar um item pela data de publicação, se necessário
    }


    public function update(Item $item) {
        // Implemente a lógica para atualizar um item no banco de dados
    }

    public function destroy($id) {
        // Implemente a lógica para excluir um item do banco de dados
    }
}