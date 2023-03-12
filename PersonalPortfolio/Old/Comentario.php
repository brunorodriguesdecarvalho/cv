<!DOCTYPE html>
<html>
    <head>
        <title>Fale com o Bruno</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="style-comm.css" >
        <link href="https://fonts.googleapis.com/css?family=Exo+2:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    </head>
    <body>
        <?php
            # Informa qual o conjunto de caracteres será usado.
            //header('Content-Type: text/html; charset=utf-8');

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
            ;
            // Chama os dados do banco
            $sql = "SELECT id_comentario, nome_comentario, texto_comentario, data_comentario FROM tab_comentarios";
            $result = $conn->query($sql);
        ?>
        <div class="BSC_HEAD">
            <h3>
                <a href="index.html">
                    <i class="fas fa-home"></i>
                    &nbsp;BSC:HUB
                </a>
            </h3>
        </div>
        <br>
        <br>
        <form action="registrar_comentario.php" method="POST" name="form">
            <div>
                <div>
                    <h1><i class="fas fa-comment-dots"></i>&nbsp;&nbsp;Escreva seu comentário</h1>
                </div>
                <div>
                    Nome:
                </div>
                <div>
                    <input type="text" name="autor_comentario" required>
                </div>
                <div>
                    Comentário:
                </div>
                <div> 
                    <input type="text" name="comentario_texto" required>
                </div>
                <div class='form_div'>
                    <a href="javascript:form.submit()" class="btn">Enviar</a>
                    <a href="javascript:form.reset()" class="btn">Limpar</a>
                </div>
            </div>
        </form>

            <div>
                <h1>
                    <i class="fas fa-envelope-open-text"></i>
                    &nbsp;&nbsp;Comentários
                </h1>
                <div>
                    <?php
                    if ($result->num_rows > 0) {
                        //chama a tabela no HTML
                            echo "
                                <table>
                                    <tr>
                                        <th>Autor</th>
                                        <th>Data do Comentário</th>
                                        <th>Comentário</th>
                                    </tr>";
                        
                            // gospe os dados
                            while($row = $result->fetch_assoc()) {
                                echo "
                                    <tr>
                                        <td>".$row["nome_comentario"]."</td>
                                        <td>".$row["data_comentario"]."</td>
                                        <td>".$row["texto_comentario"]."</td>
                                    </tr>";
                            }
                        echo "</table>";
                    } else {
                        echo "Não há comentários para exibir";
                    }
                    $conn->close();
                    ?>
                </div>
            </div>
    </body>
</html>