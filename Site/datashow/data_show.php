<?php require "topo.php"; ?>﻿
﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Data Show</title>
        <link rel="stylesheet" type="text/css" href="css/estilo.css" />
    </head>
    <body>
        <div id="box_curso">                       
        <!Area responsavel pela sala de Video>
            <?php if (@$_GET['area'] == 'video') { ?> 
        <!Visualização da sala de video>
                <?php if (@$_GET['mod'] == 'view') { 
                    $cod_sala = $_GET['sala'];

                    $select_info_sala = $crud->select('s.identificador, s.disponivel', 'sala_video s', 'WHERE s.id_sala = ?')->run([$cod_sala]);                      

                    $val_title = $select_info_sala->fetch(PDO::FETCH_ASSOC);

                    $nome_sala = $val_title['identificador'];
                    $disponivel = $val_title['disponivel']; ?>

                    <center><a class="a2" href="data_show.php?area=video&mod=alt&sala=<?php echo $cod_sala; ?>">Alterar</a></center>                    
                    <br/><br/>
                    <table width="900">
                        <tr>
                            <td>
                                <center>Identificador:
                                    <input type="text" style="width:30px" disabled value="<?php echo $nome_sala; ?>"></input>
                                </center>
                            </td>
                            <td>
                                <center>Status da Sala:
                                    <input type="text" style="width:85px" disabled value="<?php echo $disponivel ? 'Disponível' : 'Indisponível'; ?>"></input>
                                </center>
                            </td>
                        </tr>
                    </table>
                    <br/>
                    <?php $mostra_tudo = $crud->select('p.nome_professor, r.data_reserva', 'sala_video s', 'INNER JOIN reserva r ON r.id_sala = s.id_sala INNER JOIN professor p ON p.id_professor = r.id_professor WHERE s.id_sala = ? ORDER BY r.data_reserva')->run([$cod_sala]); ?>
                    <table border="0" class="bordasimples" width="900px">
                        <thead>
                            <th>Nome do Professor</th>
                            <th>Data da Reserva</th>
                        </thead>                                                    
                        <?php while($val_sala = $mostra_tudo->fetch(PDO::FETCH_ASSOC)){
                            $class = @$i % 2 == 0 ? ' class="dif"' : '';
                            $nome_professor = $val_sala['nome_professor'];
                            $data_reserva = $val_sala['data_reserva']; ?>
                            <tr <?php echo $class; ?>>
                                <td><?php echo $nome_professor;?></td>
                                <td><?php echo date('d/m/Y', strtotime($data_reserva));?></td>
                            </tr>                        
                       <?php @$i++; }?>
                    </table>
                <?php die; } ?> 
            <!Alteração de Sala de Video>
                <?php if (@$_GET['mod'] == 'alt') { 

                    $cod_sala = $_GET['sala'];

                    $select_sala = $crud->select('s.identificador, s.disponivel', 'sala_video s', 'WHERE s.id_sala = ?')->run([$cod_sala]);                      

                    $values_sala = $select_sala->fetch(PDO::FETCH_ASSOC);

                    $nome_sala = $values_sala['identificador'];
                    $disponivel = $values_sala['disponivel'];
                    //$trocaStatus = $disponivel ? 'Disponível' : 'Indisponível';                         
                    ?>

                    <h1><center><i><b>Alterar Sala de Video <?php echo $nome_sala;?></b></i></center></h1>
                    <br/>
                    <form method="POST">
                        <table border="0" width="900">                            
                            <tr>
                                <td>Identificador da Sala de Video</td>
                                <td>Status da Sala de Video</td>
                            </tr>
                            <tr>
                                <input type="hidden" name="id_sala" value="<?php echo $cod_sala; ?>" />
                                <td><input type="text" name="identificador" maxlength="3" value="<?php echo $nome_sala; ?>"/></td>
                                <td>
                                    <select name="status"> 
                                        <?php if ($disponivel == 1) { ?>
                                            <option value="1">Disponível</option>
                                            <option value="0">indisponível</option>
                                        <?php } else { ?>                                                                                                                  
                                            <option value="0">indisponível</option>
                                            <option value="1">Disponível</option>
                                        <?php } ?>                                            
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <center>
                                        <input type="submit" name="alterar" title="Alterar Sala de Video" class="input" id="button" value="Alterar" />
                                        <input type="submit" name="cancelar" title="Cancelar Alteração da Sala de Video" class="input" id="button" value="Cancelar" />
                                    </center>
                                </td>
                            </tr>
                        </table>
                    </form>

                    <?php if (isset($_POST['alterar'])) {

                        $cod_sala = $_POST['id_sala'];
                        $new_identificador = $_POST['identificador'];
                        $new_status = $_POST['status'];

                        if (($new_identificador != $nome_sala) || ($new_status != $disponivel)) {  

                            $update_sala = $crud->update('sala_video', 'identificador = :nome, disponivel = :status', 'WHERE id_sala = :id')->run([':id' => $cod_sala, ':nome' => $new_identificador, ':status' => $new_status]);

                            if ($update_sala) { 
                                echo '<script language="javascript">window.alert("atualizado com Sucesso");window.location="data_show.php?area=video&mod=view&sala='.$cod_sala.'";</script>';
                            }
                        } else { 
                            echo '<script language="javascript">window.location="data_show.php?area=video&mod=view&sala='.$cod_sala.'";</script>';
                        }                          

                    } else if (isset ($_POST['cancelar'])) {
                        echo '<script language="javascript">window.location="data_show.php?area=video&mod=view&sala='.$cod_sala.'";</script>';
                    } ?>
                <?php die; } ?>
            <!Cadastrar Sala de Video>
                <?php if (@$_GET['cadastra'] == 'sim') { ?>  

                    <h1>Cadastrar Sala</h1>

                    <?php if (isset($_POST['cadastra_sala'])) {

                        $nome_sala = $_POST['nome_sala']; 
                        $insert_sala = $crud->insert('sala_video', 'identificador', '(?)')->run([$nome_sala]);

                        if ($insert_sala->rowCount() <= 0) {
                            echo "<script language='javascript'> window.alert('Erro ao Cadastrar!');</script>";
                        } else {
                            echo "<script language='javascript'>                                                                                                                                                    window.alert('Cadastro Realizado com sucesso!');
                                     window.location='data_show.php?area=video';
                                  </script>";
                        }
                    } ?>

                    <form method="post" action="">
                        <table width="auto" border="0">
                            <tr>
                                <td width="134"><center>Nome da Sala</center></td>
                            </tr>
                            <tr>
                                <td><input type="text" name="nome_sala" maxlength="3"/></td>
                            </tr>
                            <tr>
                                <td><center><input class="input" type="submit" name="cadastra_sala" id="button" value="Cadastrar"/></center></td>
                            </tr>
                        </table>
                    </form>
                    <br/>

                <?php die; } ?>

                <a class="a2" href = "data_show.php?area=video&cadastra=sim">Cadastrar</a>   
                <br/>
                <h1><center><i><b>Salas de Video</b></i></center></h1>
                <br/>
                <table width="900px" class="bordasimples">
                    <thead>                                                   
                        <th><center><i><b>Identificador</b></i></center></th>
                        <th><center><i><b>Status</b></i></center></th>
                    </thead>
                    <?php                        
                    $busca_sala = $crud->select('identificador, id_sala, disponivel', 'sala_video', 'WHERE identificador IS NOT NULL ORDER BY identificador, disponivel')->run();

                    while ($dados_sala = $busca_sala->fetch(PDO::FETCH_ASSOC)) {
                        $class = @$i % 2 == 0 ? ' class="dif"' : '';
                        $cod_sala = $dados_sala['id_sala'];
                        $nome_sala = $dados_sala['identificador'];
                        $disponivel = $dados_sala['disponivel'];
                        $disponivel = ($disponivel == 1) ? 'Disponível' : 'Indisponível' ;
                        ?>                                        					
                        <tr <?php echo $class; ?> onclick="location.href = 'data_show.php?area=video&mod=view&sala=<?php echo $cod_sala;?>';">
                            <td><center><?php echo $nome_sala; ?></center></td>	
                            <td><center><?php echo $disponivel; ?></center></td>
                        </tr>    
                    <?php @$i++; } ?>
                </table>   
            <?php die; }?>
    <!Parte do Data Show Referente a Reserva>
            <?php if (@$_GET['area'] == 'datashow') { ?>   
    <!Parte para novo cadastro de reserva>
                <?php if (@$_GET['cadastra'] == 'sim') { ?>  
                    <form method="POST">
                        <table width="auto"  border="0px">
                           <tr style="height: 45px">
                                <td colspan="6"><center>Cadastrar reserva</center></td>
                            </tr>
                            <tr style="height: 45px">
                                <td style="width: auto; text-align: right; padding-right: 5px;"><label>Professor: </label></td>
                                <td style="width: 183px;">
                                    <select name="professor" style="width: 183px;">                                        
                                        <option>Selecione o Professor</option>
                                        <?php $sel_prof = $crud->select('id_professor, nome_professor', 'professor', 'WHERE id_professor IS NOT NULL ORDER BY nome_professor')->run();
                                        while ($val_prof = $sel_prof->fetch(PDO::FETCH_ASSOC)){
                                            $id_professor = $val_prof['id_professor'];
                                            $nome_professor = $val_prof['nome_professor'];
                                            echo "<option value='$id_professor'>$nome_professor</option>"; 
                                        }?>
                                    </select>
                                </td>
                                <td style=" width: 9px; text-align: right; padding-right: 5px; padding-left: 5px;">Sala:</td>
                                <td style="width: 147px;">                    
                                    <select name="sala" style="width: 147px;">
                                        <option>Selecione a Sala</option>
                                        <?php $sel_sala = $crud->select('id_sala, identificador', 'sala_video', 'WHERE id_sala IS NOT NULL ORDER BY identificador')->run();
                                        while ($val_sala = $sel_sala->fetch(PDO::FETCH_ASSOC)){
                                            $id_sala = $val_sala['id_sala'];
                                            $nome_sala = $val_sala['identificador'];
                                            echo "<option value='$id_sala'>$nome_sala</option>"; 
                                        }?>
                                    </select>                                        
                                </td>
                                <td style="width: 36px; text-align: right; padding-left: 5px; padding-right: 5px;">Data:</td>
                                <td style="width: 142px;">
                                    <input name="data_reserva" type="date" style="height: 30px; width: 142px;"/>
                                </td>
                            </tr>
                            <tr style="height: 45px" >                        
                                <td style="width: 61px; padding-right: 5px;">Observação:</td><td colspan="5">                
                                    <textarea name="obs" rows="2" maxlength="120" style="width: 583px; font-size: 15px; resize: none;" ></textarea>
                                </td>
                            </tr>
                            <tr style="height: 45px">
                                <td style="padding-top: 20px;" colspan="6">
                                    <center>
                                        <input class="input" id="button" name="cadastrar_reserva" value="Cadastrar" type="submit"/>
                                        <input class="input" id="button" name="cancelar" value="Cancelar" type="submit"/>
                                    </center>
                                </td>
                            </tr>
                        </table>
                    </form>                    
                    
                    <?php if (isset($_POST['cadastrar_reserva'])) {

                        $id_prof_post = $_POST['professor']; 
                        $id_sala_post = $_POST['sala']; 
                        $data_reserva_post = $_POST['data_reserva']; 
                        $obs_post = (trim($_POST['obs'])) ?: NULL;

                        $insert_reserva = $crud->insert('reserva', 'id_sala, id_professor, data_reserva, obs', '(?, ?, ?, ?)')
                                               ->run([$id_sala_post, $id_prof_post, $data_reserva_post, $obs_post]);

                        if ($insert_reserva->rowCount() <= 0) {
                            echo "<script language='javascript'> window.alert('Erro ao Cadastrar!');</script>";
                        } else {
                            echo "<script language='javascript'>window.alert('Cadastro Realizado com sucesso!');window.location='data_show.php';</script>";
                        }
                    } ?>
                <?php die; } ?>
    <!Visualização / Edição de Reservas>
                <?php if (@$_GET['op'] == 'more') { ?> 
                    <?php if (@$_GET['func'] == 'del') {
                        $id_reserva = @$_GET['reserva'];
                        $deleta_reserva = $crud->delete('reserva', 'WHERE id_reserva = ?')->run([$id_reserva]);
                        if ($deleta_reserva->rowCount() > 0) {
                             echo '<script language="javascript">window.location="data_show.php?area=datashow";</script>';                                
                        }else{
                            echo 'Algum Erro :(';
                        }
                    }?>
                    <?php if (@$_GET['func'] == 'alt') {
                        @$disabled = '';
                    } else {
                        @$disabled = 'disabled';
                    }
                    $id_reserva = $_GET['reserva'];
                    $seleciona_reserva = $crud->select('sv.identificador, sv.id_sala, p.nome_professor, p.id_professor, r.data_reserva, r.obs', 'reserva r', 'INNER JOIN professor p ON p.id_professor = r.id_professor INNER JOIN sala_video sv ON sv.id_sala = r.id_sala WHERE r.id_reserva = ?')->run([$id_reserva]);
                    $valores_reserva = $seleciona_reserva->fetch(PDO::FETCH_ASSOC); 
                    $nome_professor = $valores_reserva['nome_professor'];
                    $nome_sala = $valores_reserva['identificador'];

                    if (@!$_GET['func'] == 'alt') { ?>
                        <center>
                            <a class="a2" href="data_show.php?area=datashow&op=more&reserva=<?php echo $id_reserva; ?>&func=alt">Atualizar</a>
                            <a class="a2" href="data_show.php?area=datashow&op=more&reserva=<?php echo $id_reserva; ?>&func=del">Excluir</a>                
                        </center>
                    <br/><br/>
                    <?php } ?>
                    <form method="POST">
                        <table width="900px"  border="0px" >
                            <tr>
                                <td colspan="2"><center>Atualizar Reserva</center></td>
                            </tr>
                            <tr>
                                <td>Professor</td>
                                <td>Sala</td>
                            </tr>
                            <tr>
                                <td>
                                    <?php if (@$_GET['func'] == 'alt') { ?>
                                    <select name="professor">
                                        <option value="<?php echo $valores_reserva['id_professor'];?>"><?php echo $nome_professor; ?></option>
                                        <?php  $sel_prof = $crud->select('id_professor, nome_professor', 'professor', 'WHERE id_professor IS NOT NULL AND nome_professor <> ? ORDER BY nome_professor')->run([$nome_professor]);
                                        while ($val_prof = $sel_prof->fetch(PDO::FETCH_ASSOC)){
                                            $id_professor = $val_prof['id_professor'];
                                            $nome_professor = $val_prof['nome_professor'];
                                            echo "<option value='$id_professor'>$nome_professor</option>"; 
                                        } ?>
                                    </select>
                                    <?php } else { ?>
                                        <input type="text" <?php echo $disabled;?> value="<?php echo $valores_reserva['nome_professor']; ?>" />
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if (@$_GET['func'] == 'alt') { ?>
                                    <select name="sala">
                                        <option value="<?php echo $valores_reserva['id_sala'];?>"><?php echo $nome_sala;?></option>
                                        <?php $sel_sala = $crud->select('id_sala, identificador', 'sala_video', 'WHERE id_sala IS NOT NULL AND identificador <> ? ORDER BY identificador')->run([$nome_sala]);
                                        while ($val_sala = $sel_sala->fetch(PDO::FETCH_ASSOC)){
                                            $id_sala = $val_sala['id_sala'];
                                            $nome_sala = $val_sala['identificador'];
                                            echo "<option value='$id_sala'>$nome_sala</option>"; 
                                        }?>
                                    </select>
                                    <?php } else { ?>
                                        <input type="text" value="<?php echo $valores_reserva['identificador']; ?>" <?php echo $disabled;?> />
                                    <?php } ?>
                                </td>
                            </tr>                                            
                            <tr>
                                <td>Data</td>
                                <td>Observação</td> 
                            </tr>
                            <tr>
                                <td>
                                    <?php if (@$_GET['func'] == 'alt') { ?>
                                        <input name="data_reserva" type="date" <?php echo $disabled;?> value="<?php echo $valores_reserva['data_reserva']; ?>"/>
                                    <?php } else { ?> 
                                        <input type="date" <?php echo $disabled;?> value="<?php echo $valores_reserva['data_reserva']; ?>"/>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if (@$_GET['func'] == 'alt') { ?>
                                        <textarea name="obs" rows="3" cols="40" maxlength="120" <?php echo $disabled;?> ><?php echo $valores_reserva['obs']; ?></textarea>
                                    <?php } else { ?> 
                                        <textarea name="obs" rows="3" cols="40" maxlength="120" <?php echo $disabled;?> ><?php echo $valores_reserva['obs']; ?></textarea>
                                    <?php } ?>                                                                                
                                </td>
                            </tr>
                            <?php if (@$_GET['func'] == 'alt') { ?>
                                <tr>
                                    <td colspan="2">
                                        <center>
                                            <input class="input" id="button" name="alterar_reserva" value="Concluir" type="submit"/>
                                            <input class="input" id="button" name="cancelar" value="Cancelar" type="submit"/>
                                        </center>
                                    </td>
                                </tr>                                    
                            <?php } else {} ?>                                
                        </table>                                    
                    </form>
                    <?php if (isset($_POST['alterar_reserva'])) {

                        $id_prof_post = $_POST['professor']; 
                        $id_sala_post = $_POST['sala']; 
                        $data_reserva_post = $_POST['data_reserva'];
                        $obs_post = (trim($_POST['obs'])) ?: NULL;

                        if (($valores_reserva['id_professor'] != $id_prof_post) || ($valores_reserva['id_sala'] != $id_sala_post) || ($valores_reserva['data_reserva'] != $data_reserva_post) || ($valores_reserva['obs'] != $obs_post)) {

                            $update_reserva = $crud->update('reserva', 'id_sala = :sala, id_professor = :prof, data_reserva = :dt, obs = :obs', 'WHERE id_reserva = :id')->run([':id' => $id_reserva, ':sala' => $id_sala_post, ':prof' => $id_prof_post, ':dt' => $data_reserva_post, ':obs' => $obs_post]);

                            if ($update_reserva->rowCount() > 0) {                                   
                                echo "<script language='javascript'>window.alert('Reserva atualizada com sucesso!');window.location='data_show.php?area=datashow&op=more&reserva=$id_reserva';</script>";
                            } else {
                                echo "<script language='javascript'>window.alert('Erro Desconhecido!');</script>";
                            }

                        } else {
                            echo "<script language='javascript'>window.alert('Nenhuma modificação foi feita!');window.location='data_show.php?area=datashow&op=more&reserva=$id_reserva';</script>";
                        }
                    } else if (isset ($_POST['cancelar'])) {
                        echo '<script language="javascript">window.location="data_show.php?area=datashow&op=more&reserva='.$id_reserva.'";</script>';
                    } ?>
                <?php die; } ?>
        <!Mostrando Todas as Reservas já cadastradas>
                <a class="a2" href="data_show.php?area=datashow&cadastra=sim">Fazer nova reserva</a>
                <br/><br/>
                <table border="0" width="900" class="bordasimples">
                    <thead>
                        <th><center><i><b>Sala</b></i></center></th>
                        <th><center><i><b>Professor</b></i></center></th>
                        <th><center><i><b>Data da Reserva</b></i></center></th>
                        <th><center><i><b>Obs</b></i></center></th>                    
                    </thead>
                    <?php 
                    $select_todos_reserva = $crud->select('r.id_reserva, sv.identificador, p.nome_professor, r.data_reserva, r.obs', 'reserva r', 'INNER JOIN professor p ON p.id_professor = r.id_professor INNER JOIN sala_video sv ON sv.id_sala = r.id_sala WHERE r.id_sala IS NOT NULL AND r.id_professor IS NOT NULL ORDER BY r.data_reserva, p.nome_professor, sv.identificador')->run();                                                       
                    while ($valores_reserva = $select_todos_reserva->fetch(PDO::FETCH_ASSOC)){
                        $class = @$i % 2 == 0 ? ' class="dif"' : '';
                        $id_reserva = $valores_reserva['id_reserva'];
                        $nome_sala = $valores_reserva['identificador'];
                        $nome_professor = $valores_reserva['nome_professor'];
                        $data_reserva = date('d/m/Y', strtotime($valores_reserva['data_reserva']));
                        $obs = $valores_reserva['obs']; ?>
                        <tr <?php echo $class; ?> onclick="location.href='data_show.php?area=datashow&op=more&reserva=<?php echo $id_reserva;?>'">
                            <td><?php echo $nome_sala;?></td>
                            <td><?php echo $nome_professor;?></td>
                            <td><?php echo $data_reserva;?></td>
                            <td><?php echo substr($obs, 0, 20);?></td>
                        </tr>                                                                        
                    <?php @$i++; } ?>                                              
                </table>
            <?php die; } ?>
    <!Mostrando Proximas reservas até 1 mês>
            <center>
                <a class="a2" href="data_show.php?area=datashow">Reservas</a>
                <a class="a2" href="data_show.php?area=video">Sala de Vídeo</a>
            </center>
            <br/>
            <center><i><b><h1>Proximas Reservas</h1></b></i></center>
            <table border="0px" width = "900px" class="bordasimples">                                
                <thead>
                    <th><center><i><b>Sala</b></i></center></th>
                    <th><center><i><b>Professor</b></i></center></th>
                    <th><center><i><b>Data da Reserva</b></i></center></th>
                    <th><center><i><b>Obs</b></i></center></th>
                </thead>
                <?php
                $proximos_4_sabados = date("Y-m-d",mktime(date("H"),date("i"),date("s"),date("m"),date("d")+28,date("Y")));

                $mostra_todos = $crud->select('r.id_reserva, sv.identificador, p.nome_professor, r.data_reserva, r.obs', 'reserva r', 'INNER JOIN professor p ON p.id_professor = r.id_professor INNER JOIN sala_video sv ON sv.id_sala = r.id_sala WHERE r.id_sala IS NOT NULL AND r.id_professor IS NOT NULL AND r.data_reserva BETWEEN CURRENT_DATE AND ? ORDER BY r.data_reserva, sv.identificador')->run([$proximos_4_sabados]);                                                       
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
	</div>
</body>
</html>