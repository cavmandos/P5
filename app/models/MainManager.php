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
}