<?php

require_once './app/models/ModelClass.php';

class MainManager extends Model
{
    // Get posts
    public function getDatas()
    {
        $pdo = $this->getBdd();
        $req = $pdo->prepare("SELECT * FROM post INNER JOIN user ON post.user_id = user.id_user");
        $req->execute();
        $datas = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $datas;
    }
    // Get a post
    public function getPost($id)
    {
        $pdo = $this->getBdd();
        $req = $pdo->prepare("SELECT * FROM post INNER JOIN user ON post.user_id = user.id_user WHERE id_post = :id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $datas = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $datas;
    }
    // Get comments
    public function getCommentsOK($id)
    {
        $pdo = $this->getBdd();
        $req = $pdo->prepare("SELECT * FROM comment INNER JOIN user ON comment.user_id = user.id_user WHERE post_id = :id AND is_valid = 1");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $comments = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $comments;
    }
    // Get pending comments
    public function getCommentsNotOK($id)
    {
        $pdo = $this->getBdd();
        $req = $pdo->prepare("SELECT * FROM comment INNER JOIN user ON comment.user_id = user.id_user WHERE post_id = :id AND is_valid = 0");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $comments = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $comments;
    }
    // Update post
    public function updatePostDB($id, $title, $summary, $content)
    {
        $datetime = date_create()->format('Y-m-d H:i:s');
        $req = "UPDATE post SET title = :title, summary = :summary, content = :content, update_date = :updateDate WHERE id_post = :id ";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(':title', $title, PDO::PARAM_STR);
        $stmt->bindValue(':summary', $summary, PDO::PARAM_STR);
        $stmt->bindValue(':content', $content, PDO::PARAM_STR);
        $stmt->bindValue(':updateDate', $datetime, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $isRegistered = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $isRegistered;
    }
    // Delete post
    public function deletePostDB($id)
    {
        $req = "DELETE FROM post WHERE id_post = :id";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $isDeleted = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $isDeleted;
    }
    // Get user
    public function getUser($email)
    {
        $pdo = $this->getBdd();
        $req = $pdo->prepare("SELECT id_user, first_name, last_name, username, email, is_admin FROM user WHERE email = :email");
        $req->bindValue(':email', $email, PDO::PARAM_STR);
        $req->execute();
        $datas = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $datas;
    }
    // Get user password
    private function getPasswordUser($email)
    {
        $req = "SELECT password FROM user WHERE email = :email";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $result['password'];
    }
    // Check email/password
    public function isCombinationValid($email, $password)
    {
        $passwordDB = $this->getPasswordUser($email);
        return password_verify($password, $passwordDB);
    }
    // Check admin status
    public function isAdmin($email)
    {
        $req = "SELECT is_admin FROM user WHERE email = :email ";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $result['is_admin'];
    }
    // Set new token
    public function setTokenDB($email, $token)
    {
        $req = "UPDATE user SET token = :token WHERE email = :email ";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':token', $token, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $result['token'];
    }
    // Verify the token
    public function verifyToken($email)
    {
        $req = "SELECT token FROM user WHERE email = :email ";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $result['token'];
    }
    // Remove token
    public function removeTokenDB($email)
    {
        $req = "UPDATE user SET token = 0 WHERE email = :email ";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
    }
    // Check account availability
    public function isAccountAvailable($email)
    {
        $req = "SELECT * FROM user WHERE email = :email ";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return empty($result);
    }
    // Create a new account
    public function createAccountDB($email, $passwordHash, $firstname, $lastname, $username)
    {
        $datetime = date_create()->format('Y-m-d H:i:s');
        try {
            $req = "INSERT INTO `user` (`id_user`, `first_name`, `last_name`, `username`, `email`, `password`, `user_creation_date`, `is_admin`, `is_online`, `token`) VALUES (NULL, :firstname, :lastname, :username, :email, :password, :datetime, '0', '0', '');";
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
        } catch (PDOException $e) {
            echo $req . "<br>" . $e->getMessage();
        }
    }
    // Update user mail
    public function updateMailUser($login, $email)
    {
        $req = "UPDATE user SET email = :email WHERE email = :login ";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':login', $login, PDO::PARAM_STR);
        $stmt->execute();
        $isRegistered = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $isRegistered;
    }
    // Delete account
    public function deleteUserAccount($email)
    {
        $req = "DELETE FROM user WHERE email = :email";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $isRegistered = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $isRegistered;
    }
    // Create a post
    public function createPostDB($title, $summary, $content, $user)
    {
        $datetime = date_create()->format('Y-m-d H:i:s');
        try {
            $req = "INSERT INTO `post` (`id_post`, `title`, `summary`, `content`, `creation_date`, `update_date`, `user_id`) VALUES (NULL, :title, :summary, :content, :datetime, :datetime, :user);";
            $stmt = $this->getBdd()->prepare($req);
            $stmt->bindValue(':title', $title, PDO::PARAM_STR);
            $stmt->bindValue(':summary', $summary, PDO::PARAM_STR);
            $stmt->bindValue(':content', $content, PDO::PARAM_STR);
            $stmt->bindValue(':datetime', $datetime, PDO::PARAM_STR);
            $stmt->bindValue(':user', $user, PDO::PARAM_INT);
            $stmt->execute();
            $isRegistered = ($stmt->rowCount() > 0);
            $stmt->closeCursor();
            return $isRegistered;
        } catch (PDOException $e) {
            echo $req . "<br>" . $e->getMessage();
        }
    }
    // Get id user
    public function getIdUser($email)
    {
        $pdo = $this->getBdd();
        $req = $pdo->prepare("SELECT id_user FROM user WHERE email = :email");
        $req->bindValue(':email', $email, PDO::PARAM_STR);
        $req->execute();
        $datas = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $datas;
    }
    // Create a comment
    public function createCommentDB($id, $comment, $user)
    {
        $datetime = date_create()->format('Y-m-d H:i:s');
        try {
            $req = "INSERT INTO `comment` (`id_comment`, `comment_content`, `creation_date`, `is_valid`, `user_id`, `post_id`) VALUES (NULL, :comment, :datetime, 0, :user_id, :post_id);";
            $stmt = $this->getBdd()->prepare($req);
            $stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
            $stmt->bindValue(':user_id', $user, PDO::PARAM_INT);
            $stmt->bindValue(':post_id', $id, PDO::PARAM_INT);
            $stmt->bindValue(':datetime', $datetime, PDO::PARAM_STR);
            $stmt->execute();
            $isRegistered = ($stmt->rowCount() > 0);
            $stmt->closeCursor();
            return $isRegistered;
        } catch (PDOException $e) {
            echo $req . "<br>" . $e->getMessage();
        }
    }
    // Delete a comment
    public function deleteCommentDB($id)
    {
        $req = "DELETE FROM comment WHERE id_comment = :id";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $isDeleted = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $isDeleted;
    }
    // Confirm comment
    public function confirmCommentDB($id)
    {
        $req = "UPDATE comment SET is_valid = 1 WHERE id_comment = :id ";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $isRegistered = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $isRegistered;
    }
}
