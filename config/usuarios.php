<?php

Class Usuario
{
	private $pdo;
	public $msgErro = ""; //tudo ok

	public function conectar($nome, $host, $usuario, $senha)
	{
		global $pdo;
		global $msgErro;
		try 
		{
			$pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);
			
		} catch (PDOException $e) {
			$msgErro = $e->getMessage ();
		}
	}

	public function cadastrar($nome, $telefone, $email, $senha)
	{
		global $pdo;
		//verificar se já existe o email cadastrado
		$sql = $pdo->prepare("SELECT idusuario FROM usuario WHERE email = :e");
		$sql->bindValue(":e", $email);
		$sql->execute();
		if($sql->rowCount() > 0)
		{
			return false; //já está cadastrada
		}
		else
		{
			//caso nao, cadastrar
			$sql = $pdo->prepare("INSERT INTO usuario (nome, telefone, email, senha) VALUES (:n,:t,:e,:s)");
			$sql->bindValue(":n", $nome);
			$sql->bindValue(":t", $telefone);
			$sql->bindValue(":e", $email);
			$sql->bindValue(":s", $senha);
			$sql->execute();
			return true;
		}
	}
	public function logar($email, $senha)
	{
		global $pdo;
		//verificar se o email e a senha  estão cadastrados, se sim
		$sql = $pdo->prepare("SELECT idusuario FROM usuario WHERE email = :e AND senha = :s");
		$sql->bindValue(":e", $email);
		$sql->bindValue(":s", $senha);
		$sql->execute();
        if($sql->rowCount() > 0)
		{
			//entrar no sistema (sessao)
			$dado = $sql->fetch();
			session_start();
			$_SESSION['idusuario'] = $dado['idusuario'];
			return true; //cadastrado com sucesso
		}
		else
		{
			return false;//não possivel logar

		} 
	}

	/*public function recuperar_senha ($email) {
		
		if (!empty($_POST'email')) {
			$email = $_POST ['email'];

			$sql "SELECT * FROM recuperar_token WHERE email = :email";
			$sql = $pdo->prepare($sql);
			$sql->bindValue(":email", $email);
			$sql->execute();

			if($sql->rowCount > 0) {

				$sql = $sql->fetch();
				$id = $sql['id'];

				$token = md5(time().rand(0, 88888).rand(0, 99999));

				$sql = "INSERT INTO recuperar_token (id_usuario, hash, expirado_em) VALUES (:id_usuario, :hash, :expirado_em)";

				$sql = $pdo->prepare($sql);
				$sql->bindValue(":id_usuario", $id); 
				$sql->bindValue(":hash", $token);
				$sql->bindValue(":experidado_em", date('Y-m-d H:i', strtotime('+2 months')));
				$sql->execute();

				$mensagem = echo "Acesse seu e-mail e clique no link para redefinir sua SENHA";  
				
				$assunto = "Redefinir Senha"
				$headers
			}
		}
	}*/
}

?>