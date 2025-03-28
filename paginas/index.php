<html>

<head>
    <title> Home | ESTante </title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<body>
    <?php
    $pagina = 'index';
    include '../paginas/nav.php' ?>

    <div class="container text-center">
        <div class="row align-items-start" style="min-height: 80vh;">
            <div class="col" >
                <div style="min-height: 80vh;" class="col d-flex align-items-center justify-content-center">
                    <div>
                        <h1>O melhor lugar para partilhar conhecimento!</h1>
                        <div style="height: 8px; background-color: #000000; border-radius: 5px; width: 100%; margin: 20px 0;"></div>
                        
                        <p>Encontra, partilha e colabora com os melhores apontamentos para o teu sucesso académico na EST. Acede a resumos, fichas e materiais de estudo feitos por estudantes para estudantes como tu. </p>
                        <p>Simplifica a tua aprendiza e melhora as tuas notas com a nossa comunidade! 🚀📚!</p>
                        <button class="btn btn-dark" type="submit">Registar</button>
                    </div>
                </div>
            </div>

            <div class="col">
                <img src="../img/welcome.png">
                <img src="../img/imagemWelcome.png" style="height: auto; width:50%; right: 0px; bottom: 0px; position: absolute;" />
            </div>

        </div>
    </div>
</body>

</html>