<?php require "topo.php"; ?>﻿
﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Novidades</title>
        <!--<link rel="stylesheet" type="text/css" href="css/cursos_e_disciplinas.css"/>-->
        <link rel="stylesheet" type="text/css" href="css/estilo.css" />
    </head>
    <body>
        <div id="box_curso">
            <?php if (@$_GET['pg'] == 'plano') { ?>
                <?php if (@$_GET['act'] == 'more') { ?>
                    <?php
                    if (@$_GET['plano'] != 'null') {
                        $id_plano = @$_GET['plano'];
                        $consulta_plano = "SELECT pa.id_plano 'id', pa.titulo 'titulo', d.nome_disciplina 'nome_disc', pa.descricao 'descricao' FROM plano_aula pa INNER JOIN disciplina d ON pa.id_disciplina = d.id_disciplina WHERE pa.id_plano = '$id_plano'";
                        $sql_cons_plano = mysqli_query($conexao, $consulta_plano) or die(mysqli_error($conexao));
                        $dados_plano = mysqli_fetch_assoc($sql_cons_plano);
                        $nome_disc = $dados_plano['nome_disc'];
                        $titulo = $dados_plano['titulo'];
                        $descricao = $dados_plano['descricao'];
                        $disabled = @$_GET['func'] == 'alt' ? '' : 'disabled';
                        ?>

                        <center><a class="a2" href="novidades.php?pg=plano&act=more&plano=<?php echo $id_plano; ?>&func=alt" title="Atualizar este plano de aula">atualizar</a>
                            <a class="a2" href="novidades.php?pg=plano&act=more&plano=<?php echo $id_plano; ?>&func=del" title="Excluir este plano de aula">Excluir</a></center>

                        <?php
                        if (@$_GET['func'] == 'del') {
                            $sql_delete = mysqli_query($conexao, "DELETE FROM plano_aula WHERE id_plano = '$id_plano'");
                            if (!$sql_delete) {
                                echo mysqli_errno($conexao) . ": " . mysqli_error($conexao) . "\n";
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
                                <td><i>Matéria : </i><b>
                                        <?php if ($id_plano == 'null') { ?>
                                            <select name="materia" style="width: auto">

                                                <?php
                                                $sql_select_materias_diferentes = "SELECT id_disciplina, nome_disciplina FROM disciplina WHERE nome_disciplina != '' ORDER BY nome_disciplina";
                                                //"SELECT d.id_disciplina 'id_disc' , d.nome_disciplina 'nome_disc' FROM disciplina d INNER JOIN disciplina_ministrada dm ON d.id_disciplina = dm.id_disciplina WHERE d.nome_disciplina <> '' AND dm.id_professor = '$id_professor'"
                                                $select_materias_diferentes = mysqli_query($conexao, $sql_select_materias_diferentes) or die(mysqli_error($conexao));

                                                while ($select_materias_diferentes_valores = mysqli_fetch_assoc($select_materias_diferentes)) {
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
                                    </b></td>
                            </tr>
                            <tr>
                                <td><center><i><b>Plano de Aula</b></i></center></td>
                            </tr>
                            <tr>
                                <td><center><i><b>Título</b></i></center></td>
                            </tr>
                            <tr>							
                                <td><center><b><input name="titulo" type="text" style="width: 900px" value="<?php echo $titulo; ?>" <?php echo $disabled; ?>/></b></center></td>
                            </tr><br>
                                <tr>
                                    <td><center><i><b>Descrição</b></i></center></td>
                                </tr>
                                <tr>
                                    <td><center><b><textarea name="descricao" rows="20" cols="123" <?php echo $disabled; ?> ><?php echo $descricao; ?></textarea></b></center></td>
                        						</tr>
                                <?php if ((@$_GET['func'] == 'alt') || ($_GET['plano'] == 'null')) { ?>
                                    							<tr>
                                    								<td><center>
                                    									<input class="input" type="submit" name="salvar" value="Salvar" />
                                    									<a class="input" href="novidades.php?pg=plano<?php echo $caminho = $_GET['plano'] == 'null' ? '' : "&act=more&plano=$id_plano"; ?>">Cancelar</a>
                                    								</center></td>
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
                            $insert_plano = "INSERT INTO plano_aula (id_professor, id_disciplina, titulo, descricao) VALUES('$id_professor', '$new_disciplina' ,'$new_titulo', '$new_descricao')"; //(id_professor, id_disciplina, titulo, descricao) VALUES($id_professor, $new_disciplina ,$new_titulo, $new_descricao)
                            $sql_insert = mysqli_query($conexao, $insert_plano);
                            if (!$sql_insert) {
                                echo mysqli_errno($conexao) . ": " . mysqli_error($conexao) . "\n";
                            } else {
                                echo "<script language='javascript'> window.alert('Plano de Aula Cadastrado com Sucesso');window.location='novidades.php?pg=plano';</script>";
                            }
                        } else {
                            if (($new_titulo != $titulo) || ($new_descricao != $descricao)) {
                                $update_plano = "UPDATE plano_aula SET titulo = '$new_titulo', descricao = '$new_descricao' WHERE id_plano = '$id_plano'";
                                $sql_update = mysqli_query($conexao, $update_plano) or die(mysqli_error($conexao));
                                if ($sql_update) {
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
            			<br><br>
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
                            //$busca_plano = "SELECT pa.id_plano id, pa.titulo titulo, d.nome_disciplina nome_disc FROM plano_aula pa INNER JOIN disciplina d ON pa.id_disciplina = d.id_disciplina WHERE pa.id_professor = '$cod_prof'";
                            //$sql_busca_plano = mysqli_query($conexao, $busca_plano) or die(mysqli_error($conexao));
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
            			<br>
                        <?php } ?>
		
		
		
                        <?php
                        if (@$_GET['pg'] == 'data') {
                            
                        }
                        ?>		
	</div>

</body>
</html>
	