<?php require "topo.php"; 
$id_professor = $_SESSION['cod_professor']; ?>﻿
﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Plano de Aula</title>
        <link rel="stylesheet" type="text/css" href="css/estilo.css" />
    </head>
    <body>
        <div id="box_curso">
            <?php// if (@$_GET['pg'] == 'plano') { ?>
                <?php if (@$_GET['act'] == 'more') { ?>
                    <?php if (@$_GET['plano'] != 'null') {
                        $id_plano = @$_GET['plano'];
                        $consulta_plano = $crud->select('pa.id_plano id, pa.titulo titulo, d.nome_disciplina nome_disc, pa.descricao descricao', 'plano_aula pa', 'INNER JOIN disciplina d ON pa.id_disciplina = d.id_disciplina WHERE pa.id_plano = ?')->run([$id_plano]);

                        $dados_plano = $consulta_plano->fetch(PDO::FETCH_ASSOC);

                        $nome_disc = $dados_plano['nome_disc'];
                        $titulo = $dados_plano['titulo'];
                        $descricao = $dados_plano['descricao'];
                        $disabled = @$_GET['func'] == 'alt' ? '' : 'disabled';
                        ?>

                        <center><a class="a2" href="plano_aula.php?act=more&plano=<?php echo $id_plano; ?>&func=alt" title="Atualizar este plano de aula">atualizar</a>
                            <a class="a2" href="plano_aula.php?act=more&plano=<?php echo $id_plano; ?>&func=del" title="Excluir este plano de aula">Excluir</a></center>

                        <?php
                        if (@$_GET['func'] == 'del') {
                            $sql_delete = $crud->delete('plano_aula', 'WHERE id_plano = ?')->run([$id_plano]);
                            if ($sql_delete) {
                                echo "<script language='javascript'> window.alert('Plano de Aula Deletado com Sucesso!');window.location='plano_aula.php';</script>";
                            } else {
                                echo "<script language='javascript'> window.alert('Não foi Possível Deletar o Plano de Aula!');</script>";
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
                                <td><center><b><textarea name="descricao" style="resize: none;" rows="20" cols="123" <?php echo $disabled; ?> ><?php echo $descricao; ?></textarea></b></center></td>
                            </tr>
                            <?php if ((@$_GET['func'] == 'alt') || ($_GET['plano'] == 'null')) { ?>
                                <tr>
                                    <td>
                                        <center>
                                            <input class="input" type="submit" name="salvar" value="Salvar" />
                                            <a class="a2" href="plano_aula.php?<?php echo $caminho = ($_GET['plano'] == 'null') ? '' : "act=more&plano=$id_plano"; ?>">Cancelar</a>
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
                            $insert_plano = $crud->insert('plano_aula', 'id_professor, id_disciplina, titulo, descricao', '(?, ?, ?, ?)')->run([$id_professor, $new_disciplina, $new_titulo, $new_descricao]);
                            
                            if ($insert_plano) {
                                echo "<script language='javascript'>window.alert('Plano de Aula Cadastrado com Sucesso');window.location='plano_aula.php';</script>";                                
                            } else {
                                echo "<script language='javascript'> window.alert('Ocorreu um Erro');</script>";
                            }
                        } else {
                            if (($new_titulo != $titulo) || ($new_descricao != $descricao)) {
                                $update_plano = $crud->update('plano_aula', 'titulo = :titulo, descricao = :descricao', 'WHERE id_plano = :id')->run([':id' => $id_plano, ':titulo' => $new_titulo, ':descricao' => $new_descricao]);
                                
                                if ($update_plano) {
                                    echo "<script language='javascript'> window.alert('atualizado com Sucesso');window.location='plano_aula.php?act=more&plano=$id_plano';</script>";
                                }
                            }
                        }
                    } ?>
                <?php die; } ?>			
                <a class="a2" href="plano_aula.php?act=more&plano=null">Adicionar novo plano de aula</a>
                <br/>
                <h1><center><i><b>Meus Planos de Aula</b></i></center></h1>
                <table width="900px" class="bordasimples">                    
                    <thead>
                        <th><center><i><b>Matéria</b></i></center></th>
                        <th><center><i><b>Título</b></i></center></th>
                    </thead>
                    <?php
                    $cod_prof = 1; //Alterar após separar cada parte assim aqui ira receber o código que vem por url post ou get ou sla
                    $busca_plano = $crud->select('pa.id_plano id, pa.titulo titulo, d.nome_disciplina nome_disc', 'plano_aula pa', 'INNER JOIN disciplina d ON pa.id_disciplina = d.id_disciplina WHERE pa.id_professor = ?')->run([$cod_prof]);
                     
                    while ($dados_plano = $busca_plano->fetch(PDO::FETCH_ASSOC)) {
                        $class = @$i % 2 == 0 ? ' class="dif"' : '';
                        $nome_disc = $dados_plano['nome_disc'];
                        $titulo = $dados_plano['titulo'];
                        $id_plano = $dados_plano['id'];
                        ?>                                        					
                        <tr <?php echo $class; ?> onclick="location.href = 'plano_aula.php?act=more&plano=<?php echo $id_plano; ?>'">
                            <td><center><?php echo $nome_disc; ?></center></td>	
                            <td><center><?php echo $titulo; ?></center></td>
                        </tr>
                                        					
                    <?php @$i++; } ?>
                </table>
                <br/>
            <?php // } ?>
	</div>
</body>
</html>