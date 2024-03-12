<?php
 
  require_once("models/User.php");
  require_once("models/Message.php");


  class UserDAO implements UserDAOInterface {

    private $conn;
    private $url;
    private $message;

    public function __construct(PDO $conn, $url) {
      $this->conn = $conn;
      $this-> url = $url;
      $this->message = new Message($url);
    }

    public function buildUser($data){

      $user = new User();

      $user->id = $data["id"];
      $user->name = $data["name"];
      $user->nickname = $data["nickname"];
      $user->email = $data["email"];
      $user->password = $data["password"];
      $user->image = $data["image"];
      $user->token = $data["token"];
      $user->adm = $data["adm"];

      return $user;
    }
    public function create(User $user, $authUser = false){

      $stmt = $this->conn->prepare("INSERT INTO users(
        name, nickname, email,password, token
      ) VALUES(
        :name, :nickname, :email, :password, :token
      )");

      $stmt->bindParam(":name", $user->name);
      $stmt->bindParam(":nickname", $user->nickname);
      $stmt->bindParam(":email", $user->email);
      $stmt->bindParam(":password", $user->password);
      $stmt->bindParam(":token", $user->token);

      $stmt->execute();

      //autenticar usuario caso seja true
      if($authUser) {
        $this->setTokenToSession($user->token);
      }
      
    }
    //atulizar usuario.
    public function update(User $user, $redirect = true) {
      $stmt = $this->conn->prepare("UPDATE users SET
      name =  :name,
      nickname = :nickname,
      email = :email,
      image = :image,
      token = :token,
      adm = :adm
      WHERE id = :id
      ");
      $stmt->bindParam(":name", $user->name);
      $stmt->bindParam(":nickname", $user->nickname);
      $stmt->bindParam(":email", $user->email);
      $stmt->bindParam(":image", $user->image);
      $stmt->bindParam(":token", $user->token);
      $stmt->bindParam(":adm", $user->adm);
      $stmt->bindParam(":id", $user->id); 

      $stmt->execute();
 
        //direciona para o perfil do usuario
      $this->message->setMessage("Dados Atualizados com sucesso!", "success", "editprofile.php");
      
    }

    public function changePassword(User $user) {

      $stmt = $this->conn->prepare("UPDATE users SET
        password = :password
        WHERE id = :id
      ");
      $stmt->bindParam(":password", $user->password);
      $stmt->bindParam(":id", $user->id);

      $stmt->execute();

      $this->message->setMessage("Senha alterada com sucesso!", "success", "editprofile.php");

    }

    public function verifyToken($protected = false){
      if(!empty($_SESSION["token"])) {
        
        $token = $_SESSION["token"];

        $user = $this->findByToken($token);

        if($user) {
          return $user;
        } else if($protected){
          //Redireciona usuario não autenticado
          $this->message->setMessage("Realize a autenticação para acessar está pagina!", "error", "index.php");
        }

      }else if($protected){
        //Redireciona usuario não autenticado
        $this->message->setMessage("Realize a autenticação para acessar está pagina!", "error", "index.php");
      }
    }
    public function setTokenToSession($token, $redirect = true) {

      //Salvar token na sessao
      $_SESSION["token"] = $token;

      if($redirect) {
        //Redireciona para o perfil do usuario.
        $this->message->setMessage("Seja bem-vindo!", "success", "editprofile.php");
      }

    }



    public function authenticateUser($nickname, $password) {

      $user = $this->findyByNickname($nickname);

      if($user) {
        // verificar se senhas coiciiden

        if (password_verify($password, $user->password)) {
          //GERAR UM TOKEN E INSERIR NA SESSAO
          $token = $user->generateToken();

          $this->setTokenToSession($token, false);

          $user->token = $token;

          $this->update($user, false);
          
          return true;

        } else {
          return false;
        }
        echo $password;
      } else {
        return false;
      }
    }


    public function findyByEmail($email) {

      if($email != "") {

        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");

        $stmt->bindParam(":email", $email);

        $stmt->execute();

        if($stmt->rowCount() > 0) {

          $data = $stmt->fetch();
          $user = $this->buildUser($data);

          return $user;

        }else{

          return false;

        }

      }else{
        return false;
      }

    }

    public function findyByNickname($nickname) {

      if($nickname != "") {

        $stmt = $this->conn->prepare("SELECT * FROM users WHERE nickname = :nickname");

        $stmt->bindParam(":nickname", $nickname);

        $stmt->execute();

        if($stmt->rowCount() > 0) {

          $data = $stmt->fetch();
          $user = $this->buildUser($data);

          return $user;

        }else{

          return false;

        }

      }else{
        return false;
      }

    }


    public function findyById($id) {

    }

    public function findByToken($token) {
      if($token != "") {

        $stmt = $this->conn->prepare("SELECT * FROM users WHERE token = :token");

        $stmt->bindParam(":token", $token);

        $stmt->execute();

        if($stmt->rowCount() > 0) {

          $data = $stmt->fetch();
          $user = $this->buildUser($data);

          return $user;

        }else{

          return false;

        }

      }else{
        return false;
      }
    }

    public function destroyToken() {
      $_SESSION["token"] = "";

      $this->message->setMessage("Você deslogou com sucesso!", "success", "auth.php");
    }

    
  }