<?php
class Dados {

    private $pdo;

    public function __construct() {
        $this->pdo = new PDO("mysql:dbname=cadastro;host=localhost", "root","");
    } 

    public function adicionar($codpais, $nomepais = '') {
        if ($this->existeCodpais($idpais) == false) {
            $sql = "INSERT INTO pais (codpais, nomepais) VALUES (:codpais, :nomepais)";
            $sql = $this->pdo->prepare($sql);
            $sql->bindValue(':codpais', $codpais);
            $sql->bindValue(':nomepais', $nomepais);
            $sql->execute();
           
            return true; 
        } else {
            return ;
        }
    }
    public function getCodpais($codpais) {
        $sql = "SELECT * FROM pais WHERE codpais = :codpais";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(':codpais', $codpais);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $dados = $sql->fetch();
            return $dados['codpais'];
        }else {
            return '';
        }
    }

    public function getInfo ($idpais) {
        $sql = "SELECT * FROM pais WHERE idpais = :idpais"; 
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue('idpais', $idpais);
        $sql->execute();

        if($sql->rowCount() > 0) {
            return $sql->fetch();
        }else {
            return array();
        }
    }

    public function getAll() {
        $sql = "SELECT * FROM pais"; 
        $sql = $this->pdo->query($sql);

        if($sql->rowCount() > 0) {
            return $sql->fetchAll();
        }else {
            return array();
        }
    }

    public function editar($idpais, $codpais, $nomepais){
         if($this->existeCodpais($idpais)) {
            $sql = "UPDATE pais SET codpais = :codpais, nomepais = :nomepais WHERE idpais = :idpais";
            $sql = $this->pdo->prepare($sql);
            $sql->bindValue(':idpais', $idpais);
            $sql->bindValue(':codpais', $codpais);
            $sql->bindValue(':nomepais', $nomepais);
            $sql->execute();
        }
    }

    public function excluir($idpais) {
        if($this->existeCodpais($idpais)){
            $sql = "DELETE FROM pais WHERE idpais = :idpais";
            $sql = $this->pdo->prepare($sql); 
            $sql->bindValue(':idpais', $idpais);
            $sql->  execute();

            return true;
        }else {
            return false;
        }
    }

    private function existeCodpais($idpais) {
        $sql = "SELECT * FROM pais WHERE idpais = :idpais";
        $sql = $this->pdo->prepare($sql); 
        $sql->bindValue(':idpais', $idpais);
        
        if (!$sql->execute()) {
            var_dump($sql->errorInfo());
        }

        if($sql->rowCount() > 0) {
            return true;
        }else {
            return false;
        }

        
    }

}


?>