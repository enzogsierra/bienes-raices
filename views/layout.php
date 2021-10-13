<?php
    $admin = $_SESSION["admin"] ?? false;
    if(!isset($inicio)) $inicio = false;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bienes Raíces</title>

        <link rel="stylesheet" href="../build/css/app.css">
    </head>

    <body>
        <header class="header <?php echo $inicio ? "index" : ""; ?>">
            <div class="contenedor header-contenido">
                <div class="header-nav">
                    <a href="/">
                        <img src="/build/img/logo.svg" alt="logotipo de Bienes Raíces">
                    </a>

                    <div class="mobile-menu">
                        <img src="/build/img/barras.svg" alt="icono menu responsive">
                    </div>

                    <div class="derecha">
                        <img src="/build/img/dark-mode.svg" class="dark-mode-btn" title="Modo oscuro">
                        <nav class="navegacion">
                            <a href="/nosotros">Nosotros</a>
                            <a href="/anuncios">Anuncios</a>
                            <a href="/blog">Blog</a>
                            <a href="/contacto">Contacto</a>

                            <?php if($admin === true): ?>
                                <a href="/admin">Administrar propiedades</a>
                                <a href="/logout">Cerrar sesión</a>
                            <?php endif; ?>
                        </nav>
                    </div>
                </div>

                <?php if($inicio): ?> 
                    <h1 data-cy="index-heading">Venta de casas y departamentos exclusivos de lujo</h1>
                <?php endif; ?>
            </div>
        </header>

        <?php echo $contenido; ?>

        <footer class="footer">
            <nav class="navegacion">
                <a href="/nosotros">Nosotros</a>
                <a href="/anuncios">Anuncios</a>
                <a href="/blog">Blog</a>
                <a href="/contacto">Contacto</a>
            </nav>

            <p class="copyright">Todos los derechos reservados - <?php echo date("Y"); ?> &copy;</p>
        </footer>

        <script src="../build/js/bundle.min.js"></script>
    </body>
</html>