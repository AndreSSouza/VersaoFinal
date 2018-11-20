<?php require "topo.php";
$id_professor = $_SESSION['cod_professor'];
?>﻿
﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Chamada</title>        
        <link rel="stylesheet" type="text/css" href="css/estilo.css" />
    </head>
    <body>
        <div id="box_curso">
            
            <?php
            //alterar o status da presença de um aluno caso tenha colocado errado
            if ((@$_GET['turma']) && (@$_GET['aluno'])) {
                $id_aluno_get = $_GET['aluno'];
                $data_get = $_GET['data_chamada'];
                $status_post = $_GET['status'];
                $cod_turma_get = $_GET['turma'];

                $trocaStatus = $status_post == '1' ? '0' : '1';

                $update_chamada = $crud->update('chamada', 'presenca = :presenca', 'WHERE id_turma = :id_tur AND id_professor = :id_prof AND data_chamada = :dt AND id_aluno = :id_alu')->run([':presenca' => $trocaStatus, ':id_tur' => $cod_turma_get, ':id_prof' => $id_professor, ':dt' => $data_get, ':id_alu' => $id_aluno_get]);

                if (!$update_chamada) {
                    echo "<script language='javascript'>window.alert('Ocorreu um Erro!'); window.location='chamada.php?turma=$cod_turma_get&professor=$id_professor&buscar=Buscar';</script>";
                } else {
                    echo "<script language='javascript'>window.alert('Alterado com sucesso!'); window.location='chamada.php?turma=$cod_turma_get&professor=$id_professor&buscar=Buscar';</script>";
                }
            }
            //se o botão buscar não for clicado faça
            if (!isset($_GET['buscar'])) { ?>

                <h1><center>Chamada: Selecione a Turma e dê "Buscar"</center></h1>
                <br/>
                <form method="GET">		
                    <table>
                        <tr>
                            <td>Selecione a Turma :</td>
                            <td>
                                <select name="turma" title="Selecione a turma" style="width:60px">
                                    <?php
                                    $select_turma = $crud->select('id_turma, nome_turma', 'turma', 'WHERE nome_turma IS NOT NULL ORDER BY nome_turma ASC')->run();
                                    while ($valores_turma = $select_turma->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                        <option value="<?php echo $valores_turma['id_turma']; ?>">
                                            <?php echo $valores_turma['nome_turma']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>Professor:</td>
                            <td>
                                <?php $select_nome_professor = $crud->select('nome_professor', 'professor', 'WHERE id_professor = ?')->run([$id_professor]);
                                $valores_professor = $select_nome_professor->fetch(PDO::FETCH_ASSOC);?> 
                                <input type="text" name="professor" value="<?php echo $valores_professor['nome_professor']; ?>" disabled />
                            </td>
                            <td>Data de Hoje:</td>
                            <td>
                                <input type="text" name="data_atual" value="<?php
                                date_default_timezone_set("America/Sao_Paulo");
                                echo date('d/m/Y');
                                ?>" style="width:80px" disabled>
                            </td>
                            <td>						
                                <input type="submit" name="buscar" value="Buscar" class="input" id="button" title="Buscar" />
                            </td>
                        </tr>
                    </table>
                </form>
                <br/>
                
            <?php
            //se for clicado faça
            } else {

                $cod_turma = $_GET['turma'];

                $select_ver_chamada = $crud->select('*', 'chamada', 'WHERE id_turma = ? AND data_chamada = CURRENT_DATE')->run([$cod_turma]);

                if ($select_ver_chamada->rowCount() > 0) { ?>

                    <h1>Chamada na data de hoje</h1>                    
                    <table width='900'>
                        <thead>
                            <th>Nome</th>
                            <th>Data da Chamada</th>
                            <th>Status</th>					
                            <th>Modificar</th>							
                        </thead>
                        <?php $select_chamada = $crud->select('c.id_aluno aluno, c.data_chamada data_chamada, c.presenca status, i.nome_aluno nome', 'chamada c', 'INNER JOIN professor p ON p.id_professor = c.id_professor INNER JOIN turma t ON t.id_turma = c.id_turma INNER JOIN aluno a ON a.id_aluno = c.id_aluno INNER JOIN inscricao i ON i.id_inscricao = a.id_aluno WHERE a.id_aluno IS NOT NULL AND c.id_turma = :id_turma AND c.id_professor = :id_professor AND c.data_chamada = CURRENT_DATE')->run([':id_turma' => $cod_turma, ':id_professor' => $id_professor]);

                        while ($dados_chamada = $select_chamada->fetch(PDO::FETCH_ASSOC)) {
                            $nome = $dados_chamada['nome'];
                            $id_aluno = $dados_chamada['aluno'];
                            $data = $dados_chamada['data_chamada'];
                            $data_sem_formatacao = $data;
                            $data_sem_formatacao = date('d/m/Y', strtotime($data_sem_formatacao));
                            $data_usa = date('Y-m-d', strtotime($data));
                            $status = $dados_chamada['status'];
                            $mascara_status = $status ? "Presente" : "Ausente";
                            $cor = $status ? 'lightgreen' : 'tomato';
                            ?>
                            <tr style="height: 35px;">						
                                <td><input type="hidden" value="<?php echo $id_aluno; ?>" name="id_aluno"/><?php echo $nome; ?> </td>
                                <td><input type="hidden" value="<?php echo $data_usa; ?>" name="data_chamada"/> <?php echo $data_sem_formatacao; ?> </td>
                                <td style="background-color: <?php echo $cor; ?>"><input type="hidden" value="<?php echo $status; ?>" name="status"/> <?php echo $mascara_status; ?> </td>
                                <td><a title="Modificar o aluno <?php echo $nome; ?>" href="chamada.php?turma=<?php echo $cod_turma; ?>&professor=<?php echo $id_professor; ?>&aluno=<?php echo $id_aluno; ?>&data_chamada=<?php echo $data_usa; ?>&status=<?php echo $status; ?>" class="a2" name="alterar" >Alterar</a></td>                                            
                            </tr>								
                        <?php } ?>					
                    </table>

                <?php } else {
                    $select_turma = $crud->select('nome_turma', 'turma', 'WHERE id_turma = ?')->run([$cod_turma]);
                    $val_turma = $select_turma->fetch(PDO::FETCH_ASSOC);

                    $select_professor = $crud->select('nome_professor', 'professor', 'WHERE id_professor = ?')->run([$id_professor]);
                    $val_professor = $select_professor->fetch(PDO::FETCH_ASSOC); ?>

                    <h1><center>Chamada na Turma <strong><?php echo $val_turma['nome_turma']; ?></strong>, com o Professor(a) <strong><?php echo $val_professor['nome_professor']; ?></strong></center></h1><br/>

                    <?php
                    $select_nome_id_aluno = $crud->select('a.id_aluno, i.nome_aluno', 'aluno a', 'INNER JOIN inscricao i ON i.id_inscricao = a.id_aluno INNER JOIN turma t ON t.id_turma = a.id_turma WHERE t.id_turma = ? ORDER BY i.nome_aluno ASC')->run([$cod_turma]);
                    $numRows = $select_nome_id_aluno->rowCount();

                    if ($numRows <= 0) {
                        echo "<h2>Essa turma ainda não possui alunos!</h2>";
                    } else {
                        $alunosId = null;
                        $alunosNomes = null;
                        while ($row = $select_nome_id_aluno->fetch(PDO::FETCH_NUM)) {
                            //na row[0] estão todos os ids dos alunos da turma selecionada
                            $alunosId .= $row[0] . "|";
                            $alunosNomes .= $row[1] . "|";
                        }
                        //func para remover o ultimo caracter que nesse caso é um espaço vazio
                        $alunosId = substr($alunosId, 0, -1);
                        //func que separa a string em um array apos cada pipe "|";
                        $alunosId = explode("|", $alunosId);

                        $alunosNomes = substr($alunosNomes, 0, -1);
                        $alunosNomes = explode("|", $alunosNomes);
                        ?>

                        <form name="chamada" method="post" enctype="multipart/form-data">
                            <?php for ($i = 0; $i < $numRows; $i++) { ?>
                                <table width="955" border="0">
                                    <tr>
                                        <td width="94"><strong>Código:</strong></td>
                                        <td width="450"><strong>Nome:</strong></td>
                                        <td><strong><center>Selecione se este aluno faltou:</center></strong></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php echo $alunosId[$i]; ?>
                                            <input type="hidden" name="" value="<?php echo $alunosId[$i]; ?>" >
                                        </td>
                                        <td>
                                            <?php echo $alunosNomes[$i]; ?>
                                            <input type="hidden" name="nome" value="<?php echo $alunosNomes[$i]; ?>" >
                                        </td>
                                        <td>
                                            <center>
                                                <?php
                                                echo "<input type='hidden' name='status[$i]' value='1'/>";
                                                echo "<input type='checkbox' name='status[$i]' value='0'/>";
                                                ?>
                                            </center>
                                        </td>
                                    </tr>
                                </table>
                            <?php } ?>
                            <table width="955" style="background-color: #2C82CE; border-color: #2C82CE">
                                <tr>
                                    <td width="62">
                                        <center><input type="submit" name="guardar" id="button" class="input" title="Concluir" value="Concluir"/></center>
                                    </td>								
                                </tr>								  							
                            </table>
                        </form>

                        <?php
                        if (isset($_POST['guardar'])) {

                            date_default_timezone_set("America/Sao_Paulo");
                            $data_hoje = date('Y-m-d');
                            $insert_chamada = $crud->insert('chamada', 'id_turma, id_professor, data_chamada, id_aluno, presenca', '(?, ?, ?, ?, ?)');

                            $x = 0;
                            foreach ($_POST['status'] as $falta) {                                
                                $insert_chamada->run([$cod_turma, $id_professor, $data_hoje, $alunosId[$x], $falta]);
                                $x++;
                            }

                            if ($insert_chamada) {
                                echo "<script language='javascript'>window.alert('Chamada Realizada com sucesso!'); window.location='chamada.php?turma=$cod_turma&professor=$id_professor&buscar=Buscar';</script>";
                            } else {
                                echo "<script language='javascript'>window.alert('Houve um erro chamada não realizada!');</script>";
                            }
                        }
                        ?>		
                    <?php } ?>
                    <?php
                }
            } ?>
        </div>
    </body>
</html>