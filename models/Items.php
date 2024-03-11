<?php
    class Item {
        public $id;
        public $name;
        public $patrimony;
        public $categories_id;
        public $register_as;
        public $public_date;
        public $made_by;
        public $observations;
    }
    
    interface ItemDAOInterface {
        public function buildItems($data);
        public function findById($id);
        public function findByDate($public_date);
        public function create(Item $item);
        public function update(Item $item);
        public function destroy($id);
    }
?>