<?php

    include_once("models/Items.php");
    include_once("models/Message.php");

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
            // Implemente a lógica para construir um objeto Item com base nos dados fornecidos
            return $item;
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
    
        public function create(Item $item) {
            $stmt = $this->conn->prepare("INSERT INTO items (name, patrimony, category, register_as, public_date, made_by, observations) VALUES (:name, :patrimony, :category, :register_as, :public_date, :made_by, :observations)");
            $stmt->bindParam(":name", $item->name);
            $stmt->bindParam(":patrimony", $item->patrimony);
            $stmt->bindParam(":categories_id", $item->categories_id);
            $stmt->bindParam(":register_as", $item->register_as);
            $stmt->bindParam(":public_date", $item->public_date);
            $stmt->bindParam(":made_by", $item->made_by);
            $stmt->bindParam(":observations", $item->observations);
            $stmt->execute();
            // Adicione a lógica para verificar se a inserção foi bem-sucedida e exibir uma mensagem, se necessário
        }
    
        public function update(Item $item) {
            // Implemente a lógica para atualizar um item no banco de dados
        }
    
        public function destroy($id) {
            // Implemente a lógica para excluir um item do banco de dados
        }
    }