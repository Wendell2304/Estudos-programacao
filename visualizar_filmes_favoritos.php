<?php
session_start();

// Verifique se o usuário está logado
if (!isset($_SESSION["usuario"])) {
    header("location: login.php"); // Redirecione para a página de login se o usuário não estiver logado
    exit();
}

// Obtém informações do usuário a partir da sessão
$nomeUsuario = $_SESSION["usuario"];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Meus Filmes Favoritos</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="profile-container">
        <h2>Meus Filmes Favoritos</h2>
        <p><strong>Nome de Usuário:</strong> <?php echo $nomeUsuario; ?></p>
        
        <h3>Filmes Favoritos:</h3>
        <ul id="filmesFavoritosList">
            <!-- Aqui serão exibidos os filmes favoritos -->
        </ul>

        <a href="perfil.php">Voltar para o Perfil</a>
    </div>

    <script>
        // Função para atualizar a interface do usuário com base nos favoritos
        function updateUI() {
            var favorites = JSON.parse(localStorage.getItem('favorites')) || [];
            var filmesFavoritosList = document.getElementById('filmesFavoritosList');

            // Limpe a lista atual de filmes favoritos
            filmesFavoritosList.innerHTML = '';

            // Verifique se há filmes favoritos
            if (favorites.length === 0) {
                var noFavoritesItem = document.createElement('li');
                noFavoritesItem.textContent = 'Nenhum filme favorito encontrado.';
                filmesFavoritosList.appendChild(noFavoritesItem);
            } else {
                // Adicione cada filme favorito à lista
                favorites.forEach(function (movieId) {
                    var filmeItem = document.createElement('li');
                    filmeItem.textContent = movieId; // Aqui você pode substituir pelo título do filme
                    filmesFavoritosList.appendChild(filmeItem);
                });
            }
        }

        // Chame a função de atualização da interface do usuário imediatamente após carregar a página
        updateUI();
    </script>
</body>
</html>
