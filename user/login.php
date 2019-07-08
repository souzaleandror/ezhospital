<?php 
ob_start();
require '../config/usuarios.php';
$u = new Usuario;
?>
<html lang= "pt-br">
	<head>
		<meta charset= "utf-8"/>
		<title>Ez Hospital</title>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../assets/css/style.css" />
	</head>
	<body>
		<div class="voltar">
			<a href="../index.php"><i class="fas fa-chevron-left fa-2x"></i></a>
		</div>
		<div class="container text-center" id="corpo-form">
			<div class="form">
				<h1 class="display-4">Login</h1>
				<div class="row justify-content-center align-items-center">
	    		<div class="col col-sm-6 col-md-6 col-lg-4 col-xl-3">
						<form method="POST" class="">
							<div class="form-group">
								<input type="text"placeholder="E-mail"  name="email" class="form-control">
							</div>
							<div class="form-group">
								<input type="password" placeholder="Senha" name="senha" class="form-control">
							</div>
							<input href="../table/acesso.php" type="submit" value="Acessar" class="btn btn-primary btn-lg btn-block" />
							<div class="link">
								<a href="esqueci.php"><strong><i> Esqueceu sua senha?</i></strong></a>
							</div>
						</form>
					</div>
				</div>
			</di>
		</div>
		<script type="text/javascript" src="../lib/jquery.min.js"></script>
		<script type="text/javascript" src="../lib/bootstrap.min.js"></script>
		<script type="text/javascript" src="../lib/bootstrap.bundle.min.js"></script>
		<script src="https://kit.fontawesome.com/23cdc4ac50.js"></script>
	</body>
</html>	

<?php

if (isset($_POST['email']))
{
	    $email = addslashes($_POST['email']);
	    $senha = addslashes($_POST['senha']);

	 if (!empty($email) && !empty($senha))
	   {
	   	   $u->conectar("ezhosp","localhost","root","");
	       if (empty($u->msgErro))
	   	   {
	 	     if($u->logar($email,$senha))
	 	        {
                   header("location: ../table/acesso.php");
                }
	 	       else
	 	        {
					echo "<div class='alert alert-danger' role='alert'>Email e\ou senha incorretos!</div>"; 
	 	        }
	 	    }
	 	    else
	 	    {
				echo "<div class='alert alert-danger' role=alert'>Preencha todos os campos!</div>";
				$u->msgErro("teste");
				echo $u->msgErro;
            }

	 	}else
	    {
	 	echo "Erro:".$u->msgErro;
	    }
}

?>
