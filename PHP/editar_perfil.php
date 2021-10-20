<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Green Gate | Editar Perfil</title>
        <link rel="stylesheet" href="../CSS/style-index.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-painel-adm.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-painel-produtor.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-editar-perfil.css">
        <link rel="stylesheet" href="../FONTAW/css/all.css">
        <link rel="shortcut icon" href="../IMG/icone.ico" type="image/x-icon">
    </head>
    <body class="corpo-painel-produtor">

    <?php
        include('conexao.php');

        session_start();
        if(!isset($_SESSION['entrar'])){

        $id = $_SESSION['id_usuario'];
        $sql_usuario = 'select * from usuario where id_usuario = '.$id.';';
        $resul_usuario = mysqli_query($conectar, $sql_usuario);
        $dados_usuario = mysqli_fetch_array($resul_usuario);

    ?>

    <!-- Cabeçalho -->

        <section class="main-nav-produtor">
            <nav>
                <div class="logo">
                    <figure>
                        <a href="index.php"><img src="../IMG/logotipo.png" alt="Logotipo"></a>
                    </figure>
                </div>

                <div class="figuras-produtor">
                    <a href="pagina_usuario_produtor.php"><i class="fas fa-user-circle"></i>
                        <div class="usuario">
                            <?php echo $dados_usuario['nome']; ?>        
                        </div>
                    </a>
                    <a href="notificacoes_produtor.php"><i class="far fa-bell"></i></a>
                </div>
            </nav>
        </section>
    </header>

    <!-- Menu para Administrar -->

    <main>
    <aside class="main-aside-produtor">
        <nav>
            <ul class="icon-aside">
                <strong>Categorias</strong>
                <a href="editar_perfil_produtor.php"><li><i class="fas fa-user-edit"></i>
                    Perfil
                </li></a>
                <a href="alterar_senha.php"><li><i class="fas fa-user-lock"></i>
                    Segurança
                </li></a>
                <a href="deletar_produtor.php"><li><i class="fas fa-user-times"></i>
                    Deletar
                </li></a>
                <a href="invalido.php"><li><i class="fas fa-sign-out-alt"></i>
                    Sair
                </li></a>         
            </ul>
        </nav>
    </aside>

    <!-- Conteúdo -->

        <section class="main editar-perfil">

            <form action="#" method="POST">

                <table class="fundo-editar-perfil">

                <tr>
                    <td>Nome:</td>
                    <td><input type="text" name="nome" value="<?php echo $dados_usuario['nome']; ?>"></td>
                </tr>

                <tr>
                    <td>E-mail:</td> 
                    <td><input type="text" name="email" value="<?php echo $dados_usuario['email']; ?>"></td>
                </tr>
                
                <tr>
                    <td>Telefone:</td>
                    <td><input type="text" name="telefone" value="<?php echo $dados_usuario['celular'] ?>"></td>
                </tr>

                <tr>
                    <td>Data de Nascimento:</td> 
                    <td><input type="date" name="data_nascimento" value="<?php echo $dados_usuario['data_nascimento']; ?>"></td>
                </tr>

                <tr>
                    <td>Gênero:</td> 
                    <td><select name="genero">
                        <option value="<?php echo $dados_usuario['genero']; ?>">
                            <?php if($dados_usuario['genero'] == 'M'){ echo ("Masculino"); }else { echo("Feminino");} ?>
                        </option>
                        <option value="F">Feminino</option>
                        <option value="M">Masculino</option>
                    </select></td>
                </tr>

                <tr>
                    <td>CPF:</td>
                    <td><input type="text" name="cpf" value="<?php echo $dados_usuario['cpf']; ?>"></td>
                </tr>

                <tr>
                    <td class="botao" colspan="2" align="center"><input type="submit" name="salvar" value="Salvar"></td>
                </tr>

                </table>

            </form>

        </section>

    <?php

    if(isset($_POST['salvar'])){
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $data_nascimento = $_POST['data_nascimento'];
        $genero = $_POST['genero'];
        $cpf = $_POST['cpf'];

        $sql_update = 'update usuario set nome="'.$nome.'", email="'.$email.'", celular="'.$telefone.'", data_nascimento="'.$data_nascimento.'", genero="'.$genero.'", cpf="'.$cpf.'" where usuario.id_usuario='.$id.';';
        $update = mysqli_query($conectar,$sql_update);

        if($update){
            echo ('<script>window.alert("Mudança feita com sucesso!");window.location="editar_perfil_produtor.php"</script>');
        }else{
            echo ('<script>window.alert("Erro ao salvar!");window.location="editar_perfil_produtor.php"</script>');
        }

    }

    ?>    

    <!-- Rodapé -->

    <footer class="main-footer">
        <section class="cont-footer">
            <div>
                <p>Para quem se compromete com o meio ambiente.</p>
            </div>
        </section>

        <div id="linha-vert"></div>

        <div class="footer-icon">
            <a href="https://www.facebook.com/Green-Gate-103711395206238"><i class="fab fa-facebook"></i></a>
            <a href="https://www.instagram.com/green.gate_/"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fas fa-envelope"></i></a>
        </div>

        <div class="direitos">
            <p>© Green Gate 2021</p>
        </div>
    </footer>  

    <?php

    }else{
        unset($_SESSION['entrar']);
        header('location:invalido.php');
    }

    ?>

    </body>
</html>