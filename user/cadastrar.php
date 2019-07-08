<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once '../config/usuarios.php';
$u = new Usuario;

//Declaro os nomes das variaveis de cookies
$cookie_nome = "nome";
$cookie_telefone = "telefone";
$cookie_email = "email";
$cookie_senha = "senha";
$cookie_confirmarSenha = "confirmarSenha";
?>

<html lang="pt-br">
	<head>
		<meta charset= "utf-8"/>
		<title>Cadastro Ez Hospital</title>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../assets/css/style.css" />
		</head>
	<body>
		<div id="corpo-form-cad">
			<div class="container text-center" id="corpo-form">
				<div class="form">
					<h1 class="display-4">Cadastro</h1>
					<div class="row justify-content-center align-items-center">
	    			<div class="col col-sm-6 col-md-6 col-lg-4 col-xl-3">
							<form method="POST">
								<div class="form-group">
									<input type="text" name="nome" placeholder="Nome Completo" class="form-control" maxlength="32" value="<?php echo $_COOKIE[$cookie_nome] ?>">
								</div>
								<div class="form-group">
									<input type="text" name="telefone" placeholder="Telefone" class="form-control" maxlength="30" value="<?php echo $_COOKIE[$cookie_telefone] ?>">
								</div>
								<div class="form-group">
									<input type="email" name="email" placeholder="E-mail" class="form-control" maxlength="30" value="<?php echo $_COOKIE[$cookie_email] ?>">
								</div>
								<div class="form-group">
									<input type="password" name="senha" placeholder="Senha" class="form-control" maxlength="15" value="<?php echo $_COOKIE[$cookie_senha] ?>">
								</div>
								<div class="form-group">
									<input type="password" name="confSenha" placeholder="Confirmar Senha" class="form-control" maxlength="15" value="<?php echo $_COOKIE[$cookie_confirmarSenha] ?>">
								</div>
								<input type="submit" value="Cadastrar" class="btn btn-primary btn-lg btn-block" />
								<div class="link">
									<a href="login.php"><i>Acesse sua conta</i></a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php
		//verificar se a pessoa clicou no botão
		if (isset($_POST['nome']))
		{
			 $nome = addslashes($_POST['nome']);
			 $telefone = addslashes($_POST['telefone']);
			 $email = addslashes($_POST['email']);
			 $senha = addslashes($_POST['senha']);
			 $confirmarSenha = addslashes($_POST['confSenha']);

			 // SETCOOKIES
			 (!empty($nome) ? setcookie($cookie_nome, $nome, time() + (86400 * 30), "/") : false);
			 (!empty($telefone) ? setcookie($cookie_telefone, $telefone, time() + (86400 * 30), "/") : false);
			 (!empty($email) ? setcookie($cookie_email, $email, time() + (86400 * 30), "/") : false);
			 (!empty($senha) ? setcookie($cookie_senha, $senha, time() + (86400 * 30), "/") : false);
			 (!empty($confirmarSenha) ? setcookie($cookie_confirmarSenha, $confirmarSenha, time() + (86400 * 30), "/") : false);

			 //verificar se esta preenchido
			 if (!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confirmarSenha))
			 {
				
				$u->conectar("ezhosp","localhost","root","");

			 	if ($u->msgErro == "")//se esta tudo ok
			 	{
			 		if($senha == $confirmarSenha)
			 		{
			       if ($u->cadastrar($nome, $telefone, $email,$senha))
			       { 
			       	// Limpa os cookies se tudo estiver certo.
							setcookie($cookie_nome, "", time()-3600);
							setcookie($cookie_telefone, "", time()-3600);
							setcookie($cookie_email, "", time()-3600);
							setcookie($cookie_senha, "", time()-3600);
							setcookie($cookie_confirmarSenha, "", time()-3600);

			       	?>
			     	<div class="alert alert-success' role=alert" style="text-align:center;">
			     	   Cadastrado com sucesso! Acesse sua conta!! 
			         </div>
			     	 	<?php
			       }
			       else
			       {
							?>
							<div class="alert alert-danger role=alert" style="text-align:center;">
								Email já cadastrado!
							</div>
							<?php
			       }
		      } else { ?>
			 			<div class="alert alert-danger role=alert" style="text-align:center";>
			 			     Senha e confirmar senha não correspondem!
			 			</div>
			 		<?php	
			 		}
			 	} else  { ?>
			 		<div class="alert alert-danger' role=alert" style="text-align:center;">
			 		    <?php echo "Erro: ".$u->msgErro;?>
			 	    </div>
			 	<?php    
			 	}
			 } else { 
			 	?>
			 	<div class="alert alert-danger' role=alert" style="text-align:center;>
			 	     Preencha todos os campos! 
			    </div>
			 <?php
			 }
			}
		?>

		<script type="text/javascript" src="../lib/jquery.min.js"></script>
		<script type="text/javascript" src="../lib/bootstrap.min.js"></script>
		<script type="text/javascript" src="../lib/bootstrap.bundle.min.js"></script>
		<script src="https://kit.fontawesome.com/23cdc4ac50.js"></script>
	</body>
</html>