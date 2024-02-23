<?php
    class Category {
        public $id;
        public $category;
    }
    
    interface CategoryDAOInterface {
        public function buildCategories($data);
        public function findById($id);
        public function create(Category $category);
        public function update(Category $category);
        public function destroy($id);
    }
?>