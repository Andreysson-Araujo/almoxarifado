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
        $stmt=$this->conn->prepare("INSERT INTO categories(category) VALUES(:category)");

        $stmt->bindParam(":category", $category->category);

        $stmt->execute();

        $this->message->setMessage("Categoria criada com sucesso!", "success", "showcategories.php");

    }
    public function update(Category $category){
        
    }
    public function destroy($id){
        
    }
    public function findById($id){
        

        $stmt = $this->conn->prepare("SELECT * FROM categories WHERE id = :id");

        $stmt->bindValue(":id", $id);

        $stmt->execute();

        $category = $stmt->fetch(PDO::FETCH_ASSOC);

        if($category) {
            if ($category) {
                return $this->buildCategories($category);
            }else{
                
                return null;

            }  
        }
                
        

    }
    public function findAll() {
        $stmt = $this->conn->prepare("SELECT * FROM categories");
        $stmt->execute();
        
        $categories = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $categories[] = $this->buildCategories($row);
        }
        
        return $categories;
    }
    

}
?>
