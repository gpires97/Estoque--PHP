    <?php
    // Se o login for bem-sucedido, redireciona para a página inicial
    header('Location: public/index.php');
    exit(); // Para garantir que o resto do script não seja executado
    ?>