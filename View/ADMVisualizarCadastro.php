<?php
include_once '../Controller/UsuarioController.php';
if (!isset($_SESSION)) { session_start(); }
$idusuario = isset($_SESSION['visualizar_idusuario']) ? intval($_SESSION['visualizar_idusuario']) : 0;
$controller = new UsuarioController();
$dados = $controller->buscarDadosCompletos($idusuario);
$user = $dados['usuario'];
$formacoes = $dados['formacoes'];
$experiencias = $dados['experiencias'];
$outras = $dados['outras'];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Visualização do Usuário</title>
    <style>
        body, h1, h2, h3, h4, h5, h6 { font-family: "Montserrat", sans-serif; }
        .user-header { background: #00bfd8; color: #fff; text-align: center; padding: 12px; margin-bottom: 25px; border-radius: 5px; font-size: 1.25em; font-weight: 500; }
        .info-list { margin: 0 auto 18px auto; max-width: 500px; display: flex; flex-direction: column; gap: 18px; }
        .info-item { background: #00bfd8; color: #fff; padding: 12px 22px; border-radius: 5px; font-size: 1.2em; text-align: left; font-weight: 500; box-shadow: 0 2px 8px #00bfd825; }
        .section-title { color: #00bfd8; font-size: 1.21em; text-align: center; margin: 38px 0 18px 0; font-weight: bold; }
        .w3-table-all th { background: #00bfd8 !important; color: #fff !important; }
        .w3-table-all { border-radius: 8px; overflow: hidden; margin-bottom: 24px; }
        .user-block { margin-bottom: 50px; }
        .btn-voltar {
            background: #2196f3;
            color: #fff !important;
            border: none;
            border-radius: 5px;
            padding: 12px 26px;
            font-size: 1.1em;
            cursor: pointer;
            transition: background 0.2s;
            margin-top: 25px;
        }
        .btn-voltar:hover { background: #009cb0; }
        .spaced-section { margin-bottom: 60px; }
    </style>
</head>

<body class="w3-light-grey">
    <div class="w3-padding-large" id="main">
        <header class="w3-container w3-padding-32 w3-center" id="home">
            <?php if ($user) { ?>
                <h1 class="w3-text-white w3-panel w3-cyan w3-round-large">
                    Currículo - <?= htmlspecialchars($user['nome']) ?>
                </h1>
            <?php } else { ?>
                <h1 class="w3-text-white w3-panel w3-cyan w3-round-large">
                    Visualização de Usuário
                </h1>
            <?php } ?>
        </header>
        <div class="w3-content" style="max-width: 900px;">
            <?php if ($user) { ?>
                <div class='user-block'>
                    <div class='info-list'>
                        <div class='info-item'><b>NOME:</b> <?= htmlspecialchars($user['nome']) ?></div>
                        <div class='info-item'><b>CPF:</b> <?= htmlspecialchars($user['cpf']) ?></div>
                        <div class='info-item'><b>EMAIL:</b> <?= htmlspecialchars($user['email']) ?></div>
                        <div class='info-item'><b>DATA DE NASCIMENTO:</b> <?= htmlspecialchars($user['dataNascimento']) ?></div>
                    </div>

                    <!-- Formação Acadêmica -->
                    <div class='spaced-section'>
                        <div class='section-title'>Formação Acadêmica</div>
                        <table class='w3-table-all w3-centered'>
                            <tr><th>Início</th><th>Fim</th><th>Descrição</th></tr>
                            <?php
                            if ($formacoes && count($formacoes) > 0) {
                                foreach ($formacoes as $row) {
                                    echo "<tr>
                                        <td>{$row['inicio']}</td>
                                        <td>{$row['fim']}</td>
                                        <td>{$row['descricao']}</td>
                                    </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='3'>Nenhum registro</td></tr>";
                            }
                            ?>
                        </table>
                    </div>

                    <!-- Experiência Profissional -->
                    <div class='spaced-section'>
                        <div class='section-title'>Experiência Profissional</div>
                        <table class='w3-table-all w3-centered'>
                            <tr><th>Início</th><th>Fim</th><th>Empresa</th><th>Descrição</th></tr>
                            <?php
                            if ($experiencias && count($experiencias) > 0) {
                                foreach ($experiencias as $row) {
                                    echo "<tr>
                                        <td>{$row['inicio']}</td>
                                        <td>{$row['fim']}</td>
                                        <td>{$row['empresa']}</td>
                                        <td>{$row['descricao']}</td>
                                    </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='4'>Nenhum registro</td></tr>";
                            }
                            ?>
                        </table>
                    </div>

                    <!-- Outras Formações -->
                    <div class='spaced-section'>
                        <div class='section-title'>Outras Formações</div>
                        <table class='w3-table-all w3-centered'>
                            <tr><th>Início</th><th>Fim</th><th>Descrição</th></tr>
                            <?php
                            if ($outras && count($outras) > 0) {
                                foreach ($outras as $row) {
                                    echo "<tr>
                                        <td>{$row['inicio']}</td>
                                        <td>{$row['fim']}</td>
                                        <td>{$row['descricao']}</td>
                                    </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='3'>Nenhum registro</td></tr>";
                            }
                            ?>
                        </table>
                    </div>
                </div>
               
                <form action="../Controller/navegacao.php" method="post" style="text-align:center; margin-top:20px;">
                    <button name="btnListarCadastrados" class="btn-voltar"><i class="fa fa-arrow-left"></i> Voltar à Lista</button>
                </form>
            <?php } else { ?>
                <p class='w3-center w3-text-red w3-xlarge'>Usuário não encontrado.</p>
                <form action="../Controller/navegacao.php" method="post" style="text-align:center; margin-top:20px;">
                    <button name="btnListarCadastrados" class="btn-voltar"><i class="fa fa-arrow-left"></i> Voltar à Lista</button>
                </form>
            <?php } ?>
        </div>
    </div>
    <br><br><br>
</body>
</html>