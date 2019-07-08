<?php
ob_start();
session_start();
include 'nomes.class.php';
$dados = new Dados();
?>
<html lang= "pt-br">
    <head>
        <meta charset= "utf-8"/>
        <title>Ez Hospital</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../assets/css/style.css" />
        <script type="text/javascript" src="../lib/jquery.min.js"></script>
        <script type="text/javascript" src="../lib/bootstrap.min.js"></script>
        <script src="https://kit.fontawesome.com/23cdc4ac50.js"></script>
    </head>
    <body>
         <div class="">
            <h1>Contatos</h1>
            <a href="adicionar.php">[ ADICIONAR ]</a><br/><br/>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Código</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                  
                <?php
                $lista = $dados->getAll();
                foreach($lista as $item):
                ?>
                    <tbody>
                        <tr>
                            <td><?php echo $item['idpais']; ?></td>
                            <td><?php echo $item['codpais']; ?></td>
                            <td><?php echo $item['nomepais']; ?></td>
                            <td>
                                <a href="editar.php?idpais=<?php echo $item['idpais']; ?>">[ EDITAR ]</a>
                                <a href="excluir.php?idpais=<?php echo $item['idpais']; ?>">[ EXCLUIR ]</a>
                            </td>
                        </tr>
                    </tbody>
            </table>
            <?php endforeach; ?>
        </div>
    </body>
</html>