<?php
  class User {
    public $id;
    public $name;
    public $nickname;
    public $email;
    public $password;
    public $image;
    public $token;
    public $adm;

   

    public function generateToken() {
      return bin2hex(random_bytes(50));
    }
    public function generatePassword($password) {
      return password_hash($password, PASSWORD_DEFAULT);
    }
    public function generateImageName() {
      return bin2hex(random_bytes(60)) . ".jpg";
    }
    
  }

  interface UserDAOInterface {
    public function buildUser($data);
    public function create(User $user, $authUser = false);
    public function update(User $user, $redirect = true);
    public function findByToken($token);
    public function verifyToken($protected = false);
    public function setTokenToSession($token, $redirect = true);
    public function authenticateUser($nickname, $password);
    public function findyByEmail($email);
    public function findyByNickname($nickname);
    public function findyById($id);
    public function destroyToken();
    public function changePassword(User $user);

  }

