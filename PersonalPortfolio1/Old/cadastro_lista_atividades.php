<!DOCTYPE html>
<html>
    <head>
        <title>Cadastro e Lista de Atividades</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no">

        <link href="https://fonts.googleapis.com/css?family=Exo+2:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="cores_bruno.css">
        <link rel="stylesheet" href="brunostrap.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <script src='https://kit.fontawesome.com/a076d05399.js'></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <script>
            $(document).ready(function(){
                $("#btn_abre_nova_ativ").click(function(){
                    $("#nova_ativ").fadeIn(1500);
                });
                $("#btn_abre_ativ_ongoing").click(function(){
                    $("#ativ_ongoing").fadeIn(500);
                });
                $("#btn_abre_ativ_concl").click(function(){
                    $("#ativ_concl").fadeIn(2000);
                });
                $("#btn_fecha_nova_ativ").click(function(){
                    $("#nova_ativ").fadeOut(1500);
                });
                $("#btn_fecha_ativ_ongoing").click(function(){
                    $("#ativ_ongoing").fadeOut(500);
                });
                $("#btn_fecha_ativ_concl").click(function(){
                    $("#ativ_concl").fadeOut(2000);
                });
            });
        </script>
    </head>
    <body class="b-cinza-claro">
        <div class="b-table">
        <!-- Menu: Aba -->
            <div class="b-row" style="font-weight:900;">
                <h1 style="color:grey"> Atividades </h1>
                <hr>
                <p id="btn_abre_nova_ativ" class="btn-vermelho" style="font-size: 24px;">
                    <i class="fa fa-edit" style="font-size:30px;color:white"></i>
                    Incluir Nova
                </p>
                <br>
                <p id="btn_abre_ativ_ongoing" class="btn-azul" style="font-size: 24px;">
                    <i class='fa fa-gears' style='font-size:30px;color:white'></i>
                    Em Andamento
                </p>
                <br>
                <p id="btn_abre_ativ_concl" class="btn-verde" style="font-size: 24px;">
                    <i class='fa fa-signing' style='font-size:30px;color:white'></i>
                    Concluídas
                </p>
            </div>
        <!-- Primeiro grupo: Cadastro de Novas Atividades -->
            <div class="b-row b-th oculto" id="nova_ativ">
                <form action="cadastrar_atividade_nova.php" method="POST" style="padding:16px;">
                    <div class="b-card" style="padding:2px;">
                        <h2 style="background-color: rgba(192,0,0,1); border-radius:4px;">
                        <i class="fa fa-edit" style="font-size:30px;color:white"></i>
                        &nbsp;&nbsp; Cadastro de Novas Atividades</h2>
                    </div>
                    <div style="display: flex;">
                        <div class="b-card" display="block">
                            Nome da Atividade:
                            <input type="text" name="ativ_nome" class="input_nome" maxlength="80" required>
                        </div>
                    </div>
                    <br>
                    <div style="display: flex;">
                        <div class="b-card">
                            Prazo:
                            <input type="datetime-local" name="ativ_prazo" style="width:90%">
                        </div>
                    </div>
                    <div class="b-subcard" style="display: block;">
                        <br>
                        <div class="b-card b-label">Descrição da Atividade:</div>
                        <div class="b-card b-ovfl">
                            <input type="text" name="ativ_descr" class="input_desc">
                        </div>
                        <div class="b-card"">
                            <br>
                            <input type="submit" value="Grava" class="btn-vermelho">
                            <input type="reset" value="Nova" class="btn-vermelho">
                            <br>
                            <p id="btn_fecha_nova_ativ" class="btn-vermelho">Fechar</p>
                        </div>
                    </div>
                </form>
            </div>
        <!-- Segundo grupo: bloco PHP - Atividades em Andamento -->
            <div class="b-row oculto" id="ativ_ongoing">
                <div class="b-card">
                    <?php
                        $servername = "localhost";
                        $username = "id10834163_bscadmin";
                        $password = "15315300";
                        $dbname = "id10834163_bscdb";                          

                        // Criar a conexão
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        $conn -> set_charset('utf8');

                        // Testando a conexão
                        if ($conn->connect_error) {die("Deu erro nessa caralha: " . $conn->connect_error);};

                        // Chama os dados do banco
                        $sql = "SELECT *
                                FROM tab_atividades 
                                where status_atividade <>'Concluído'
                                Order by data_concluir ASC"
                                ;
                        $result = $conn->query($sql);                         

                        if ($result->num_rows > 0) {
                            //chama a tabela no HTML
                            echo " 
                                <br>
                                    <h2 style='background-color: #002e72'>
                                    <i class='fa fa-gears' style='font-size:30px;color:white'></i>
                                    &nbsp;&nbsp; 
                                    Atividades Em Andamento
                                </h2>
                                <table class='b-table-php'>
                                    <tr>
                                        <th>Ativ.</th>
                                        <th>Status</th>                                            
                                        <th>Prazo</th>
                                        <th>O que precisa ser feito</th>
                                        <th><th>
                                    </tr>";
                                    // gospe os dados
                                    while($row = $result->fetch_assoc()) {
                                        echo "<tr>
                                                <td class='b-td'>".$row['nome_atividade']."</td>
                                                <td class='b-td font-small'>".$row['status_atividade']."</td>
                                        
                                                <td class='b-td'>".$row['data_concluir']."</td>
                                                <td class='b-td' style='text-align: left;'>".$row['desc_atividade']."</td>
                                                <td class='b-td'>
                                                    <a title='Excluir' href='deletar.php?id=".$row['id_atividade']."'>
                                                        <i class='fas fa-minus-circle' style='font-size:28px;color:red'></i>
                                                    </a><br>
                                                    
                                                        "?> <?php if ($row['status_atividade']=='Não Iniciado') {
                                                            echo "
                                                                <a title='Iniciar' href='iniciar.php?id=".$row['id_atividade']."'>
                                                                    <i class='fas fa-toggle-off' style='font-size:28px;color:grey'></i>
                                                                </a><br>";
                                                        } else {
                                                            echo "
                                                                <a title='Iniciar' href='desiniciar.php?id=".$row['id_atividade']."'>
                                                                    <i class='fas fa-toggle-on' style='font-size:28px;color:green'></i>
                                                                </a><br>";
                                                        } echo "                                            
                                                    </a>
                                                    <a title='Concluir' href='concluir.php?id=".$row['id_atividade']."'>
                                                    <i class='fas fa-check-circle' style='font-size:28px;color:Blue'></i>
                                                    </a>
                                                </td>
                                                
                                            </tr>";
                                    }
                                echo "</table><br><p id='btn_fecha_ativ_ongoing' class='btn-azul'>Fechar</p>";
                        } else {
                            echo "Não encontrou nada";
                        }
                    ?>
                </div>
            </div>
        <!-- Terceiro grupo: bloco PHP - Atividades Concluídas -->
            <div class="b-row oculto" id="ativ_concl">
                <div class="b-card">
                    <?php
                        // Criar a conexão
                        $conn2 = new mysqli($servername, $username, $password, $dbname);
                        $conn2 -> set_charset('utf8');

                        // Chama os dados do banco
                        $sql2 = "SELECT *
                            FROM tab_atividades
                            where status_atividade = 'concluído'
                            Order by data_concluir ASC";
                        $result2 = $conn2->query($sql2);                         
                        if ($result2->num_rows > 0) {
                            //chama a tabela no HTML
                            echo "
                                <br>
                                
                                <h2 style='background-color: rgba(0,163,0,1)'>
                                    <i class='fa fa-signing' style='font-size:30px;color:white'></i>
                                    &nbsp;&nbsp;
                                    Atividades Concluídas
                                </h2>
                                <table class='b-table-php'>
                                    <tr>
                                        <th>Atividade</th>
                                        <th>Status</th>                                   
                                        <th>Prazo</th>
                                    </tr>";
                                    // gospe os dados
                                    while($row = $result2->fetch_assoc()) {
                                        echo "
                                            <tr>
                                                <td class='b-td'>".$row['nome_atividade']."</td>
                                                <td class='b-td'>".$row['status_atividade']."</td>
                                                <td class='b-td'>".$row['data_concluir']."</td>                                                
                                            </tr>";
                                    }
                                echo "</table><br><p id='btn_fecha_ativ_concl' class='btn-verde'>Fechar</p>";
                                } 
                        else {
                            echo "Não encontrou nada";
                        }
                        $conn2->close();
                    ?>
                </div>
            </div>
        </div>                 
    </body>
</html>