<?php
session_start();

// Verifique se o usuário está logado
if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit();
}

// Obtém informações do usuário a partir da sessão
$nomeUsuario = $_SESSION["usuario"];
$emailUsuario = $_SESSION["email"];
$avatarUsuario = isset($_SESSION["avatar"]) ? $_SESSION["avatar"] : "avatars/default-avatar.jpg";

// Lista de avatares disponíveis
$avatarOptions = [
    "Avatar 1" => "avatars/Netflix-avatar-1.png",
    "Avatar 2" => "avatars/Netflix-avatar-2.png",
    "Avatar 3" => "avatars/Netflix-avatar-3.png",
    "Avatar 4" => "avatars/Netflix-avatar-4.png",
    "Avatar 5" => "avatars/Netflix-avatar-5.png",
    "Avatar 6" => "avatars/Netflix-avatar-6.png",
    "Avatar 7" => "avatars/Netflix-avatar-7.png",
    "Avatar 8" => "avatars/Netflix-avatar-8.png",
    "Avatar 9" => "avatars/Netflix-avatar-9.png",
    "Avatar 10" => "avatars/Netflix-avatar-10.png",
    "Avatar 11" => "avatars/Netflix-avatar-11.png",
    "Avatar 12" => "avatars/Netflix-avatar-12.png",
    "Avatar 13" => "avatars/Netflix-avatar-13.png",
    "Avatar 14" => "avatars/Netflix-avatar-14.png",
    "Avatar 15" => "avatars/Netflix-avatar-15.png",
];

// Função para atualizar o avatar do usuário
function atualizarAvatar($avatarSelecionado) {
    $_SESSION["avatar"] = $avatarSelecionado;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Verifica se o usuário deseja atualizar o avatar
    if (isset($_POST["avatar"])) {
        $avatarSelecionado = $_POST["avatar"];
        atualizarAvatar($avatarSelecionado);
        $avatarUsuario = $avatarSelecionado; // Atualiza o avatar exibido na página
    }

    // Verifica se o usuário deseja atualizar o nome de usuário
    if (isset($_POST["nomeUsuario"])) {
        $novoNomeUsuario = $_POST["nomeUsuario"];
        $_SESSION["usuario"] = $novoNomeUsuario;
        $nomeUsuario = $novoNomeUsuario;
    }

    // Verifica se o usuário deseja atualizar o email
    if (isset($_POST["emailUsuario"])) {
        $novoEmailUsuario = $_POST["emailUsuario"];
        $_SESSION["email"] = $novoEmailUsuario;
        $emailUsuario = $novoEmailUsuario;
    }
}
?>
<!-- Aqui começa o HTML -->
<a href="visualizar_filmes_favoritos.php" class="no-underline">Meus Filmes Favoritos</a>
<!-- Aqui começa o código HTML -->
<!DOCTYPE html>
<html>
<head>
    <title>Seu Perfil</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="profile-container">
        <h2>Seu Perfil</h2>
        <img src="<?php echo $avatarUsuario; ?>" alt="Avatar do Usuário" width="100" height="100">
        
        <div>
            <p><strong>Nome de Usuário:</strong> <?php echo $nomeUsuario; ?></p>
            <p><strong>Email:</strong> <?php echo $emailUsuario; ?></p>
        </div>

        <button id="editarPerfil">Editar Perfil</button>
        <a href="sairPerfil.php" id="sairPerfil">Voltar à Pagina Inicial</a>

        <form method="post" id="formularioEdicao" style="display: none;">
            <label for="nomeUsuario">Nome de Usuário:</label>
            <input type="text" name="nomeUsuario" id="nomeUsuario" value="<?php echo $nomeUsuario; ?>"><br>

            <label for="emailUsuario">Email:</label>
            <input type="email" name="emailUsuario" value="<?php echo $emailUsuario; ?>"><br>

            <label for="avatar">Escolha um avatar:</label>
            <select name="avatar" id="avatar">
                <?php foreach ($avatarOptions as $avatarName => $avatarPath) { ?>
                    <option value="<?php echo $avatarPath; ?>" <?php echo ($avatarUsuario === $avatarPath) ? "selected" : ""; ?>><?php echo $avatarName; ?></option>
                <?php } ?>
            </select><br>

            <input type="submit" name="editarPerfil" value="Salvar Alterações">
        </form>
    </div>

    <script>
        document.getElementById("editarPerfil").addEventListener("click", function() {
            // Ocultar o botão de editar perfil e o conteúdo
            document.getElementById("editarPerfil").style.display = "none";
            document.querySelector(".profile-container div").style.display = "none";

            // Mostrar o formulário de edição
            document.getElementById("formularioEdicao").style.display = "block";
        });
    </script>
</body>
</html>

