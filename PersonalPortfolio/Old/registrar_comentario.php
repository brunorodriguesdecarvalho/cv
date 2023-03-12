<?php
    # Informa qual o conjunto de caracteres será usado.
    header('Content-Type: text/html; charset=utf-8');

    $autor_comentario = $_POST['autor_comentario'];
    $texto_comentario = $_POST['comentario_texto'];

    $servername = "localhost";
    $username = "id10834163_bscadmin";
    $password = "15315300";
    $dbname = "id10834163_bscdb";

    // Criar a conexão
    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn -> set_charset('utf8');

    // Testando a conexão
    if ($conn->connect_error) {
        die("Deu erro nessa caralha: " . $conn->connect_error);
    }
    echo "<br> Conexão funcionando.... lindo <br>";

    // Grava os dados

    $agora = new DateTime();
    $data_com = $agora->format('Y-m-d');

    $sql = "INSERT INTO tab_comentarios(data_comentario, nome_comentario, texto_comentario) VALUES ('$data_com', '$autor_comentario', '$texto_comentario')";
    
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
        echo '<meta HTTP-EQUIV="Refresh" CONTENT="0; URL=Comentario.php">';
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);
    //header('Location: /Comentario.php');
?>