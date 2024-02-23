<?php
include_once("models/Categories.php");
include_once("models/Message.php");

class CategoryDAO implements CategoryDAOInterface {
    private $conn;
    private $url;
    private $message;

    public function __construct(PDO $conn, $url) {
        $this->conn = $conn;
        $this->url = $url;
        $this->message = new Message($url);
    }

    public function buildCategories($data){
        $category = new Category();
        
        $category->id = $data["id"];
        $category->category = $data["category"];

        return $category;
        
    }

    public function create(Category $category){
        
    }
    public function update(Category $category){
        
    }
    public function destroy($id){
        
    }
    public function findById($id){
        
}

}
?>
