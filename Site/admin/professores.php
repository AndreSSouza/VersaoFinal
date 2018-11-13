<?php require "topo.php"; ?>﻿
﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Professor</title>
        <link rel="stylesheet" type="text/css" href="css/estilo.css" />
        <script>
            function formatar(mascara, documento){
                var i = documento.value.length;
                var saida = mascara.substring(0,1);
                var texto = mascara.substring(i)

                if (texto.substring(0,1) != saida){
                    documento.value += texto.substring(0,1);
                }
            }
        </script>
    </head>
    <body>
        <?php if (@$_GET['pg'] == 'professor') { ?>
            <div id="box_curso">			

                <!VISUALIZAR PROFESSOR ESCOLHIDO>

                <?php if (@$_GET['op'] == 'visualizar') { ?>

                    <?php
                    $cod_professor = $_GET['professor'];
                    $select_professor = $crud->select('*', 'professor', 'WHERE id_professor = ?')->run([$cod_professor]);
                        
                    $prof_val = $select_professor->fetch(PDO::FETCH_ASSOC);

                    $dt_nasc_prof = $prof_val['data_nascimento_professor'];
                    $nome_prof = $prof_val['nome_professor'];
                    $sexo_prof = $prof_val['sexo_professor'];
                    $cpf_prof = $prof_val['cpf'];
                    $rg_prof = $prof_val['rg_professor'];
                    $rua_prof = $prof_val['rua_professor'];
                    $numero_prof = $prof_val['numero_professor'];
                    $bairro_prof = $prof_val['bairro_professor'];
                    $cidade_prof = $prof_val['cidade_professor'];
                    $compl_prof = $prof_val['complemento_professor'];
                    $cep_prof = $prof_val['cep_professor'];
                    $tel_prof = $prof_val['telefone_professor'];
                    $cel_prof = $prof_val['celular_professor'];
                    $email_prof = $prof_val['email'];
                    $formacao_prof = $prof_val['formacao'];
                    ?>

                    <table width="900" border="0">
                        <tr>
                            <td colspan="3">
                                <center><strong><i>Mostrando Informações do(a) Professor(a) <?php echo $nome_prof; ?></i></i></strong></center>
                                </br>
                            </td>
                        </tr>
                        <tr>
                            <td>Código:</td>
                            <td>Nome:</td>
                            <td>Data de Nascimento:</td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" disabled name="cod_professor" id="textfield2" value="<?php echo $cod_professor; ?>">
                            </td>						
                            <td>
                                <input type="text" disabled name="nome_professor" id="textfield2" maxlength="120" value="<?php echo $nome_prof; ?>">
                            </td>
                            <td>
                                <input type="date" disabled name="data_nascimento_professor" id="textfield3" value="<?php
                                $dt_nasc_prof = date('Y-m-d', strtotime($dt_nasc_prof));
                                echo $dt_nasc_prof;
                                ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Sexo:</td>
                            <td>CPF:</td>
                            <td>RG:</td>
                        </tr>
                        <tr>
                            <td>
                                <select disabled name="sexo_professor" size="1" id="">
                                    <option value="<?php echo $sexo_prof; ?>"><?php
                                        $mostra_sexo = strtolower($sexo_prof);
                                        echo ucfirst($mostra_sexo);
                                        ?></option>
                                    <?php if ($sexo_prof == "MASCULINO") { ?>
                                        <option value="FEMININO">Feminino</option>
                                        <option value="OUTRO">Outro</option>
                                    <?php } elseif ($sexo_prof == "FEMININO") { ?>
                                        <option value="MASCULINO">Masculino</option>
                                        <option value="OUTRO">Outro</option>
                                    <?php } else { ?>
                                        <option value="MASCULINO">Masculino</option>
                                        <option value="FEMININO">Feminino</option>
                                    <?php } ?>								
                                </select>							
                            </td>
                            <td>
                                <input type="text" disabled name="cpf_professor" id="textfield4" maxlength="11" value="<?php echo $cpf_prof; ?>">
                            </td>
                            <td>
                                <input type="text" disabled name="rg_professor" id="textfield5" maxlength="14" value="<?php echo $rg_prof; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Rua:</td>
                            <td>Número:</td>
                            <td>Bairro:</td>
                            <td>Cidade:</td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" disabled name="rua_professor" id="textfield6" value="<?php echo $rua_prof; ?>">
                            </td>
                            <td>
                                <input type="text" disabled name="numero_professor" id="textfield6" value="<?php echo $numero_prof; ?>">
                            </td>						
                            <td>
                                <input type="text" disabled name="bairro_professor" id="textfield8" value="<?php echo $bairro_prof; ?>">
                            </td>
                            <td>
                                <input type="text" disabled name="cidade_professor" id="textfield6" value="<?php echo $cidade_prof; ?>">
                            </td>
                        </tr>
                        <tr>		
                            <td>Complemento:</td>
                            <td>CEP:</td>
                            <td>Telefone:</td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" disabled name="complemento_professor" id="textfield7" value="<?php echo $compl_prof; ?>">
                            </td>
                            <td>
                                <input type="text" disabled name="cep_professor" id="textfield8" maxlength="8" value="<?php echo $cep_prof; ?>">
                            </td>
                            <td>
                                <input type="text" disabled name="telefone_professor" id="textfield6" maxlength="10" value="<?php echo $tel_prof; ?>">
                            </td>
                        </tr>
                        <tr>						
                            <td>celular:</td>
                            <td>E-mail:</td>
                            <td>Formação:</td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" disabled name="celular_professor" id="textfield7" maxlength="11" value="<?php echo $cel_prof; ?>">
                            </td>
                            <td>
                                <input type="email" disabled name="email_professor" id="textfield8" value="<?php echo $email_prof; ?>">
                            </td>
                            <td>
                                <input type="text" disabled name="formacao_professor" id="textfield6" value="<?php echo $formacao_prof; ?>">
                            </td>
                        </tr>
                    </table>

                    <br/><br/>

                    <table>					
                        <tr>
                            <td colspan="2"><center><strong><i>Disciplinas Ministradas por este(a) Professor(a)</i></strong></center></td>
                        </tr>						
                        <?php
                        $select_disc_prof = $crud->select('*', 'disciplina_ministrada dm', 'INNER JOIN professor p ON dm.id_professor = p.id_professor INNER JOIN disciplina d on d.id_disciplina = dm.id_disciplina WHERE p.id_professor = ?')->run([$cod_professor]);

                        while ($disc = $select_disc_prof->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <tr>
                                <td>							
                                    <center><?php echo $disc['nome_disciplina']; ?></center>
                                </td>
                                <td>
                                    <center><a href="professores.php?pg=professor&amp;op=deletaMateria&mat=<?php echo $disc['id_disciplina']; ?>&professor=<?php echo $cod_professor; ?>"><img src="img/deletar.ico" width="18" height="18" border="0" title="Remover"> </a></center>									
                                </td>
                            </tr>
                        <?php } ?>					
                        <tr>						
                            <td colspan="2">
                                <center><a href="professores.php?pg=cadastra_disciplinas_ministradas&professor=<?php echo $cod_professor; ?>"><img title="Adicionar Nova" src="img/add.png" width="18" height="18" border="0"></a></center>
                            </td>
                        </tr>
                    </table>
                    <br/><br/>
                    <?php
                    die;
                }
                ?>

                <!>

                <!DELETA MATERIA DO PROFESSOR>

                <?php
                if (@$_GET['op'] == 'deletaMateria') {

                    $cod_materia = $_GET['mat'];
                    $cod_professor = $_GET['professor'];

                    $delete_dm = $crud->delete('disciplina_ministrada', 'WHERE id_professor = ? AND id_disciplina = ?')->run([$cod_professor, $cod_materia]);                   

                    echo "<script language='javascript'>window.location='professores.php?pg=professor&op=visualizar&professor=$cod_professor';</script>";
                }
                ?>

                <!>		

                <!Editando O Professor>

                <?php if (@$_GET['op'] == 'atualizar') { ?>

                    <?php
                    $cod_professor = $_GET['professor'];
                    $select_professor = $crud->select('*', 'professor', 'WHERE id_professor = ?')->run([$cod_professor]);
                    
                    $prof_val = $select_professor->fetch(PDO::FETCH_ASSOC);

                    $dt_nasc_prof = $prof_val['data_nascimento_professor'];
                    $nome_prof = $prof_val['nome_professor'];
                    $sexo_prof = $prof_val['sexo_professor'];
                    $cpf_prof = $prof_val['cpf'];
                    $rg_prof = $prof_val['rg_professor'];
                    $rua_prof = $prof_val['rua_professor'];
                    $numero_prof = $prof_val['numero_professor'];
                    $bairro_prof = $prof_val['bairro_professor'];
                    $cidade_prof = $prof_val['cidade_professor'];
                    $compl_prof = $prof_val['complemento_professor'];
                    $cep_prof = $prof_val['cep_professor'];
                    $tel_prof = $prof_val['telefone_professor'];
                    $cel_prof = $prof_val['celular_professor'];
                    $email_prof = $prof_val['email'];
                    $formacao_prof = $prof_val['formacao'];


                    if (isset($_POST['salvar'])) {

                        $data_nascimento_professor = $_POST['data_nascimento_professor'];
                        $nome_professor = $_POST['nome_professor'];
                        $sexo_professor = $_POST['sexo_professor'];
                        $cpf_professor = $_POST['cpf_professor'];
                        $rg_professor = $_POST['rg_professor'];
                        $rua_professor = $prof_val['rua_professor'];
                        $numero_professor = $prof_val['numero_professor'];
                        $bairro_professor = $_POST['bairro_professor'];
                        $cidade_professor = $_POST['cidade_professor'];
                        $complemento_professor = $_POST['complemento_professor'];
                        $cep_professor = $_POST['cep_professor'];
                        $telefone_professor = $_POST['telefone_professor'];
                        $celular_professor = $_POST['celular_professor'];
                        $email_professor = $_POST['email_professor'];
                        $formacao_professor = $_POST['formacao_professor'];

                        if (($dt_nasc_prof != $data_nascimento_professor) || ($nome_prof != $nome_professor) || ($sexo_prof != $sexo_professor) || ($cpf_prof != $cpf_professor) || ($rg_prof != $rg_professor) || ($logra_prof != $logradouro_professor) || ($bairro_prof != $bairro_professor) || ($cidade_prof != $cidade_professor) || ($compl_prof != $complemento_professor) || ($cep_prof != $cep_professor) || ($tel_prof != $telefone_professor) || ($cel_prof != $celular_professor) || ($email_prof != $email_professor) || ($formacao_prof != $formacao_professor)) {

                            //$cpf_professor = ($cpf_professor) ?: null;	

                            $update_professor = $crud->update('professor', 'data_nascimento_professor = :dt_nasc, nome_professor = :nome, sexo_professor = :sexo, cpf = :cpf, rg_professor = :rg, logradouro_professor = :log, bairro_professor = :bairro, cidade_professor = :cidade, complemento_professor = :comp, cep_professor = :cep, telefone_professor = :tel, celular_professor = :cel, email = :email, formacao = :formacao', 'WHERE id_professor = :id')
                                    ->run([':dt_nasc' => $data_nascimento_professor, ':nome' => $nome_professor, ':sexo' => $sexo_professor, ':cpf' => $cpf_professor, ':rg' => $rg_professor, ':log' => $logradouro_professor, ':bairro' => $bairro_professor, ':cidade' => $cidade_professor, ':comp' => $complemento_professor, ':cep' => $cep_professor, ':tel' => $telefone_professor, ':cel' => $celular_professor, ':email' => $email_professor, ':formacao' => $formacao_professor, ':id' => $cod_professor]);
                            
                            echo "<script language='javascript'> window.alert('Professor(a) atualizado(a) com Sucesso'); window.location='professores.php?pg=professor';</script>";
                        }
                    }
                    ?>

                    <form name="form1" method="post" action="">
                        <table width="900" border="0">
                            <tr>
                                <td colspan="3"><center><strong><i>Atualizar Professor(a)</i></i></strong></center></td>
                            </tr>
                            <tr>
                                <td>Código:</td>
                                <td>Nome:</td>
                                <td>Data de Nascimento:</td>
                            </tr>
                            <tr>
                                <td>						
                                    <input type="text" name="code" id="textfield" disabled="disabled" value="<?php echo $cod_professor; ?>">																
                                </td>
                                <td>
                                    <input type="text" name="nome_professor" id="textfield2" maxlength="120" value="<?php echo $nome_prof; ?>">
                                </td>
                                <td>
                                    <input type="date" name="data_nascimento_professor" id="textfield3" value="<?php
                                    $dt_nasc_prof = date('Y-m-d', strtotime($dt_nasc_prof));
                                    echo $dt_nasc_prof;
                                    ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>Sexo:</td>
                                <td>CPF:</td>
                                <td>RG:</td>
                            </tr>
                            <tr>
                                <td>
                                    <select name="sexo_professor" size="1" id="">
                                        <option value="<?php echo $sexo_prof; ?>"><?php
                                            $mostra_sexo = strtolower($sexo_prof);
                                            echo ucfirst($mostra_sexo);
                                            ?></option>
                                        <?php if ($sexo_prof == "MASCULINO") { ?>
                                            <option value="FEMININO">Feminino</option>
                                            <option value="OUTRO">Outro</option>
                                        <?php } elseif ($sexo_prof == "FEMININO") { ?>
                                            <option value="MASCULINO">Masculino</option>
                                            <option value="OUTRO">Outro</option>
                                        <?php } else { ?>
                                            <option value="MASCULINO">Masculino</option>
                                            <option value="FEMININO">Feminino</option>
                                        <?php } ?>								
                                    </select>							
                                </td>
                                <td>
                                    <input type="text" name="cpf_professor" id="textfield4" maxlength="11" value="<?php echo $cpf_prof; ?>">
                                </td>
                                <td>
                                    <input type="text" name="rg_professor" id="textfield5" maxlength="14" value="<?php echo $rg_prof; ?>">
                                </td>
                            </tr>
                           <tr>
                            <td>Rua:</td>
                            <td>Número:</td>
                            <td>Bairro:</td>
                            <td>Cidade:</td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="rua_professor" id="textfield6" value="<?php echo $rua_prof; ?>">
                            </td>
                            <td>
                                <input type="text" name="numero_professor" id="textfield6" value="<?php echo $numero_prof; ?>">
                            </td>						
                            <td>
                                <input type="text" name="bairro_professor" id="textfield8" value="<?php echo $bairro_prof; ?>">
                            </td>
                            <td>
                                <input type="text" name="cidade_professor" id="textfield6" value="<?php echo $cidade_prof; ?>">
                            </td>
                        </tr>
                            <tr>		
                                <td>Complemento:</td>
                                <td>CEP:</td>
                                <td>Telefone:</td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="complemento_professor" id="textfield7" value="<?php echo $compl_prof; ?>">
                                </td>
                                <td>
                                    <input type="text" name="cep_professor" id="textfield8" maxlength="8" value="<?php echo $cep_prof; ?>">
                                </td>
                                <td>
                                    <input type="text" name="telefone_professor" id="textfield6" maxlength="10" value="<?php echo $tel_prof; ?>">
                                </td>
                            </tr>
                            <tr>						
                                <td>celular:</td>
                                <td>E-mail:</td>
                                <td>Formação:</td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="celular_professor" id="textfield7" maxlength="11" value="<?php echo $cel_prof; ?>">
                                </td>
                                <td>
                                    <input type="email" name="email_professor" id="textfield8" value="<?php echo $email_prof; ?>">
                                </td>
                                <td>
                                    <input type="text" name="formacao_professor" id="textfield6" value="<?php echo $formacao_prof; ?>">
                                </td>
                            </tr>
                            <tr>

                            </tr>
                            <tr>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <center>
                                        <input class="input" type="submit" name="salvar" value="Salvar"/>
                                        <a class="a2" href="professores.php?pg=professor">Cancelar</a>
                                    </center>
                                </td>
                            </tr>
                        </table>
                    </form>
                    <br/><br/>
                    <?php
                    die;
                }
                ?>
                <!>

                <!ATIVAR OU INATIVAR O PROFESSOR>

                <?php
                if (@$_GET['op'] == 'trocaStatus') {

                    $cod_professor = $_GET['professor'];

                    @$val = (@$_GET['func'] == 'ativa') ? 1 : 0;

                    //$muda_status_prof = "UPDATE professor SET status_professor = 0 WHERE id_professor = '$cod_professor' ";

                    $update_troca_status = $crud->update('professor', 'status_professor = ?', 'WHERE id_professor = ?')->run([$val, $cod_professor]);

                    echo "<script language='javascript'> window.alert('Status do(a) Professor(a) foi modificado(a) com sucesso'); window.location='professores.php?pg=professor';</script>";
                }
                ?>			
                <!>

                <a class="a2" title="Cadastrar os professores" href="professores.php?pg=cadastra_professor">Cadastrar Professor</a>

                <!VISUALIZAR OS PROFESSORES CADASTRADOS>

                <h1>Professores</h1>

                <?php
                $select_professor = $crud->select('*', 'professor', 'WHERE nome_professor IS NOT NULL')->run();

                if ($select_professor->rowCount() <= 0) {
                    echo "No momento não existe professores cadastrados!";
                } else {
                    ?>
                    <table width="900" border="0" class="bordasimples">
                        <thead>
                            <tr>
                                <th><strong>Código</strong></th>
                                <th><strong>Nome</strong></th>
                                <th><strong>CPF</strong></th>
                                <th><strong>Email</strong></th>
                                <th><strong>Modificar</strong></th>
                            </tr>
                        </thead>
                        <?php
                        while ($resultado_consulta_select_professor = $select_professor->fetch(PDO::FETCH_ASSOC)) {
                            $class = @$i % 2 == 0 ? ' class="dif"' : '';
                            $cod_professor = $resultado_consulta_select_professor['id_professor'];
                            $nome_professor = $resultado_consulta_select_professor['nome_professor'];
                            $cpf_professor = $resultado_consulta_select_professor['cpf'];
                            $email_professor = $resultado_consulta_select_professor['email'];
                            //$status_professor = $resultado_consulta_select_professor['status_professor'];
                            ?>
                            <tr <?php echo $class; ?>>                                
                                <td><?php echo $cod_professor; ?></td>
                                <td><?php echo $nome_professor; ?></td>							
                                <td><?php echo $cpf_professor; ?></td>
                                <td><?php echo $email_professor; ?></td>
                                <td style="color: #A00C0E">								
                                    <a href="professores.php?pg=professor&amp;op=visualizar&professor=<?php echo $cod_professor; ?>" ><img title="Visualizar o Professor <?php echo $nome_professor; ?>" src="img/lupa_turma.png" width="18" height="18" border="0"/></a>
                                    <a href="professores.php?pg=professor&amp;op=atualizar&professor=<?php echo $cod_professor; ?>"><img title="Atualizar o Professor <?php echo $nome_professor; ?>" src="img/editar.png" width="18" height="18" border="0"/></a>
                                    <?php // if($status_professor == 0){      ?>
                                            <!--<a href="professores.php?pg=professor&amp;op=trocaStatus&func=ativa&professor=<?php echo $cod_professor; ?>"><img title="Ativar o Professor <?php echo $nome_professor; ?>" src="img/success.png" width="18" height="18" border="0"></a> -->
                                    <?php //} else {      ?>
                                    <a href="professores.php?pg=professor&amp;op=trocaStatus&func=inativa&professor=<?php echo $cod_professor; ?>"><img title="Inativar o Professor <?php echo $nome_professor; ?>" src="img/error.png" width="18" height="18" border="0"/></a>						
                                    <?php //}   ?>	
                                </td>                                
                            </tr>
                            <?php
                            @$i++;
                        }
                        ?>
                    </table>
                <?php } ?>
                <br/>
            </div><!-- box_professores -->

        <?php } // aqui é o fechamento da PG professor    ?>

        <!CADASTRO DOS PROFESSORES>

        <?php if (@$_GET['pg'] == 'cadastra_professor') { ?>
            <div id="box_curso">
                <h1>Cadastrar um novo professor</h1>
                <?php
                if (isset($_POST['button'])) {

                    $data_nascimento_professor = $_POST['data_nascimento_professor'];
                    $nome_professor = $_POST['nome_professor'];
                    $sexo_professor = $_POST['sexo_professor'];
                    $cpf_professor = $_POST['cpf_professor'];
                    $rg_professor = $_POST['rg_professor'];
                    $rua_professor = $_POST['rua_professor'];
                    $numero_professor = $_POST['numero_professor'];
                    $bairro_professor = $_POST['bairro_professor'];
                    $cidade_professor = $_POST['cidade_professor'];
                    $complemento_professor = $_POST['complemento_professor'];
                    $cep_professor = $_POST['cep_professor'];
                    $telefone_professor = $_POST['telefone_professor'];
                    $celular_professor = $_POST['celular_professor'];
                    $email_professor = $_POST['email_professor'];
                    $formacao_professor = $_POST['formacao_professor'];

                    $insert_professor = $crud->insert('professor', 'data_nascimento_professor, nome_professor, sexo_professor, cpf, rg_professor, rua_professor, numero_professor, bairro_professor, cidade_professor, complemento_professor, cep_professor, telefone_professor, celular_professor, email, formacao', '(:dt_nasc, :nome, :sexo, :cpf, :rg, :rua, :num, :bairro,  :cidade, :comp, :cep, :tel, :cel, :email, :formacao')->run([':dt_nasc' => $data_nascimento_professor, ':nome' => $nome_professor, ':sexo' => $sexo_professor, ':cpf' => $cpf_professor, ':rg' => $rg_professor, ':rua' => $rua_professor, ':num' => $numero_professor, ':bairro' => $bairro_professor, ':cidade' => $cidade_professor, ':comp' => $complemento_professor, ':cep' => $cep_professor, ':tel' => $telefone_professor, ':cel' => $celular_professor, ':email' => $email_professor, ':formacao' => $formacao_professor]);

                    if ($insert_professor->rowCount() <= 0) {
                        echo "<script language='javascript'>window.alert('Ocorreu um erro ao cadastrar o professor!');</script>";
                    }
                }
                ?>
                <form name="form1" method="post" action="">
                    <table width="900" border="0">
                        <tr>
                            <td>Código:</td>
                            <td>Nome:</td>
                            <td>Data de Nascimento:</td>
                        </tr>
                        <tr>
                            <td>
                                <?php
                                $select_last_id = $crud->select('id_professor', 'professor', 'ORDER BY id_professor DESC LIMIT 1')->run();

                                if ($select_last_id->rowCount() <= 0 ) {
                                    $novo_id_professor = 1; ?>
                                    <input type="text" name="code" id="textfield" disabled="disabled" value="<?php echo $novo_id_professor; ?>">
                                        <input type="hidden" name="code" value="<?php echo $novo_id_professor; ?>" />

                                <?php } else {

                                    while ($resultado_select_professor_ultimo_id = $select_last_id->fetch(PDO::FETCH_ASSOC)) {
                                        $novo_id_professor = $resultado_select_professor_ultimo_id['id_professor'] + 1;
                                        ?>
                                        <input type="text" name="code" id="textfield" disabled="disabled" value="<?php echo $novo_id_professor; ?>">
                                            <input type="hidden" name="code" value="<?php echo $novo_id_professor; ?>" />
                                    <?php }
                                } ?>
                                        </td>
                                        <td>
                                            <input type="text" title="Insira o nome" name="nome_professor" id="textfield2" maxlength="120">
                                        </td>
                                        <td>
                                            <input type="date" title="Selecione a data de nascimento" name="data_nascimento_professor" id="textfield3">
                                        </td>
                                        </tr>
                                        <tr>
                                            <td>Sexo:</td>
                                            <td>CPF:</td>
                                            <td>RG:</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <select name="sexo_professor" title="Selecione o sexo" size="1" id="textfield">
                                                    <option value="MASCULINO">Masculino</option>
                                                    <option value="FEMININO">Feminino</option>
                                                    <option value="OUTRO">Outro</option>
                                                </select>							
                                            </td>
                                            <td>
                                                <input type="text" name="cpf_professor"  title="Insire o CPF" id="textfield4" maxlength="14" OnKeyPress="formatar('###.###.###-##', this)" >
                                            </td>
                                            <td>
                                                <input type="text" name="rg_professor" title="Insire o RG" id="textfield5" maxlength="14">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Rua:</td>
                                            <td>Número:</td>
                                            <td>Bairro:</td>
                                            <td>Cidade:</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" title="Insire a rua" name="rua_professor" id="textfield6">
                                            </td>						
                                            <td>
                                                <input type="text" title="Insire o número" name="numero_professor" id="textfield6">
                                            </td>						
                                            <td>
                                                <input type="text" title="Insire o bairro" name="bairro_professor" id="textfield8">
                                            </td>
                                            <td>
                                                <input type="text" title="Insire a cidade" name="cidade_professor" id="textfield6">
                                            </td>
                                        </tr>
                                        <tr>		
                                            <td>Complemento:</td>
                                            <td>CEP:</td>
                                            <td>Telefone:</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" title="Insire o complemento" name="complemento_professor" id="textfield7">
                                            </td>
                                            <td>
                                                <input type="text" title="Insire o CEP" OnKeyPress="formatar('#####-###', this)" name="cep_professor" id="textfield8" maxlength="9">
                                            </td>
                                            <td>
                                                <input type="text" title="Insire o telefone" name="telefone_professor" id="textfield6" maxlength="12" OnKeyPress="formatar('##-####-####', this)"> 
                                            </td>
                                        </tr>
                                        <tr>						
                                            <td>Celular:</td>
                                            <td>E-mail:</td>
                                            <td>Formação:</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" title="Insire o celular" name="celular_professor" id="textfield7" maxlength="13"  OnKeyPress="formatar('##-#####-####', this)">
                                            </td>
                                            <td>
                                                <input type="email" title="Insire o email" name="email_professor" id="textfield8">
                                            </td>
                                            <td>
                                                <input type="text" title="Insire a formação" name="formacao_professor" id="textfield6">
                                            </td>
                                        </tr>
                                        <tr>

                                        </tr>
                                        <tr>
                                        </tr>
                                        <tr>
                                            <td colspan="3"><input class="input" type="submit" name="button" id="button" title="Cadastre" value="Cadastrar"></td>
                                        </tr>
                                        </table>
                                        </form>
                                        <br/>
                                        </div><!-- fim da div cadastra_professores -->
                                    <?php } // aqui é o fechamento da PG cadastra Professores       ?>

                                    <!MATERIAS>

                                    <?php if (@$_GET['pg'] == 'disciplina') { ?>
                                        <div id="box_curso">

                                            <!VISUALIZAR A MATERIA>

                                            <?php
                                            if (@$_GET['op'] == 'visualizar') {
                                                
                                                $cod_disc = $_GET['disc'];
                                                $select_disc = $crud->select('nome_disciplina', 'disciplina', 'WHERE id_disciplina = ?')->run([$cod_disc]);
                                                
                                                $valor_disc = $select_disc->fetch(PDO::FETCH_ASSOC);
                                                $nome_disc = $valor_disc['nome_disciplina'];
                                                ?>

                                                <table border="0">
                                                    <tr>
                                                        <td colspan="2"><center><strong><i>Mostrando Detalhes da Disciplina -> <?php echo $nome_disc; ?></i></strong></center></td>
                                                    </tr>
                                                    <tr>
                                                        <td><center>Código da Disciplina</center></td>
                                                        <td><center>Nome da Disciplina</center></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="color: #C43739"><center><i><strong><?php echo $cod_disc; ?></strong></i></center></td>
                                                        <td style="color: #C43739"><center><i><strong><?php echo $nome_disc; ?></strong></i></center></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2"><center><strong><i>Professores que Ministram esta Disciplina</i></strong></center></td>
                                                    </tr>
                                                    <?php
                                                    $disc_dis = $crud->select('dm.id_professor, p.nome_professor', 'disciplina_ministrada dm', 'INNER JOIN disciplina d on d.id_disciplina = dm.id_disciplina INNER JOIN professor p ON dm.id_professor = p.id_professor WHERE d.id_disciplina = ?')->run([$cod_disc]);                                                 

                                                    if ($disc_dis->rowCount() > 0) {
                                                        while ($prof_nomes = $disc_dis->fetch(PDO::FETCH_ASSOC)) { ?>

                                                            <tr>
                                                                <td style="color: #000270" colspan="2"><center><i><strong><?php echo $prof_nomes['nome_professor']; ?></strong></i></center></td>
                                                                <td><center><a href="professores.php?pg=professor&amp;op=visualizar&professor=<?php echo $prof_nomes['id_professor']; ?>"><img src="img/lupa_turma.png" title="Ver" width="20px" height="20px"></a></center></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <tr>
                                                            <td colspan='2' style="color: #C01B1E"><center><strong><i>Ainda não há professores ministrando está disciplina</i></strong></center></td>
                                                        </tr>						
                                                    <?php } ?>
                                                </table>						
                                                <br/>
                                                <?php
                                                die;
                                            }
                                            ?>	
                                            <!>			

                                            <!ATUALIZAR A MATERIA>

                                            <?php
                                            if (@$_GET['op'] == 'atualizar') {

                                                $cod_disc = $_GET['disc'];
                                                
                                                $select_disc = $crud->select('nome_disciplina', 'disciplina', 'WHERE id_disciplina = ?')->run([$cod_disc]);              
                                                //$sel_disc = "SELECT * FROM disciplina WHERE id_disciplina = '$cod_disc'";
                                                //$return_disc = mysqli_query($conexao, $sel_disc) or die(mysqli_error($conexao));
                                                //$values_disc = mysqli_fetch_assoc($return_disc);
                                                
                                                $values_disc = $select_disc->fetch(PDO::FETCH_ASSOC);

                                                $nome_disc = $values_disc['nome_disciplina'];

                                                if (isset($_POST['salvar'])) {

                                                    $nome_disc_post = $_POST['nome_disc'];

                                                    if ($nome_disc != $nome_disc_post) {

                                                        $update_disc = $crud->update('disciplina', 'nome_disciplina = ?', 'WHERE id_disciplina = ?')->run([$nome_disc_post, $cod_disc]);
                                                        //$update_disc = "UPDATE disciplina d SET nome_disciplina = '$nome_disc_post' WHERE d.id_disciplina = '$cod_disc'";

                                                        //mysqli_query($conexao, $update_disc) or die(mysqli_error($conexao));

                                                        echo "<script language='javascript'> window.alert('Disciplina atualizada com Sucesso'); window.location='professores.php?pg=disciplina';</script>";
                                                    }
                                                }

                                                if (isset($_POST['cancelar'])) {
                                                    echo "<script language='javascript'>window.location='professores.php?pg=disciplina';</script>";
                                                }
                                                ?>

                                                <br/>

                                                <form method="post">
                                                    <table border="0">
                                                        <tr>
                                                            <td colspan="2"><center><strong><i>Atualizar Disciplina -> <?php echo $nome_disc; ?></i></strong></center></td>							
                                                        </tr>
                                                        <tr>
                                                            <td><center><strong><i>Nome :</i></strong></center></td>						
                                                            <td>
                                                                <input type="text" name="nome_disc" id="textfield" value="<?php echo $nome_disc; ?>">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">
                                                                <center>
                                                                    <input class="input" type="submit" name="salvar" value="Salvar"/>
                                                                    <input class="input" type="submit" name="cancelar" value="Cancelar"/>
                                                                </center>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </form>
                                                <br/>

                                                <?php
                                                die;
                                            }
                                            ?>

                                            <!VISUALIZAR AS MATERIAS CADASTRADAS>
                                            
                                            <a class="a2" href="professores.php?pg=cadastra_materia">Cadastrar Materia</a>

                                            <?php
                                            $select_materia = $crud->select('*', 'disciplina')->run();
                                            //$sql_resultado_consulta_materia = "SELECT * FROM disciplina";
                                            //$resultado_consulta_materia = mysqli_query($conexao, $sql_resultado_consulta_materia) or die(mysqli_error($conexao));

                                            if ($select_materia->rowCount() <= 0) {
                                                echo "<br/><br/>No momento não existe nenhuma matéria cadastrada!<br/><br/>";
                                            } else {
                                                ?>
                                                <br/>
                                                <h1>Matérias</h1>
                                                <table width="900" border="0" class="bordasimples">
                                                    <thead>
                                                        <tr>
                                                            <th><strong>Código da Matéria:</strong></th>
                                                            <th><strong>Nome:</strong></th>
                                                            <th><center><strong>Modificar:</strong></center></th>					
                                                        </tr>
                                                    </thead>
                                                    <?php
                                                    while ($resultado_consulta_materia_valores = $select_materia->fetch(PDO::FETCH_ASSOC)) {
                                                        $class = @$i % 2 == 0 ? ' class="dif"' : '';
                                                        $cod_disc = $resultado_consulta_materia_valores['id_disciplina'];
                                                        $nome_disc = $resultado_consulta_materia_valores['nome_disciplina'];
                                                        ?>
                                                        <tr <?php echo $class; ?>>
                                                            <td><?php echo $cod_disc; ?></td>
                                                            <td><?php echo $nome_disc; ?></td>
                                                            <td>
                                                                <center>
                                                                    <a href="professores.php?pg=disciplina&op=visualizar&disc=<?php echo $cod_disc; ?>" ><img title="Visualizar Turma <?php echo $nome_disc; ?>" src="img/lupa_turma.png" width="18" height="18" border="0"/></a>
                                                                    <a href="professores.php?pg=disciplina&op=atualizar&disc=<?php echo $cod_disc; ?>"><img title="Atualizar Turma <?php echo $nome_disc; ?>" src="img/editar.png" width="18" height="18" border="0"/></a>
                                                                    <a href="professores.php?pg=disciplina&op=deletar&disc=<?php echo $cod_disc; ?>"><img title="Deletar Turma <?php echo $nome_disc; ?>" src="img/deletar.ico" width="18" height="18" border="0"/></a>
                                                                </center>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        @$i++;
                                                    }
                                                    ?>
                                                </table>	 
                                            <?php } ?> 		
                                            <br/>
                                        </div>
                                        <?php
                                        die;
                                    }
                                    ?>


                                    <!DELEÇÃO DA MATERIA>

                                    <?php
                                    if (@$_GET['op'] == 'deletar') {

                                        $cod_disc = $_GET['disc'];
                                        
                                        $delete_dm = $crud->delete('disciplina_ministrada', 'WHERE id_disciplina = ?')->run([$cod_disc]);
                                        $delete_disc = $crud->delete('disciplina', 'WHERE id_disciplina = ?')->run([$cod_disc]);

                                        //$sql_del_dm = "DELETE FROM disciplina_ministrada WHERE id_disciplina = '$cod_disc'";
                                        //$sql_del_d = "DELETE FROM disciplina WHERE id_disciplina = '$cod_disc'";

                                        //mysqli_query($conexao, $sql_del_dm) or die(mysqli_error($conexao));
                                        //mysqli_query($conexao, $sql_del_d) or die(mysqli_error($conexao));
                                    }
                                    ?>	

                                    <!CADASTRO DE MATERIAS>

                                    <?php if (@$_GET['pg'] == 'cadastra_materia') { ?> 
                                        <div id="box_curso">
                                            
                                            <h1>Cadastrar Matéria</h1>

                                            <?php
                                            if (isset($_POST['cadastra_materia'])) {

                                                $nome_materia = $_POST['nome_materia'];
                                                
                                                $insert_mat = $crud->insert('disciplina', 'nome_disciplina', '(?)')->run([$nome_materia]);
                                                //$sql_insert_materia = "INSERT INTO disciplina (nome_disciplina) VALUES ('$nome_materia')";

                                                //$insert_materia = mysqli_query($conexao, $sql_insert_materia) or die(mysqli_error($conexao));

                                                if ($insert_mat->rowCount() <= 0) {
                                                    echo "<script language='javascript'> window.alert('Erro ao Cadastrar!');</script>";
                                                } else {
                                                    echo "<script language='javascript'> window.alert('Cadastro Realizado com sucesso!!');</script>";
                                                    echo "<script language='javascript'>window.location='professores.php?pg=disciplina';</script>";
                                                }
                                            }
                                            ?>

                                            <form name="form1" method="post">
                                                <table width="900" border="0">
                                                    <tr>
                                                        <td width="134">Código da Matéria:</td>
                                                        <td width="134">Nome da Matéria:</td>
                                                    </tr>
                                                    <tr>
                                                        <?php
                                                        $select_last_id_mat = $crud->select('id_disciplina', 'disciplina', 'ORDER BY id_disciplina DESC LIMIT 1')->run();
                                                        //$sql_select_ultimo_cod_materia = "SELECT * FROM disciplina ORDER BY id_disciplina DESC LIMIT 1";

                                                        //$select_ultimo_cod_materia = mysqli_query($conexao, $sql_select_ultimo_cod_materia)or die(mysqli_error($conexao));

                                                        if ($select_last_id_mat->rowCount() <= 0) {
                                                            $novo_cod_materia = 1;
                                                            ?>

                                                            <td>
                                                                <input type="text" name="code" id="textfield" disabled="disabled" value="<?php echo $novo_cod_materia; ?>">
                                                            </td>
                                                            <input type="hidden" name="code" value="<?php echo $novo_cod_materia; ?>"/>

                                                            <?php
                                                        } else {
                                                            while ($values_disc = $select_last_id_mat->fetch(PDO::FETCH_ASSOC)) {
                                                                $novo_cod_materia = $values_disc['id_disciplina'] + 1;
                                                                ?>
                                                                <td>
                                                                    <input type="text" name="code" id="textfield" disabled="disabled" value="<?php echo $novo_cod_materia; ?>">
                                                                </td>
                                                                <input type="hidden" name="code" value="<?php echo $novo_cod_materia; ?>" />
                                                                <?php
                                                            }
                                                        }
                                                        ?>	
                                                        <td>
                                                            <input type="text" name="nome_materia" title="Insira o nome" id="textfield" maxlength="30"/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input class="input" title="Cadastre" type="submit" name="cadastra_materia" id="button" value="Cadastrar"/>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </form> 
                                            <br/>
                                        </div>
                                        <?php
                                        die;
                                    }
                                    ?>

                                    <!PROFESSORES & MATERIAS>

                                    <?php if (@$_GET['pg'] == 'disciplinas_ministradas') { ?>
                                        <div id="box_curso">

                                            <!VISUALIZAR OS PROFESSORES & MATERIAS CADASTRADOS>

                                            <?php
                                            $select_disc_min = $crud->select('*', 'disciplina_ministrada dm', 'INNER JOIN disciplina d ON d.id_disciplina = dm.id_disciplina INNER JOIN professor p ON p.id_professor = dm.id_professor')->run([]);

                                            if ($select_disc_min->rowCount() <= 0) {
                                                echo "<br/><br/>No momento não existe nenhuma matéria cadastrada!<br/><br/>";
                                            } else {
                                                ?>
                                                <h1>Disciplina Ministradas</h1>
                                                <br/>
                                                <table width="900" border="0" class="bordasimples">
                                                    <thead>
                                                        <tr>
                                                            <th><strong>Nome do Professor:</strong></th>
                                                            <th><strong>Nome da Matéria:</strong></th>					
                                                        </tr>
                                                    </thead>
                                                    <?php
                                                    while ($val = $select_disc_min->fetch(PDO::FETCH_ASSOC)) {
                                                        $class = @$i % 2 == 0 ? ' class="dif"' : '';
                                                        ?>
                                                        <tr<?php echo $class; ?>>
                                                            <td><?php echo $val['nome_professor']; ?></td>
                                                            <td><?php echo $val['nome_disciplina']; ?></td>
                                                        </tr>
                                                        <?php
                                                        @$i++;
                                                    }
                                                    ?>
                                                </table>	 

                                            <?php } ?> 		
                                            <br/>
                                        </div>
                                    <?php } ?>

                                    <!CADASTRO DE PROFESSORES & MATERIAS>

                                    <?php  if (@$_GET['pg'] == 'cadastra_disciplinas_ministradas') { ?>			
                                        <div id="box_curso">	
                                            <br/>
                                            <?php
                                            $cod_professor = $_GET['professor'];

                                            $select_nome = $crud->select('nome_professor', 'professor', 'WHERE id_professor = ?')->run([$cod_professor]);
                                            $valores = $select_nome->fetch(PDO::FETCH_ASSOC);
                                            $nome_professor = $valores['nome_professor'];
                                            ?>
                                            <form name="form1" method="post" action="">
                                                <table border="0">
                                                    <tr>
                                                        <td colspan="2"><center><strong><i>Selecione uma Disciplina para o(a) Professor(a) <?php echo $nome_professor; ?> </i></i></strong></center></td>
                                                    </tr>						
                                                    <tr>
                                                        <td colspan="2">
                                                            <center>
                                                                <select name="cod_materia">
                                                                    <?php
                                                                    $select_disc_dif = $crud->select('id_disciplina, nome_disciplina', 'disciplina', 'WHERE nome_disciplina IS NOT NULL ORDER BY nome_disciplina')->run();
                                                                    
                                                                    while ($val_dif = $select_disc_dif->fetch(PDO::FETCH_ASSOC)) {
                                                                        ?>

                                                                        <option value="<?php echo $val_dif['id_disciplina']; ?>">
                                                                            <?php echo $val_dif['nome_disciplina']; ?>
                                                                        </option>
                                                                    <?php } ?>										
                                                                </select>
                                                            </center>
                                                        </td>
                                                        <td align="left">								
                                                            <a href="professores.php?pg=cadastra_materia"><img src="img/add.png" width="20" height="20" title="Adicionar nova Disciplina!"></a>								
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <center>
                                                                <input class="input" type="submit" name="cadastra_professor_materia" id="button" value="Cadastrar">
                                                            </center>
                                                        </td>
                                                        <td>
                                                            <center>
                                                                <input class="input" type="submit" name="cancelar" value="Cancelar">									
                                                            </center>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </form>

                                            <?php
                                            if (isset($_POST['cadastra_professor_materia'])) {
                                                $cod_disciplina = $_POST['cod_materia'];
                                                $verifica = $crud->select('COUNT(*) quantidade_registros, d.nome_disciplina', 'disciplina_ministrada dm', 'INNER JOIN disciplina d ON dm.id_disciplina = d.id_disciplina WHERE dm.id_professor = ? AND dm.id_disciplina = ?' )->run([$cod_professor, $cod_disciplina]);
                                                //$verifica = "SELECT * FROM disciplina_ministrada dm INNER JOIN disciplina d ON dm.id_disciplina = d.id_disciplina WHERE dm.id_professor = '$cod_professor' AND dm.id_disciplina = '$cod_disciplina'";
                                                //$retorno_verifica = mysqli_query($conexao, $verifica)or die(mysqli_error($conexao));

                                                if ($verifica->rowCount() <= 0) {
                                                    
                                                    $insert_dm = $crud->insert('disciplina_ministrada', 'id_professor, id_disciplina', '(?, ?)')->run([$cod_professor, $cod_disciplina]);

                                                    //$sql_insert_dm = "INSERT INTO disciplina_ministrada (id_professor, id_disciplina) VALUES ('$cod_professor', '$cod_disciplina')";

                                                    //$insert_disciplina_ministrada = mysqli_query($conexao, $sql_insert_dm)or die(mysqli_error($conexao));

                                                    if ($insert_dm->rowCount() <= 0) {
                                                        echo "<script language='javascript'> window.alert('Erro ao Cadastrar!');</script>";
                                                    } else {
                                                        echo "<script language='javascript'> window.alert('Cadastro Realizado com sucesso!!');</script>";
                                                        echo "<script language='javascript'>window.location='professores.php?pg=professor&op=visualizar&professor=$cod_professor';</script>";
                                                    }
                                                } else {
                                                    $values = $verifica->fetch(PDO::FETCH_ASSOC);
                                                    $nome_disciplina = $values['nome_disciplina'];
                                                    echo "<script language='javascript'> window.alert('Este Professor(a) já Ministra a Disciplina $nome_disciplina!!');</script>";
                                                }
                                            }

                                            if (isset($_POST['cancelar'])) {
                                                echo "<script language='javascript'>window.location='professores.php?pg=professor&op=visualizar&professor=$cod_professor';</script>";
                                            }
                                            ?>

                                            <br/>
                                        </div>
                                        <?php
                                        die;
                                    }  ?>	


                                    </body>
                                    </html>