<?php

require_once('./app/models/ModelClass.php');

class MainManager extends Model {
    public function getDatas(){
        $pdo = $this->getBdd();
        $req = $pdo->prepare("SELECT * FROM post INNER JOIN user ON post.user_id = user.id");
        $req->execute();
        $datas = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $datas;
    }

    public function getUsers(){
        $pdo = $this->getBdd();
        $req = $pdo->prepare("SELECT * FROM user");
        $req->execute();
        $datas = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $datas;
    }

    private function getPasswordUser($email){
        $req = "SELECT password FROM user WHERE email = :email ";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $result['password'];
    }

    public function isCombinationValid($email, $password){
        $passwordDB = $this->getPasswordUser($email);
        return password_verify($password, $passwordDB);
    }

    public function isAdmin($email){
        $req = "SELECT is_admin FROM user WHERE email = :email ";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $result['is_admin'];
    }

    public function setTokenDB($email, $token){
        $req = "UPDATE user SET token = :token WHERE email = :email ";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':token', $token, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $result['token'];
    }

    public function verifyToken($email){
        $req = "SELECT token FROM user WHERE email = :email ";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $result['token'];
    }

    public function removeTokenDB($email){
        $req = "UPDATE user SET token = 0 WHERE email = :email ";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
    }

    public function isAccountAvailable($email){
        $req = "SELECT * FROM user WHERE email = :email ";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return empty($result);
    }

    public function createAccountDB($email, $passwordHash, $firstname, $lastname, $username){
        $datetime = date_create()->format('Y-m-d H:i:s');
        try {
            $req = "INSERT INTO `user` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `creation_date`, `is_admin`, `is_online`, `token`) VALUES (NULL, :firstname, :lastname, :username, :email, :password, :datetime, '0', '0', '');";
            $stmt = $this->getBdd()->prepare($req);
            $stmt->bindValue(':firstname', $firstname, PDO::PARAM_STR);
            $stmt->bindValue(':lastname', $lastname, PDO::PARAM_STR);
            $stmt->bindValue(':username', $username, PDO::PARAM_STR);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->bindValue(':password', $passwordHash, PDO::PARAM_STR);
            $stmt->bindValue(':datetime', $datetime, PDO::PARAM_STR);
            $stmt->execute();
            $isRegistered = ($stmt->rowCount() > 0);
            $stmt->closeCursor();
            return $isRegistered;
          } catch(PDOException $e) {
            echo $req . "<br>" . $e->getMessage();
          }
    }
}