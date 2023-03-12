<?php

#variáveis para conectar com o servidor local
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
};

#Variáveis do cadastro (via método post)
$ativ_nome = $_POST['ativ_nome'];
$ativ_descr = $_POST['ativ_descr'];
$ativ_prazo = $_POST['ativ_prazo'];

$sql = "INSERT INTO tab_atividades(nome_atividade, desc_atividade, data_concluir, status_atividade) 
VALUES ('$ativ_nome', '$ativ_descr', '$ativ_prazo' , 'Não Iniciado')";
    
    if (mysqli_query($conn, $sql)) {
        echo "Novo registro criado com sucesso";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);
    echo "<a href='cadastro_lista_atividades.php'>Voltar</a>";
    echo '<meta HTTP-EQUIV="Refresh" CONTENT="0; URL=cadastro_lista_atividades.php">';
?>