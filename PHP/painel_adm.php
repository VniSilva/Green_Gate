<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Green Gate | Página Produtor</title>
        <link rel="stylesheet" type="text/css" href="../CSS/style-index.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-painel-adm.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-painel-produtor.css">
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

        if($dados_usuario['usuario'] == 0){

        $limite = 4;

        if(!isset($_GET['pag'])){
            $pagina = 1;
        }else{
            $pagina = $_GET['pag'];
        }

        $inicio = ($pagina * $limite) - $limite;

        $sql_empresa = 'select * from empresa order by nome_empresa ASC limit '.$inicio.','.$limite.' ;';
        $resul_empresa = mysqli_query($conectar, $sql_empresa);

        $sql_total = 'select * from empresa;';
        $resul_total = mysqli_query($conectar, $sql_total);
        $total_registros = mysqli_num_rows($resul_total);

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
                    <a href="pagina_usuario_adm.php"><i class="fas fa-user-circle"></i>
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
                <a href="painel_adm.php"><li><i class="fas fa-store-alt"></i>
                    Lojas
                </li></a>
                <a href="painel_adm_aprovacoes.php"><li><i class="far fa-check-square"></i> 
                    Aprovações
                </li></a>   
                <a href="painel_adm_avaliacoes.php"><li><i class="fas fa-tasks"></i>
                    Avaliações
                </li></a>
                <a href="invalido.php"><li><i class="fas fa-sign-out-alt"></i>
                    Sair
                </li></a>       
            </ul>
        </nav>
    </aside>

    <!-- Conteúdo -->

        <section class="main lojas">
            <h1>Lojas</h1>

            <div class="paginacao-lojas">

                <?php
                    while($dados_empresa = mysqli_fetch_array($resul_empresa)){
                ?>

                <article class="espacamento">

                <?php
                    echo ('<img src="../IMG/Imagem_Empresa/Logo_Empresa/'.$dados_empresa['logo'].'"alt=Logo">');
                ?> 

                </article>  

                <?php
                    }
                ?>

            </div>

            <p class="paginacao">

                <?php

                    $total_paginas = ($total_registros + 3) / $limite;


                    $anterior = $pagina - 1;
                    $proximo = $pagina + 1;

                    if($pagina>1){
                        echo ('<a class="espacamento-antes" href="painel_adm.php?pag='.$anterior.'"><</a>');
                    }


                    for($cont=1;$cont<=$total_paginas;$cont++){
                        echo('<a class="espacamento-paginas" href="painel_adm.php?pag='.$cont.'">'.$cont.'</a>');
                    }

                    if($pagina<$total_paginas){
                        echo ('<a class="espacamento-depois" href="painel_adm.php?pag='.$proximo.'">></a>');
                    }

                ?>

            </p>

        </section>  
        
    </main>

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
        header('location:invalido.php');
    }

    }else{
        unset($_SESSION['entrar']);
        header('location:invalido.php');
    }

    ?>

    </body>
</html>