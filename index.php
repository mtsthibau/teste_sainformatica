<!DOCTYPE html>
<html lang=”pt-br”>

<head>
    <meta charset=”utf-8”>
    <meta http-equiv="Content-Language" content="pt-br">
    <link rel="stylesheet" href="frontend/css/style.css">
</head>

<body onload="onLoadPage()">
    <panel class="panel">
        <panel-header class="header">
            <div class="title">Formulário de teste</div>
            <div class="container">
                <div class="box">
                    <div id="conteudo">
                        <?php
                            require "server/UI_Comp_Formulario.php";
                            $comp = new UI_Comp_Formulario(true);
                            $comp->renderer(array("Data" => "10-10-2020", "Texto" => "teste", "Texto Grande" => "TESTE"));
                        ?>
                    </div>
                </div>
            </div>
        </panel-header>
        <div class="footer">
            Teste de Formulário
        </div>
    </panel>

    <script src="frontend/javascript/index.js"></script>
</body>

</html>