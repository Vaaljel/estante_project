<html>

<head>
    <title> Aprovação de Registos | ESTante </title>
</head>

<body>
    <?php

    include './nav.php';
    include '../basedados/basedados.h';
   

    if (isset($_GET['aprovar'])){
       
        $sql = "UPDATE `utilizadores` SET `estado` = 'registado' WHERE `utilizadores`.`id_utilizador` = " . $_GET['aprovar'];

        $result = $conn->query($sql); 
         
    
    }

    if (isset($_GET['rejeitar'])){
       
        $sql = "UPDATE `utilizadores` SET `estado` = 'negado' WHERE `utilizadores`.`id_utilizador` = " . $_GET['rejeitar'];

        $result = $conn->query($sql); 
        
    
    }
    ?>

    <div class="container text-center">
        <h2>Aprovação de Registos</h2>
        <ul class="list-group">
            <form method="get">

                <?php
                $sql = "SELECT * FROM `utilizadores` WHERE estado='pendente'";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo ' <li class="list-group-item d-flex justify-content-between align-items-center">'
                            . $row["nome"] . ' - ' . $row["endereco"] . '
                        
                                <button type="submit" value="'.$row["id_utilizador"].'" name="aprovar" class="btn btn-outline-success">Aprovar</button>
                                <button type="submit" value="'.$row["id_utilizador"].'"  name="rejeitar" class="btn btn-outline-danger">Rejeitar</button>
                            </li>';
                    }
                } else {
                    echo "0 results";
                }


                ?>

            </form>

        </ul>

    </div>
</body>

</html>