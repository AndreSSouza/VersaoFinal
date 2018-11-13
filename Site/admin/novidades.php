<?php require "topo.php"; ?>﻿
﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Novidades</title>
        <link rel="stylesheet" type="text/css" href="css/estilo.css" />
    </head>
    <body>
        <div id="box_curso">
            <?php if (@$_GET['pg'] == 'plano') { ?>
                <?php if (@$_GET['act'] == 'more') { ?>
                    <?php
                    if (@$_GET['plano'] != 'null') {
                        $id_plano = @$_GET['plano'];
                        $consulta_plano = $crud->select('pa.id_plano id, pa.titulo titulo, d.nome_disciplina nome_disc, pa.descricao descricao', 'plano_aula pa', 'INNER JOIN disciplina d ON pa.id_disciplina = d.id_disciplina WHERE pa.id_plano = ?')->run([$id_plano]);

                        $dados_plano = $consulta_plano->fetch(PDO::FETCH_ASSOC);

                        $nome_disc = $dados_plano['nome_disc'];
                        $titulo = $dados_plano['titulo'];
                        $descricao = $dados_plano['descricao'];
                        $disabled = @$_GET['func'] == 'alt' ? '' : 'disabled';
                        ?>

                        <center><a class="a2" href="novidades.php?pg=plano&act=more&plano=<?php echo $id_plano; ?>&func=alt" title="Atualizar este plano de aula">atualizar</a>
                            <a class="a2" href="novidades.php?pg=plano&act=more&plano=<?php echo $id_plano; ?>&func=del" title="Excluir este plano de aula">Excluir</a></center>

                        <?php
                        if (@$_GET['func'] == 'del') {
                            $sql_delete = $crud->delete('plano_aula', 'WHERE id_plano = ?')->run([$id_plano]);
                            //mysqli_query($conexao, "DELETE FROM plano_aula WHERE id_plano = '$id_plano'");
                            if (!$sql_delete) {
                                echo "<script language='javascript'> window.alert('Plano de Aula Não Foi Deletado com Sucesso!');</script>";
                            } else {
                                echo "<script language='javascript'> window.alert('Plano de Aula Deletado com Sucesso!');window.location='novidades.php?pg=plano';</script>";
                            }
                        }
                    } else {
                        $id_plano = 'null';
                        $disabled = '';
                        $titulo = '';
                        $descricao = '';
                    }
                    ?>

                    <form method="post">
                        <table width="900px">				
                            <tr>
                                <td>
                                    <i>Matéria : </i>
                                    <b>
                                        <?php if ($id_plano == 'null') { ?>
                                            <select name="materia" style="width: auto">

                                                <?php
                                                $select_mat_dif = $crud->select('id_disciplina, nome_disciplina', 'disciplina', 'WHERE nome_disciplina IS NOT NULL ORDER BY nome_disciplina')->run();

                                                while ($select_materias_diferentes_valores = $select_mat_dif->fetch(PDO::FETCH_ASSOC)) {
                                                    $id_disciplina = $select_materias_diferentes_valores['id_disciplina'];
                                                    $nome_disciplina = $select_materias_diferentes_valores['nome_disciplina'];
                                                    ?>
                                                    <option value="<?php echo $id_disciplina; ?>">
                                                        <?php echo $nome_disciplina; ?>
                                                    </option>
                                                <?php } ?>										
                                            </select>
                                            <?php
                                        } else {
                                            echo $nome_disc;
                                        }
                                        ?>
                                    </b>
                                </td>
                            </tr>
                            <tr>
                                <td><center><i><b>Plano de Aula</b></i></center></td>
                            </tr>
                            <tr>
                                <td><center><i><b>Título</b></i></center></td>
                            </tr>
                            <tr>							
                                <td><center><b><input name="titulo" type="text" style="width: 900px" value="<?php echo $titulo; ?>" <?php echo $disabled; ?>/></b></center></td>
                            </tr><br/>
                            <tr>
                                <td><center><i><b>Descrição</b></i></center></td>
                            </tr>
                            <tr>
                                <td><center><b><textarea name="descricao" rows="20" cols="123" <?php echo $disabled; ?> ><?php echo $descricao; ?></textarea></b></center></td>
                            </tr>
                            <?php if ((@$_GET['func'] == 'alt') || ($_GET['plano'] == 'null')) { ?>
                                <tr>
                                    <td>
                                        <center>
                                            <input class="input" type="submit" name="salvar" value="Salvar" />
                                            <a class="input" href="novidades.php?pg=plano<?php echo $caminho = $_GET['plano'] == 'null' ? '' : "&act=more&plano=$id_plano"; ?>">Cancelar</a>
                                        </center>
                                    </td>
                                </tr>							
                            <?php } ?>						
                        </table>										
                    </form>	
                    <?php
                    if (isset($_POST['salvar'])) {

                        $new_titulo = $_POST['titulo'];
                        $new_descricao = $_POST['descricao'];

                        if ($_GET['plano'] == 'null') {
                            $new_disciplina = $_POST['materia'];
                            $id_professor = '1'; //aqui só está recebendo 1 porque ainda não está separado esta parte para o prefessor mas após isso o codigo do professor vai ser colhido ao entrar no sistema
                            $insert_plano = $crud->insert('plano_aula', 'id_professor, id_disciplina, titulo, descricao', '(?, ?, ?, ?)')->run([$id_professor, $new_disciplina, $new_titulo, $new_descricao]);
                            //$insert_plano = "INSERT INTO plano_aula (id_professor, id_disciplina, titulo, descricao) VALUES('$id_professor', '$new_disciplina' ,'$new_titulo', '$new_descricao')"; //(id_professor, id_disciplina, titulo, descricao) VALUES($id_professor, $new_disciplina ,$new_titulo, $new_descricao)
                            //$sql_insert = mysqli_query($conexao, $insert_plano);
                            if (!$insert_plano) {
                                echo "<script language='javascript'> window.alert('Ocorreu um Erro');</script>";
                            } else {
                                echo "<script language='javascript'> window.alert('Plano de Aula Cadastrado com Sucesso');window.location='novidades.php?pg=plano';</script>";
                            }
                        } else {
                            if (($new_titulo != $titulo) || ($new_descricao != $descricao)) {
                                $update_plano = $crud->update('plano_aula', 'titulo = :titulo, descricao = $descricao', 'WHERE id_plano = :id')->run([':id' => $id_plano, ':titulo' => $new_titulo, ':descricao' => $new_descricao]);
                                //$update_plano = "UPDATE plano_aula SET titulo = '$new_titulo', descricao = '$new_descricao' WHERE id_plano = '$id_plano'";
                                //$sql_update = mysqli_query($conexao, $update_plano) or die(mysqli_error($conexao));
                                if ($update_plano) {
                                    echo "<script language='javascript'> window.alert('atualizado com Sucesso');window.location='novidades.php?pg=plano&act=more&plano=$id_plano';</script>";
                                }
                            }
                        }
                    }
                    ?>

                    <?php
                    die;
                }
                ?>			
                <a class="a2" href="novidades.php?pg=plano&act=more&plano=null">Adicionar novo plano de aula</a>
                <br/><br/>
                <table width="900px">
                    <tr>
                        <td colspan="2"><center><i><b>Meus Planos de Aula</b></i></center></td>
                    </tr>
                    <tr>
                        <td><center><i><b>Matéria</b></i></center></td>
                        <td><center><i><b>Título</b></i></center></td>
                    </tr>
                    <?php
                    $cod_prof = 1; //Alterar após separar cada parte assim aqui ira receber o código que vem por url post ou get ou sla
                    $busca_plano = $crud->select('pa.id_plano id, pa.titulo titulo, d.nome_disciplina nome_disc', 'plano_aula pa', 'INNER JOIN disciplina d ON pa.id_disciplina = d.id_disciplina WHERE pa.id_professor = ?')->run([$cod_prof]);
                     
                    while ($dados_plano = $busca_plano->fetch(PDO::FETCH_ASSOC)) {
                        $nome_disc = $dados_plano['nome_disc'];
                        $titulo = $dados_plano['titulo'];
                        $id_plano = $dados_plano['id'];
                        ?>                                        					
                        <tr>
                            <td><center><?php echo $nome_disc; ?></center></td>	
                            <td><center><a href="novidades.php?pg=plano&act=more&plano=<?php echo $id_plano; ?>"><?php echo $titulo; ?></a></center></td>
                        </tr>
                                        					
                    <?php } ?>
                </table>
                <br/>
            <?php } ?>
		
            <?php
            if (@$_GET['pg'] == 'data') {?>
                                            
                <?php if (@$_GET['area'] == 'video') { ?>

                    <?php if (@$_GET['cadastra'] == 'sim') { ?>  

                        <h1>Cadastrar Sala</h1>

                        <?php if (isset($_POST['cadastra_turma'])) {

                            $nome_sala = $_POST['nome_sala']; 
                            $insert_sala = $crud->insert('sala_video', 'identificador', '(?)')->run([$nome_sala]);

                            if ($insert_sala->rowCount() <= 0) {
                                echo "<script language='javascript'> window.alert('Erro ao Cadastrar!');</script>";
                            } else {
                                echo "<script language='javascript'>                                                                                                                                                                                                window.alert('Cadastro Realizado com sucesso!');                                                                                                                                                                            window.location='novidades.php?pg=data&area=video';
                                      </script>";
                            }
                        } ?>

                        <form name="form1" method="post" action="">
                            <table border="0">
                                <tr>
                                    <td width="134"><center>Nome da Sala</center></td>
                                </tr>
                                <tr>
                                    <td><input type="text" name="nome_sala" maxlength="3"/></td>
                                </tr>
                                <tr>
                                    <td><center><input class="input" type="submit" name="cadastra_turma" id="button" value="Cadastrar"/></center></td>
                                </tr>
                            </table>
                        </form>
                        <br/>
                    <?php die; } ?>
                <?php }?>

                <?php if (@$_GET['area'] == 'datashow') { ?>
                    <?php if (@$_GET['cadastra'] == 'sim') { ?>
                        <?php if (isset($_POST['cadastra_reserva'])) {

                            $id_prof_post = $_POST['professor']; 
                            $id_sala_post = $_POST['sala']; 
                            $data_reserva_post = $_POST['data_reserva']; 
                            $obs_post = $_POST['obs'];

                            $insert_reserva = $crud->insert('reserva', 'id_sala, id_professor, data_reserva, obs', '(?, ?, ?, ?)')
                                                   ->run([$id_sala_post, $id_prof_post, $data_reserva_post, $obs_post]);

                            if ($insert_reserva->rowCount() <= 0) {
                                echo "<script language='javascript'> window.alert('Erro ao Cadastrar!');</script>";
                            } else {
                                echo "<script language='javascript'>                                                                                                                                    window.alert('Cadastro Realizado com sucesso!');
                                         window.location='novidades.php?pg=data';
                                      </script>";
                            }
                        } ?>
                        <form method="post" border="0px" width="900px">
                            <table>
                                <tr>
                                    <td colspan="2"><center>Fazer Reserva do Data Show</center></td>
                                </tr>
                                <tr>
                                    <td>Professor</td>
                                    <td>Sala</td>
                                </tr>
                                <tr>
                                    <td>
                                        <select name="professor">
                                            <option>Selecione o Professor</option>
                                            <?php $sel_prof = $crud->select('id_professor, nome_professor', 'professor', 'WHERE id_professor IS NOT NULL ORDER BY nome_professor')->run();
                                            while ($val_prof = $sel_prof->fetch(PDO::FETCH_ASSOC)){
                                                $id_professor = $val_prof['id_professor'];
                                                $nome_professor = $val_prof['nome_professor'];
                                                echo "<option value='$id_professor'>$nome_professor</option>"; 
                                            }?>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="sala">
                                            <option>Selecione a Turma</option>
                                            <?php $sel_sala = $crud->select('id_sala, identificador', 'sala_video', 'WHERE id_sala IS NOT NULL ORDER BY identificador')->run();
                                            while ($val_sala = $sel_sala->fetch(PDO::FETCH_ASSOC)){
                                                $id_sala = $val_sala['id_sala'];
                                                $nome_sala = $val_sala['identificador'];
                                                echo "<option value='$id_sala'>$nome_sala</option>"; 
                                            }?>
                                        </select>
                                    </td>
                                </tr>                                            
                                <tr>
                                    <td>Data</td>
                                    <td>Observação</td> 
                                </tr>
                                <tr>
                                    <td><input name="data_reserva" type="date"/></td>
                                    <td>
                                        <textarea name="obs" rows="3" cols="40" maxlength="120"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"><center><input class="input" id="button" name="cadastra_reserva" value="Cadastrar" type="submit"/></center></td>
                                </tr>
                            </table>                                    
                        </form>
                    <?php die; } ?>
                <?php } ?>

                <center>
                    <a class="a2" href = "novidades.php?pg=data&area=datashow&cadastra=sim">Reservas</a>
                    <a class="a2" href = "novidades.php?pg=data&area=video&cadastra=sim">Sala de Vídeo</a>
                </center>
                <br/>
                <center><i><b><h1>Proximas Reservas</h1></b></i></center>
                <table border="0px" width = "900px">                                
                    <thead>
                        <th><center><i><b>Sala</b></i></center></th>
                        <th><center><i><b>Professor</b></i></center></th>
                        <th><center><i><b>Data da Reserva</b></i></center></th>
                        <th><center><i><b>Obs</b></i></center></th>
                    </thead>
                    <?php
                    $proximos_4_sabados = date("Y-m-d",mktime(date("H"),date("i"),date("s"),date("m"),date("d")+28,date("Y")));

                    $mostra_todos = $crud->select('r.id_reserva, sv.identificador, p.nome_professor, r.data_reserva, r.obs', 'reserva r', 'INNER JOIN professor p ON p.id_professor = r.id_professor INNER JOIN sala_video sv ON sv.id_sala = r.id_sala WHERE r.id_sala IS NOT NULL AND r.id_professor IS NOT NULL AND r.data_reserva BETWEEN CURRENT_DATE AND ? ORDER BY r.data_reserva')->run([$proximos_4_sabados]);                                                       
                    while ($valores_reserva = $mostra_todos->fetch(PDO::FETCH_ASSOC)){
                        $class = @$i % 2 == 0 ? ' class="dif"' : '';                                    
                        $nome_sala = $valores_reserva['identificador'];
                        $nome_professor = $valores_reserva['nome_professor'];
                        $data_reserva = date('d/m/Y', strtotime($valores_reserva['data_reserva']));
                        $obs = $valores_reserva['obs']; ?>
                        <tr <?php echo $class; ?>>
                            <td><?php echo $nome_sala;?></td>
                            <td><?php echo $nome_professor;?></td>
                            <td><?php echo $data_reserva;?></td>
                            <td><?php echo substr($obs, 0, 20);?></td>
                        </tr>                                                                        
                    <?php @$i++; } ?>
                </table>

                <?php
                    /*
                //$cod_prof = 1; //Alterar após separar cada parte assim aqui ira receber o código que vem por url post ou get ou sla
                $busca_plano = $crud->select('s.identificador, rs.data_reserva, rs.obs, p.nome_professor, rs.id_reserva', 'reserva rs', 'INNER JOIN sala_video s ON s.id_sala = rs.id_sala INNER JOIN professor p ON p.id_professor = rs.id_professor WHERE p.id_professor IS NOT NULL')->run([]);
                //$busca_plano = "SELECT pa.id_plano id, pa.titulo titulo, d.nome_disciplina nome_disc FROM plano_aula pa INNER JOIN disciplina d ON pa.id_disciplina = d.id_disciplina WHERE pa.id_professor = '$cod_prof'";
                //$sql_busca_plano = mysqli_query($conexao, $busca_plano) or die(mysqli_error($conexao));
                while ($dados_plano = $busca_plano->fetch(PDO::FETCH_ASSOC)) 
                     * {
                     * $class = @$i % 2 == 0 ? ' class="dif"' : '';
                    $nome_disc = $dados_plano['nome_disc'];
                    $titulo = $dados_plano['titulo'];
                    $id_plano = $dados_plano['id'];
                    ?><!--
                    <tr>
                        <td><center><?php echo $nome_disc; ?></center></td>	
                        <td><center><a href="novidades.php?pg=plano&act=more&plano=<?php echo $id_plano; ?>"><?php echo $titulo; ?></a></center></td>
                    </tr>-->					
                <?php } */ ?>
                </table>
                <br/> 
           <?php die; } ?>		
	</div>

</body>
</html>