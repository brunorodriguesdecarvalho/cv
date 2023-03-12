<?php

#variáveis para conectar com o servidor local
$servername = "localhost";
$username = "id10834163_bscadmin";
$password = "15315300";
$dbname = "id10834163_bscdb"; 
$id = $_GET['id'];

$conn = mysqli_connect($servername,$username,$password,$dbname);
$conn -> set_charset('utf8');

if (!$conn) {
    die("Deu erro nessa caralha".mysqli_connect_error());
};

$sql_delete = "UPDATE tab_atividades SET status_atividade = 'Não Iniciado' where id_atividade = $id";

if (mysqli_query($conn, $sql_delete)){
    mysqli_close($conn);
        echo "<a href='cadastro_lista_atividades.php'>Sucesso -> Voltar</a>";
        echo '<meta HTTP-EQUIV="Refresh" CONTENT="0; URL=cadastro_lista_atividades.php">';
    exit;
} else {
    echo "Erro: Não foi possível iniciar a atividade";
    echo "<a href='cadastro_lista_atividades.php'>Voltar</a>";
}
?>