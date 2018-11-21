<?php require "topo.php"; ?>﻿
﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Estudantes</title>       
        <link rel="stylesheet" type="text/css" href="css/estilo.css" />
        <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.quicksearch/2.3.1/jquery.quicksearch.js"></script>  
        <script>
            function mostra_nome_aluno(str) {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("mostra_nome_aluno").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "mostraAluno.php?nome=" + str, true);
                xmlhttp.send();
            }
        </script>
    </head>
    <body>	
        <!LISTA DE ESPERA>
        <div id="box_curso">

            <?php if (@$_GET['pg'] == 'espera') { ?>

                <!VISUALIZAR ESPERA>

                <?php if (@$_GET['mod'] == 'visualiza') { ?>

                    <?php
                    $cod_inscricao = $_GET['inscricao'];
                    date_default_timezone_set("America/Sao_Paulo");

                    $select_inscricao = $crud->select('id_inscricao, data_inscricao, nome_aluno, sexo_aluno, email, telefone_contato, celular_contato', 'inscricao', 'WHERE id_inscricao = ?')->run([$cod_inscricao]);

                    $val_select_inscricao = $select_inscricao->fetch(PDO::FETCH_ASSOC);

                    $id_inscricao = $val_select_inscricao['id_inscricao'];
                    $data_inscricao = $val_select_inscricao['data_inscricao'];
                    $nome_inscricao = $val_select_inscricao['nome_aluno'];
                    $sexo_inscricao = $val_select_inscricao['sexo_aluno'];
                    $email_inscricao = $val_select_inscricao['email'];
                    $telefone_inscricao = $val_select_inscricao['telefone_contato'];
                    $celular_inscricao = $val_select_inscricao['celular_contato'];
                    ?>
                    
                    <br/>
                    <table>
                        <tr>
                            <td colspan="2"><center><strong><i>Ficha de Inscrição</i></i></strong></center></td>
                        </tr>
                        <tr>
                            <td>Codígo de Inscrição</td>
                            <td>Data de Inscrição</td>							
                        </tr>
                        <tr>
                            <td><input style="width:70px" type="text" name="cod_inscricao" value="<?php echo $cod_inscricao; ?>" disabled/></td>
                            <td><input style="width:145px" type="text" name="data_inscricao" value="<?php echo date('d/m/Y - H:i:m', strtotime($data_inscricao)); ?>" disabled/></td>
                        </tr>
                        <tr>
                            <td colspan="2"><center><strong><i>Dados Pessoais</i></i></strong></center></td>
                        </tr>
                        <tr>
                            <td>Nome</td>
                            <td>Sexo</td>	
                        </tr>
                        <tr>						
                            <td><input style="width:400px" type="text" name="nome_aluno" value="<?php echo $nome_inscricao; ?>" maxlength="120" disabled/></td>
                            <td><input style="width: 145px" type="text" name="sexo_aluno" value="<?php echo $sexo_inscricao; ?>" disabled/></td>							
                        </tr>					
                        <tr>
                            <td colspan="3"><center><strong><i>Contato</i></i></strong></center></td>
                        </tr>
                        <tr>						
                            <td>E-mail</td>
                            <td>Telefone</td>
                            <td>Celular</td>
                        </tr>
                        <tr>						
                            <td><input style="width:400px" type="email" name="email" value="<?php echo $email_inscricao; ?>" disabled></td>
                            <td><input style="width:95px" type="text" name="telefone" maxlength="10" value="<?php echo $telefone_inscricao; ?> " disabled></td>
                            <td><input style="width:105px" type="text" name="celular" maxlength="11" value="<?php echo $celular_inscricao; ?>" disabled></td>                            
                        </tr>						
                        <tr>                            
                            <td colspan="3" style="padding: 20px 0 5px 0;"><center><a class="a2"  title="Cadastrar aluno" href="estudantes.php?pg=cadastra&etapa=1&inscricao=<?php echo $cod_inscricao;?>">Adicionar para Aluno</a></center></td>
                        </tr>
                    </table>				
                    <br/>				
                    <?php
                    die;
                }
                ?>		
                <!>

                <!Editando na Lista de Espera>
                <?php if (@$_GET['mod'] == 'edita') { ?>

                    <?php
                    $cod_inscricao = $_GET['inscricao'];

                    $select_inscricao = $crud->select('id_inscricao, data_inscricao, nome_aluno, sexo_aluno, email, telefone_contato, celular_contato', 'inscricao', 'WHERE id_inscricao = ?')->run([$cod_inscricao]);

                    $val_select_inscricao = $select_inscricao->fetch(PDO::FETCH_ASSOC);

                    $id_inscricao = $val_select_inscricao['id_inscricao'];
                    $data_inscricao = $val_select_inscricao['data_inscricao'];
                    $nome_inscricao = $val_select_inscricao['nome_aluno'];
                    $sexo_inscricao = $val_select_inscricao['sexo_aluno'];
                    $email_inscricao = $val_select_inscricao['email'];
                    $telefone_inscricao = $val_select_inscricao['telefone_contato'];
                    $celular_inscricao = $val_select_inscricao['celular_contato'];
                    ?>

                    <?php
                    if (isset($_POST['salvar'])) {

                        $nome_post = $_POST['nome_aluno'];
                        $sexo_post = $_POST['sexo'];
                        $email_post = (trim($_POST['email'])) ?: NULL;
                        $telefone_post = (trim($_POST['telefone'])) ?: NULL;
                        $celular_post = (trim($_POST['celular'])) ?: NULL;

                        $update_inscricao = $crud->update('inscricao', 'nome_aluno = :nome, sexo_aluno = :sexo, email = :email, telefone_contato = :telefone, celular_contato = :celular', 'WHERE id_inscricao = :id_inscricao')->run([':nome' => $nome_post, ':sexo' => $sexo_post, ':email' => $email_post, ':telefone' => $telefone_post, ':celular' => $celular_post, ':id_inscricao' => $id_inscricao]);

                        echo "<script language='javascript'> window.alert('Atualizado com Sucesso'); window.location='estudantes.php?pg=espera';</script>";
                    }
                    ?>
                    <br/>
                    <form method="post">					
                        <table>
                            <tr>
                                <td colspan="2"><center><strong><i>Ficha de Inscrição</i></i></strong></center></td>
                            </tr>
                            <tr>
                                <td>Codígo de Inscrição</td>
                                <td>Data de Inscrição</td>							
                            </tr>
                            <tr>
                                <td><input style="width:70px" type="text" name="cod_inscricao" value="<?php echo $cod_inscricao; ?>" disabled/></td>
                                <td><input style="width:145px" type="text" name="data_inscricao" value="<?php
                                    date_default_timezone_set("America/Sao_Paulo");
                                    echo date('d/m/Y - H:i', strtotime($data_inscricao));
                                    ?>" disabled/></td>							
                            </tr>
                            <tr>
                                <td colspan="2"><center><strong><i>Dados Pessoais</i></i></strong></center></td>
                            </tr>
                            <tr>
                                <td>Nome</td>
                                <td>Sexo</td>	
                            </tr>
                            <tr>						
                                <td><input style="width:400px" type="text" name="nome_aluno" value="<?php echo $nome_inscricao; ?>" maxlength="120"/></td>
                                <td>
                                    <select name="sexo" size="1" id="">
                                        <option value="<?php echo $sexo_inscricao; ?>"><?php
                                            $mostra_sexo = strtolower($sexo_inscricao);
                                            echo ucfirst($mostra_sexo);
                                            ?></option>
                                        <?php if ($sexo_inscricao == "MASCULINO") { ?>
                                            <option value="FEMININO">Feminino</option>
                                            <option value="OUTRO">Outro</option>
                                        <?php } elseif ($sexo_inscricao == "FEMININO") { ?>
                                            <option value="MASCULINO">Masculino</option>
                                            <option value="OUTRO">Outro</option>
                                        <?php } else { ?>
                                            <option value="MASCULINO">Masculino</option>
                                            <option value="FEMININO">Feminino</option>
                                        <?php } ?>								
                                    </select>
                                </td>
                            </tr>					
                            <tr>
                                <td colspan="3"><center><strong><i>Contato</i></i></strong></center></td>
                            </tr>
                            <tr>						
                                <td>E-mail (opcional)</td>
                                <td>Telefone (opcional)</td>
                                <td>Celular (opcional)</td>
                            </tr>
                            <tr>						
                                <td><input style="width:400px" type="email" name="email" value="<?php echo $email_inscricao; ?>"></td>
                                <td><input style="width:95px" type="text" name="telefone" maxlength="10" value="<?php echo $telefone_inscricao; ?>"></td>
                                <td><input style="width:105px" type="text" name="celular" maxlength="11" value="<?php echo $celular_inscricao; ?>"></td>
                            </tr>
                            <tr>
                                <td colspan="3"><center><input class="input" type="submit" name="salvar" value="Salvar"/> <a class="a2" href="estudantes.php?pg=espera">Cancelar</a></center></td>
                            </tr>
                        </table>
                    </form>
                    <br/>

                    <?php
                    die;
                }
                ?>

                <!CADASTRANDO NA LISTA DE ESPERA>

                <?php if (@$_GET['cadastra'] == 'sim') { ?> 

                    <h1>Cadastrar Aluno para Lista de Espera</h1>

                    <?php
                    if (isset($_POST['button'])) {

                        date_default_timezone_set("America/Sao_Paulo");
                        $data_hora_formato_mysql = date("Y-m-d H:i:s");

                        $nome_inscricao = $_POST['nome'];
                        $sexo = $_POST['sexo'];
                        $email = (trim($_POST['email'])) ?: NULL;
                        $telefone = (trim($_POST['telefone'])) ?: NULL;
                        $celular = (trim($_POST['celular'])) ?: NULL;

                        if (empty($nome_inscricao)) {
                            echo "<script language='javascript'>window.alert('Digite o nome do aluno');</script>";
                        } else {
                            $insert_inscricao = $crud->insert('inscricao', 'data_inscricao, nome_aluno, sexo_aluno, email, telefone_contato, celular_contato', '(:data, :nome, :sexo, :email, :telefone, :celular)')->run([':data' => $data_hora_formato_mysql, ':nome' => $nome_inscricao, ':sexo' => $sexo, ':email' => $email, ':telefone' => $telefone, ':celular' => $celular]);

                            if ($insert_inscricao->rowCount() <= 0) {
                                echo "<script language='javascript'> window.alert('Erro ao Cadastrar!');</script>";
                            } else {
                                echo "<script language='javascript'> window.alert('Cadastro Realizado com sucesso!!');</script>";
                                echo "<script language='javascript'>window.location='estudantes.php?pg=espera';</script>";
                            }
                        }
                    }
                    ?> 

                    <form name="form1" method="post" action="">
                        <table width="900" border="0">
                            <tr>
                                <td>Código de inscrição:</td>					
                                <td>Nome:</td>
                                <td>Sexo:</td>
                            </tr>
                            <tr>
                                <?php
                                $select_last_id = $crud->select('id_inscricao', 'inscricao', 'ORDER BY id_inscricao DESC LIMIT 1')->run();

                                if ($select_last_id->rowCount() <= 0) {
                                    $novo_cod_inscricao = 1;
                                    ?>

                                    <td><input type="text" name="code" id="textfield" disabled="disabled" value="<?php echo $novo_cod_inscricao; ?>" /></td>
                                    <input type="hidden" name="code" value="<?php echo $novo_cod_inscricao; ?>" />


                                    <?php
                                } else {
                                    while ($val_last_id = $select_last_id->fetch(PDO::FETCH_ASSOC)) {
                                        $novo_cod_inscricao = $val_last_id['id_inscricao'] + 1;
                                        ?>
                                        <td><input type="text" name="code" id="textfield" disabled="disabled" value="<?php echo $novo_cod_inscricao; ?>" /></td>
                                        <input type="hidden" name="code" value="<?php echo $novo_cod_inscricao; ?>" />
                                        <?php
                                    }
                                }
                                ?>							
                                <td>
                                    <input type="text" name="nome" title="Insira o nome" id="textfield"/>
                                </td>
                                <td>
                                    <select title="Selecione o sexo" name="sexo" size="1" id="textfield">
                                        <option value="MASCULINO">Masculino</option>
                                        <option value="FEMININO">Feminino</option>
                                        <option value="OUTRO">Outro</option>
                                    </select>
                                </td>      						
                            </tr>
                            <tr>
                                <td>E-mail (opcional)</td>
                                <td>Telefone (opcional)</td>
                                <td>Celular (opcional)</td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="email" title="Insira o email" name="email" id="textfield"/>
                                </td>
                                <td>
                                    <input type="text" title="Insira o telefone" name="telefone" id="textfield" maxlength="10"/>
                                </td>
                                <td>
                                    <input type="text" title="Insira o celular" name="celular" id="textfield" maxlength="11"/>
                                </td>
                            </tr>    
                            <tr>
                                <td>
                                    <input class="input" title="Cadastrar" type="submit" name="button" id="button" value="Cadastrar"/>
                                </td>                                
                            </tr>
                        </table>
                    </form>
                    <br/>
                    <?php
                    die;
                }
                ?>                

                <!CONSULTA DA LISTA DE ESPERA>
                    
                <table class="buttons_cadastra">
                    <tr>
                        <td><a class="a2" title="Cadastrar alunos na lista de espera" href="estudantes.php?pg=espera&amp;cadastra=sim">Cadastrar na lista de espera</a></td>
                        <td style="text-align: right; padding-right: 5px; color: #FFF;">Buscar:</td>
                        <td style="width: 240px;"><input id="busca_inscricao" placeholder="nome, código, telefone, celular ou email" type="text" style="border-radius: 8px; border: none;" /></td>
                    </tr>
                </table>
                
                <?php $select_inscricao = $crud->select('id_inscricao, data_inscricao, nome_aluno, email, telefone_contato, celular_contato', 'inscricao', 'WHERE nome_aluno IS NOT NULL AND inscrito = 0 ORDER BY data_inscricao ASC')->run();

                if ($select_inscricao->rowCount() <= 0) {
                    echo "<h2>Não exisite nenhuma inscrição no momento</h2>";
                } else { ?>                    
                    <h1>Alunos que estão na lista de espera</h1>
                    <br/>                    
                    <table width="900" border="0" id="tabela" class="bordasimples">
                        <thead>
                            <tr>
                                <th>Posição</th>
                                <th width="100">
                                    <center><strong>Código de Inscrição</strong></center>
                                </th>
                                <th width="100">
                                    <center><strong>Data de Inscrição</strong></center>
                                </th>							
                                <th>
                                    <center><strong>Nome Completo</strong></center>
                                </th>							
                                <th>
                                    <center><strong>E-mail</strong></center>
                                </th>
                                <th>
                                    <center><strong>Telefone</strong></center>
                                </th>	
                                <th>
                                    <center><strong>Celular</strong></center>
                                </th>
                                <th>
                                    <center><strong>Modificar</strong></center>                                    
                                </th>
                            </tr>
                        </thead>
                        <?php 
                        $pos = 1;
                        while ($val_select_inscricao = $select_inscricao->fetch(PDO::FETCH_ASSOC)) {

                            $class = @$i % 2 == 0 ? ' class="dif"' : '';

                            $id_inscricao = $val_select_inscricao['id_inscricao'];
                            $data_inscricao = $val_select_inscricao['data_inscricao'];
                            $nome_inscricao = $val_select_inscricao['nome_aluno'];
                            $email_inscricao = $val_select_inscricao['email'];
                            $telefone_inscricao = $val_select_inscricao['telefone_contato'];
                            $celular_inscricao = $val_select_inscricao['celular_contato']; ?>
                        
                            <tbody>
                                <tr <?php echo $class; ?> onclick="location.href = 'estudantes.php?pg=espera&amp;mod=visualiza&inscricao=<?php echo $id_inscricao; ?>'" style="cursor: pointer;" title="Clique aqui para mais informações">
                                    <th><center><?php echo @$pos.'º'; ?></center></th>
                                    <td> 
                                        <center><?php echo $id_inscricao; ?></center>
                                    </td>
                                    <td>
                                        <center><?php echo date("d/m/Y h:i:s", strtotime($data_inscricao)); ?></center>
                                    </td>							
                                    <td>
                                        <center><?php echo $nome_inscricao; ?></center>
                                    </td>							
                                    <td>
                                        <center><?php echo $email_inscricao; ?></center>
                                    </td>
                                    <td>
                                        <center><?php echo $telefone_inscricao; ?></center>
                                    </td>
                                    <td>
                                        <center><?php echo $celular_inscricao; ?></center>
                                    </td>
                                    <th>
                                        <center>                                        
                                            <a href="estudantes.php?pg=espera&amp;mod=edita&inscricao=<?php echo $id_inscricao; ?>"><img title="Atualizar" src="img/editar.png" width="18" height="18" /></a>
                                            <a href="estudantes.php?pg=espera&amp;mod=deleta&inscricao=<?php echo $id_inscricao; ?>"><img title="Deletar" src="img/deletar.ico" width="18" height="18" /></a>
                                        </center>								
                                    </th>
                                </tr>
                            </tbody>
                        <?php @$i++; @$pos++; } ?>
                    </table>
                    <script>
                        $('input#busca_inscricao').quicksearch('table#tabela tbody tr', {'selector': 'td' } );
                    </script>
                    <br/> 
                <?php } ?>
                    
                <!Deletar Inscricao>   

                <?php
                if (@$_GET['mod'] == 'deleta') {

                    $cod_inscricao = $_GET['inscricao'];

                    $delete_incricao = $crud->delete('inscricao', 'WHERE id_inscricao = ?')->run([$cod_inscricao]);
                    echo "<script language='javascript'>window.location='estudantes.php?pg=espera';</script>";
                }
                ?>

            <?php } ?>

            <!Visualizar Alunos>

            <?php
            if (@$_GET['mod'] == 'visualiza') {

                $cod_aluno = $_GET['aluno'];

                $select_tudo_aluno = $crud->select('a.id_aluno cod_aluno, i.id_inscricao cod_inscricao, i.data_inscricao dt_inscricao, i.nome_aluno nome, a.data_nascimento_aluno data_nascimento, i.sexo_aluno sexo_aluno, a.rg_aluno rg_aluno, a.cpf cpf_aluno, i.email email_aluno, i.telefone_contato telefone_contato, i.celular_contato celular_contato, r.email email_responsavel, r.id_responsavel cod_responsavel, r.nome_responsavel nome_responsavel, r.data_nascimento_responsavel, r.sexo_responsavel sexo_responsavel, r.rg_responsavel rg_responsavel, r.cpf cpf_responsavel, a.rua_aluno rua_aluno, a.numero_aluno numero_aluno, a.bairro_aluno bairro_aluno, a.cidade_aluno cidade_aluno, a.complemento_aluno complemento_aluno, a.cep_aluno cep_aluno, a.escola escola_aluno, a.escolaridade escolaridade_aluno, a.matriculado matriculado, a.data_matricula dt_matricula, t.nome_turma nome_turma, a.id_turma id_turma', 'inscricao i', 'INNER JOIN aluno a ON i.id_inscricao = a.id_aluno'
                                . ' INNER JOIN responsavel r ON a.id_responsavel = r.id_responsavel'
                                . ' INNER JOIN turma t ON a.id_turma = t.id_turma'
                                . ' WHERE a.id_aluno = :id_aluno')
                        ->run([':id_aluno' => $cod_aluno]);
                $dados = $select_tudo_aluno->fetch(PDO::FETCH_ASSOC);
                $cod_inscricao = $dados['cod_inscricao'];
                $dt_inscricao = $dados['dt_inscricao'];
                $cod_aluno = $dados['cod_aluno'];
                $nome_A = $dados['nome'];
                $sexo_A = $dados['sexo_aluno'];
                $data_nascimento_A = $dados['data_nascimento'];
                $data_nascimento_A = date('d/m/Y', strtotime($data_nascimento_A));

                //Descorindo a Idade atraves da data de nascimento
                
                list($dia, $mes, $ano) = explode('/', $data_nascimento_A);
                $dt_hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
                $dt_nascimento_aluno = mktime(0, 0, 0, $mes, $dia, $ano);
                $idade_A = floor((((($dt_hoje - $dt_nascimento_aluno) / 60) / 60) / 24) / 365.25);
                                
                $dt_nascimento_R = $dados['data_nascimento_responsavel'];
                $dt_nascimento_R = date('d/m/Y', strtotime($dt_nascimento_R));

                list($dia, $mes, $ano) = explode('/', $dt_nascimento_R);
                $dt_nascimento_responsavel = mktime(0, 0, 0, $mes, $dia, $ano);
                $idade_R = floor((((($dt_hoje - $dt_nascimento_responsavel) / 60) / 60) / 24) / 365.25);

                $RG_A = $dados['rg_aluno'];
                $CPF_A = $dados['cpf_aluno'];
                $email_A = $dados['email_aluno'];
                $email_R = $dados['email_responsavel'];
                $telefone_R = $dados['telefone_contato'];
                $celular_R = $dados['celular_contato'];
                $cod_responsavel = $dados['cod_responsavel'];
                $nome_R = $dados['nome_responsavel'];
                $sexo_R = $dados['sexo_responsavel'];
                $rg_R = $dados['rg_responsavel'];
                $cpf_R = $dados['cpf_responsavel'];
                $rua_A = $dados['rua_aluno'];
                $numero_A = $dados['numero_aluno'];
                $bairro_A = $dados['bairro_aluno'];
                $cidade_A = $dados['cidade_aluno'];
                $complemento_A = $dados['complemento_aluno'];
                $cep_A = $dados['cep_aluno'];
                $escola_A = $dados['escola_aluno'];
                $escolaridade_A = $dados['escolaridade_aluno'];
                //tudo pelo visualização :)
                $escolaridade_A = str_replace('_', ' ', $escolaridade_A);
                $escolaridade_A = str_replace('ed', 'éd', $escolaridade_A);
                $escolaridade_A = str_replace('id', 'íd', $escolaridade_A);
                
                $matriculado = $dados['matriculado'];
                $dt_matricula = $dados['dt_matricula'];
                $dt_matricula = date("d/m/Y", strtotime($dt_matricula));
                $nome_turma = $dados['nome_turma'];
                $cod_turma = $dados['id_turma'];

                //relacionado a chamada
                $qtde_faltas = $crud->select('COUNT(presenca) AS faltas', 'chamada', 'WHERE id_aluno = ? AND presenca = 0')->run([$cod_aluno]);
                $val_faltas = $qtde_faltas->fetch(PDO::FETCH_ASSOC);
                $faltas = $val_faltas['faltas'];
                
                $justificadas = $crud->select('COUNT(justificada) AS justificada', 'chamada', 'WHERE id_aluno = ? AND justificada = 1')->run([$cod_aluno]);
                $val_justificadas = $justificadas->fetch(PDO::FETCH_ASSOC);
                $justificada = $val_justificadas['justificada'];

                //quantidade de aulas já dadas
                $select_qtde_aulas = $crud->select('COUNT(DISTINCT(c.data_chamada)) AS aulas_dadas', 'chamada c', 'INNER JOIN aluno a ON a.id_aluno = c.id_aluno WHERE (c.data_chamada BETWEEN a.data_matricula AND CURRENT_DATE) AND c.id_aluno = ?')->run([$cod_aluno]);
                $val_aulas_dadas = $select_qtde_aulas->fetch(PDO::FETCH_ASSOC);
                $qtde_aulas = $val_aulas_dadas['aulas_dadas'];

                $chamada = $crud->select('c.data_chamada data_chamada, t.nome_turma nome_turma, p.nome_professor nome_professor, i.nome_aluno nome_aluno, c.presenca presenca, c.justificada justificada', 'inscricao i', 'INNER JOIN aluno a ON i.id_inscricao = a.id_aluno INNER JOIN turma t ON a.id_turma = t.id_turma INNER JOIN chamada c ON c.id_aluno = a.id_aluno INNER JOIN professor p ON p.id_professor = c.id_professor WHERE (c.data_chamada BETWEEN a.data_matricula AND CURRENT_DATE) AND a.id_aluno = :id_aluno AND a.id_turma = :id_turma ORDER BY c.data_chamada')->run([':id_aluno' => $cod_aluno, ':id_turma' => $cod_turma]); ?>

                <table border="0">
                    <tr>
                        <td colspan="3">
                            <br>
                            <i><center><b>Informações Pessoais do Aluno</b></center></i>
                            <br>
                        </td>
                    </tr>
                    <tr>
                        <td>Código do Aluno:</td>
                        <td>Data de Inscrição:</td>
                        <td>Código do Aluno:</td>								
                    </tr>
                    <tr>
                        <td>
                            <input type="text" value="<?php echo $cod_inscricao; ?>" disabled >
                        </td>
                        <td>
                            <input type="text" value="<?php echo $dt_inscricao = date('d/m/Y', strtotime($dt_inscricao)); ?>" disabled >
                        </td>
                        <td>
                            <input type="text" value="<?php echo $cod_aluno; ?>" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td>Nome:</td>
                        <td>Sexo:</td>
                        <td>Data de Nascimento:</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" value="<?php echo $nome_A; ?>" disabled>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $sexo_A; ?>" disabled>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $data_nascimento_A; ?>" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td>Idade:</td>
                        <td>RG:</td>
                        <td>CPF:</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" value="<?php echo $idade_A; ?>" disabled>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $RG_A; ?>" disabled>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $CPF_A; ?>" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <br>
                            <i><center><b>Informações Pessoais do Responsável</b></center></i>
                            <br>
                        </td>
                    </tr>
                    <tr>
                        <td>Código do Responsavel:</td>
                        <td>Nome:</td>
                        <td>Data de Nascimento:</td>
                        <td>Sexo:</td>
                    </tr>
                    <tr>
                        <td>
                            <input style="width: 25px" type="text" value="<?php echo $cod_responsavel; ?>" disabled >
                        </td>
                        <td>
                            <input type="text" value="<?php echo $nome_R; ?>" disabled >
                        </td>
                        <td>
                            <input type="text" value="<?php echo $dt_nascimento_R; ?>" disabled>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $sexo_R; ?>" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td>Idade:</td>
                        <td>RG:</td>
                        <td>CPF:</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" value="<?php echo $idade_R; ?>" disabled >
                        </td>
                        <td>
                            <input type="text" value="<?php echo $rg_R; ?>" disabled >
                        </td>
                        <td>
                            <input type="text" value="<?php echo $cpf_R; ?>" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <br>
                            <i><center><b>Contatos</b></center></i>
                            <br>
                        </td>
                    </tr>
                    <tr>
                        <td>E-mail do Aluno:</td>
                        <td>E-mail do Responsavel:</td>
                        <td>Telefone para Contato:</td>
                        <td>Celular para Contato:</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" value="<?php echo $email_A; ?>" disabled >
                        </td>
                        <td>
                            <input type="text" value="<?php echo $email_R; ?>" disabled >
                        </td>
                        <td>
                            <input style="width: 110px" type="text" value="<?php echo $telefone_R; ?>" disabled >
                        </td>
                        <td>
                            <input style="width: 120px" type="text" value="<?php echo $celular_R; ?>" disabled>
                        </td>
                    </tr>	
                    <tr>
                        <td colspan="3">
                            <br>
                            <i><center><b>Endereço</b></center></i>
                            <br>
                        </td>
                    </tr>
                    <tr>
                        <td>Rua:</td>
                        <td>Número:</td>
                        <td>Bairro:</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" value="<?php echo $rua_A; ?>" disabled >
                        </td>
                        <td>
                            <input type="text" value="<?php echo $numero_A; ?>" disabled >
                        </td>
                        <td>
                            <input type="text" value="<?php echo $bairro_A; ?>" disabled >
                        </td>
                    </tr>
                    <tr>
                        <td>Cidade:</td>	
                        <td>Complemento:</td>
                        <td>CEP:</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" value="<?php echo $cidade_A; ?>" disabled >
                        </td>
                        <td>
                            <input type="text" value="<?php echo $complemento_A; ?>" disabled >
                        </td>
                        <td>
                            <input type="text" value="<?php echo $cep_A; ?>" disabled >
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <br>
                            <i><center><b>Informações adicionais</b></center></i>
                            <br>
                        </td>
                    </tr>
                    <tr>
                        <td>Escolaridade:</td>
                        <td>Escola:</td>
                        <td>Matriculado:</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" value="<?php echo $escolaridade_A; ?>" disabled >
                        </td>
                        <td>
                            <input type="text" value="<?php echo $escola_A; ?>" disabled >
                        </td>
                        <td>
                            <input type="text" value="<?php echo $matriculado = $matriculado ? "Sim" : "Não"; ?>" disabled >
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <br>
                            <i><center><b>Matrícula</b></center></i>
                            <br>
                        </td>
                    </tr>
                    <tr>
                        <td>Data de matricula:</td>
                        <td>Turma:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" value="<?php echo $dt_matricula; ?>" disabled >
                        </td>
                        <td>
                            <input type="text" value="<?php echo $nome_turma; ?>" disabled >
                        </td>
                        <td><a class="a2" title="Trocar turma do aluno" href="estudantes.php?pg=aluno&trocar_turma=sim&aluno=<?php echo $cod_inscricao; ?>&turma=<?php echo $cod_turma; ?>">Trocar Turma</a></td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <br/>
                            <i><center><b>Chamada</b></center></i>
                            <br/>
                        </td>
                    </tr>
                    <tr>
                        <td>Quantidade de aulas dadas:</td>
                        <td>Quantidade de faltas:</td>
                        <td>Faltas justificadas:</td>
                        <td width="auto"></td>
                    </tr>
                    <tr>
                        <td>			
                            <input type="text" value="<?php echo $qtde_aulas; ?>" disabled/>
                        </td>
                        <td>			
                            <input type="text" value="<?php echo $faltas; ?>" disabled />
                        </td>
                        <td>			
                            <input type="text" value="<?php echo $justificada; ?>" disabled />
                        </td>
                        <td>
                            <a class="a2" style="width: 150px; margin-left: 10px;" title="Justificar Falta do aluno <?php echo $nome_A;?>" href="estudantes.php?pg=aluno&justificar=sim&aluno=<?php echo $cod_inscricao; ?>">Justificar Falta</a>                            
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <br/>
                            <i><center><b>Histórico de presenças</b></center></i>
                            <br/>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Data da chamada</b></td>
                        <td><b>Nome da turma</b></td>
                        <td><b>Nome do professor</b></td>
                        <td><b>Nome do aluno</b></td>
                        <td><b>Status</b></td>
                    </tr>
                    <?php
                    while ($val_chamada = $chamada->fetch(PDO::FETCH_ASSOC)) {
                        $data_chamada = $val_chamada['data_chamada'];
                        $data_chamada = date("d/m/Y", strtotime($data_chamada));
                        $nomeTurma = $val_chamada['nome_turma'];
                        $nomeProfessor = $val_chamada['nome_professor'];
                        $nomeAluno = $val_chamada['nome_aluno'];
                        
                        $falta_justificada = $val_chamada['justificada'];
                        $status = $val_chamada['presenca'];
                        if ($status) {
                            $cor = 'lightgreen';
                            $mostra_status = 'Presença';
                        } else {
                            if ($falta_justificada) {
                                $cor = 'mediumslateblue';
                                $mostra_status = 'Justificada';
                            } else {
                                $cor = 'tomato';
                                $mostra_status = 'Falta';
                            }
                        } ?>
                        <tr style="background-color: <?php echo $cor; ?>">
                            <td><?php echo $data_chamada; ?></td>
                            <td><?php echo $nomeTurma; ?></td>
                            <td><?php echo $nomeProfessor; ?></td>
                            <td><?php echo $nomeAluno; ?></td>
                            <td><?php echo $mostra_status; ?></td>
                        </tr>
                    <?php } ?>
                </table>
            <?php die; } ?>
            <!>
                                                                                                                                                            
            <!Editar Alunos>
            
            <?php 
            if (@$_GET['mod'] == 'atualiza') {

                $cod_aluno = $_GET['aluno'];
                
                $select_tudo_aluno = $crud->select('a.id_aluno cod_aluno, i.id_inscricao cod_inscricao, i.data_inscricao dt_inscricao, i.nome_aluno nome, a.data_nascimento_aluno data_nascimento, i.sexo_aluno sexo_aluno, a.rg_aluno rg_aluno, a.cpf cpf_aluno, i.email email_aluno, i.telefone_contato telefone_contato, i.celular_contato celular_contato, r.email email_responsavel, r.id_responsavel cod_responsavel, r.nome_responsavel nome_responsavel, r.data_nascimento_responsavel, r.sexo_responsavel sexo_responsavel, r.rg_responsavel rg_responsavel, r.cpf cpf_responsavel, a.rua_aluno rua_aluno, a.numero_aluno numero_aluno, a.bairro_aluno bairro_aluno, a.cidade_aluno cidade_aluno, a.complemento_aluno complemento_aluno, a.cep_aluno cep_aluno, a.escola escola_aluno, a.escolaridade escolaridade_aluno, a.matriculado matriculado, a.data_matricula dt_matricula, t.nome_turma nome_turma, a.id_turma id_turma', 'inscricao i', 'INNER JOIN aluno a ON i.id_inscricao = a.id_aluno INNER JOIN responsavel r ON a.id_responsavel = r.id_responsavel INNER JOIN turma t ON a.id_turma = t.id_turma WHERE a.id_aluno = ?')->run([$cod_aluno]);
                
                $dados = $select_tudo_aluno->fetch(PDO::FETCH_ASSOC);
                
                $cod_inscricao = $dados['cod_inscricao'];
                $dt_inscricao = $dados['dt_inscricao'];
                $cod_aluno = $dados['cod_aluno'];
                $nome_A = $dados['nome'];
                $sexo_A = $dados['sexo_aluno'];
                $data_nascimento_A = $dados['data_nascimento'];
                $dt_nascimento_R = $dados['data_nascimento_responsavel'];
                $RG_A = $dados['rg_aluno'];
                $CPF_A = $dados['cpf_aluno'];
                $email_A = $dados['email_aluno'];
                $email_R = $dados['email_responsavel'];
                $telefone_R = $dados['telefone_contato'];
                $celular_R = $dados['celular_contato'];
                $cod_responsavel = $dados['cod_responsavel'];
                $nome_R = $dados['nome_responsavel'];
                $sexo_R = $dados['sexo_responsavel'];
                $rg_R = $dados['rg_responsavel'];
                $cpf_R = $dados['cpf_responsavel'];
                $rua_A = $dados['rua_aluno'];
                $numero_A = $dados['numero_aluno'];
                $bairro_A = $dados['bairro_aluno'];
                $cidade_A = $dados['cidade_aluno'];
                $complemento_A = $dados['complemento_aluno'];
                $cep_A = $dados['cep_aluno'];
                $escola_A = $dados['escola_aluno'];
                $escolaridade_A = $dados['escolaridade_aluno'];
                $matriculado = $dados['matriculado'];
                $dt_matricula = $dados['dt_matricula'];
                $nome_turma = $dados['nome_turma'];
                $cod_turma = $dados['id_turma']; ?>
                <br><br>

                <form method="post">
                    <table border="0">
                        <tr>
                            <td colspan="3">
                                <br>
                                <i><center><b>Informações pessoais do aluno</b></center></i>
                                <br>
                            </td>
                        </tr>							
                        <tr>
                            <td>Nome</td>
                            <td>Sexo</td>
                            <td>Data de nascimento</td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="nomeA" value="<?php echo $nome_A; ?>" >
                            </td>
                            <td>
                                <select name="sexoA" size="1" id="">
                                    <option value="<?php echo $sexo_A; ?>">
                                        <?php 
                                        $mostra_sexo = strtolower($sexo_A);
                                        echo ucfirst($mostra_sexo); 
                                        ?>
                                    </option>
                                    <?php if ($sexo_A == "MASCULINO") { ?>
                                        <option value="FEMININO">Feminino</option>
                                        <option value="OUTRO">Outro</option>
                                    <?php } elseif ($sexo_A == "FEMININO") { ?>
                                        <option value="MASCULINO">Masculino</option>
                                        <option value="OUTRO">Outro</option>
                                    <?php } else { ?>
                                        <option value="MASCULINO">Masculino</option>
                                        <option value="FEMININO">Feminino</option>
                                    <?php } ?>								
                                </select>									
                            </td>
                            <td>
                                <input type="date" name="dtNascimentoA" value="<?php echo $data_nascimento_A; ?>" >
                            </td>
                        </tr>
                        <tr>								
                            <td>RG (opcional)</td>
                            <td>CPF (opcional)</td>
                            <td>E-mail do Aluno (opcional)</td>
                        </tr>
                        <tr>								
                            <td>
                                <input type="number" name="rgA" value="<?php echo $RG_A; ?>" >
                            </td>
                            <td>
                                <input type="number" name="cpfA" value="<?php echo $CPF_A; ?>" >
                            </td>
                            <td>							
                                <input type="email" name="emailA" value="<?php echo $email_A; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <br>
                                <i><center><b>Informações pessoais do responsável</b></center></i>
                                <br>
                            </td>
                        </tr>
                        <tr>								
                            <td>Nome</td>
                            <td>Data de nascimento</td>
                            <td>Sexo</td>
                        </tr>
                        <tr>							
                            <td>													
                                <input type="text" name="nomeR" value="<?php echo $nome_R; ?>"  >
                            </td> 
                            <td>
                                <input type="date" name="dtNascResp" value="<?php echo $dt_nascimento_R; ?>" >
                            </td>
                            <td>
                                <select name="sexoR" size="1" id="">
                                    <option value="<?php echo $sexo_R; ?>">
                                        <?php
                                        $mostra_sexo = strtolower($sexo_R);
                                        echo ucfirst($mostra_sexo);
                                        ?>
                                    </option>
                                    <?php if ($sexo_R == "MASCULINO") { ?>
                                        <option value="FEMININO">Feminino</option>
                                        <option value="OUTRO">Outro</option>
                                    <?php } elseif ($sexo_R == "FEMININO") { ?>
                                        <option value="MASCULINO">Masculino</option>
                                        <option value="OUTRO">Outro</option>
                                    <?php } else { ?>
                                        <option value="MASCULINO">Masculino</option>
                                        <option value="FEMININO">Feminino</option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>RG (opcional)</td>
                            <td>CPF (opcional)</td>
                        </tr>
                        <tr>
                            <td>													
                                <input type="number" name="rgR" value="<?php echo $rg_R; ?>" />	
                            </td>
                            <td>
                                <input type="number" name="cpfR" value="<?php echo $cpf_R; ?>" >
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <br>
                                <i><center><b>Contatos</b></center></i>
                                <br>
                            </td>
                        </tr>
                        <tr>
                            <td>E-mail do responsavel (opcional)</td>
                            <td>Telefone para Contato (opcional)</td>
                            <td>Celular para Contato (opcional)</td>
                        </tr>
                        <tr>
                            <td>
                                <input type="email" name="emailR" value="<?php echo $email_R; ?>" >
                            </td>
                            <td>
                                <input type="number" name="telefoneR" value="<?php echo $telefone_R; ?>" />
                            </td>
                            <td>
                                <input type="number" name="celularR" value="<?php echo $celular_R; ?>"/> 
                            </td>
                        </tr>	
                        <tr>
                            <td colspan="3">
                                <br>
                                <i><center><b>Endereço</b></center></i>
                                <br>
                            </td>
                        </tr>
                        <tr>
                            <td>Rua</td>
                            <td>Número</td>
                            <td>Bairro</td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="ruaA" value="<?php echo $rua_A; ?>" />
                            </td>
                            <td>
                                <input type="" name="numeroA" value="<?php echo $numero_A; ?>" />
                            </td>
                            <td>		
                                <input type="text" name="bairroA" value="<?php echo $bairro_A; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>Cidade</td>
                            <td>Complemento (opcional)</td>
                            <td>CEP (opcional)</td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="cidadeA" value="<?php echo $cidade_A; ?>" >
                            </td>
                            <td>
                                <input type="text" name="complementoA" value="<?php echo $complemento_A; ?>" >
                            </td>
                            <td>
                                <input type="number" name="cepA" value="<?php echo $cep_A; ?>" >
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <center>
                                    <br>
                                    <input class="input" type="submit" name="salvar" value="Salvar"/>
                                    <input class="input" type="submit" name="cancelar" value="Cancelar"/>
                                </center>
                            </td>
                        </tr>
                    </table>
                </form>
                <br/><br/>
                <?php
                if (isset($_POST['cancelar'])) {
                    echo "<script language='javascript'>window.location='estudantes.php?pg=aluno';</script>";
                }
                if (isset($_POST['salvar'])) {

                    $nomeA = $_POST['nomeA'];
                    $sexoA = $_POST['sexoA'];
                    $dtNascimentoA = $_POST['dtNascimentoA'];
                    $rgA = (trim($_POST['rgA'])) ?: NULL;
                    $cpfA = (trim($_POST['cpfA'])) ?: NULL;
                    $emailA = (trim($_POST['emailA'])) ?: NULL;
                    $nomeR = $_POST['nomeR'];
                    $dtNascimentoR = $_POST['dtNascResp'];
                    $sexoR = $_POST['sexoR'];
                    $emailR = (trim($_POST['emailR'])) ?: NULL;
                    $rgR = (trim($_POST['rgR'])) ?: NULL;
                    $cpfR = (trim($_POST['cpfR'])) ?: NULL;
                    $telefoneR = (trim($_POST['telefoneR'])) ?: NULL;
                    $celularR = (trim($_POST['celularR'])) ?: NULL;
                    $ruaA = $_POST['ruaA'];
                    $numeroA = $_POST['numeroA'];
                    $bairroA = $_POST['bairroA'];
                    $cidadeA = $_POST['cidadeA'];
                    $complementoA = (trim($_POST['complementoA'])) ?: NULL;
                    $cepA = (trim($_POST['cepA'])) ?: NULL;

                    if (($nomeA != $nome_A) || ($sexoA != $sexo_A) || ($dtNascimentoA != $data_nascimento_A) || ($rgA != $RG_A) || ($cpfA != $CPF_A) || ($emailA != $email_A) || ($nomeR != $nome_R) || ($sexoR != $sexo_R) || ($emailR != $email_R) || ($telefoneR != $telefone_R) || ($celularR != $celular_R) || ($ruaA != $rua_A) || ($numeroA != $numero_A) || ($dt_nascimento_R != $dtNascimentoR) || ($bairroA = $bairro_A) || ($cidadeA != $cidade_A) || ($complementoA != $complemento_A) || ($cepA != $cep_A)) {

                        $update_inscricao = $crud->update('inscricao i', 'i.nome_aluno = :nomeA, i.sexo_aluno = :sexoA, i.email = :emailA, i.telefone_contato = :telefoneC, i.celular_contato = :celularC', 'WHERE i.id_inscricao = :id_inscricao')->run([':id_inscricao' => $cod_inscricao, 'nomeA' => $nomeA, ':sexoA' => $sexoA, ':emailA' => $emailA, ':telefoneC' => $telefoneR, ':celularC' => $celularR]);

                        $update_aluno = $crud->update('aluno a', 'a.data_nascimento_aluno = :dtNascimentoA, a.rg_aluno = :rgA, a.cpf = :cpfA, a.rua_aluno = :ruaA, a.numero_aluno = :numeroA, a.bairro_aluno = :bairroA, a.cidade_aluno = :cidadeA, a.complemento_aluno = :complementoA, a.cep_aluno = :cepA', 'WHERE a.id_aluno = :id_aluno')->run([':id_aluno' => $cod_aluno, ':dtNascimentoA' => $dtNascimentoA, ':rgA' => $rgA, ':cpfA' => $cpfA, ':ruaA' => $ruaA, ':numeroA' => $numeroA, ':bairroA' => $bairroA, 'cidadeA' => $cidadeA, ':complementoA' => $complementoA, ':cepA' => $cepA]);

                        $update_responsavel = $crud->update('responsavel r', 'r.nome_responsavel = :nomeR, r.data_nascimento_responsavel = :dtNascR, r.sexo_responsavel = :sexoR, r.email = :emailR, r.rg_responsavel = :rgR, r.cpf = :cpfR', 'WHERE r.id_responsavel = :id_responsavel')->run([':id_responsavel' => $cod_responsavel, ':nomeR' => $nomeR, ':dtNascR' => $dtNascimentoR, ':sexoR' => $sexoR, ':emailR' => $emailR, ':rgR' => $rgR, ':cpfR' => $cpfR]);

                        echo "<script language='javascript'> window.alert('Aluno(a) atualizado(a) com Sucesso!'); window.location='estudantes.php?pg=aluno';</script>";
                    }
                } die; 
            } ?>
        <!>
        <!CADASTRO DOS ESTUDANTES>

            <?php if (@$_GET['pg'] == 'cadastra') { ?>
                <?php if (@$_GET['etapa'] == '1') { // aqui abre a etapa 1 ?>			
                    <h1>1ª Etapa: Cadastre os dados pessoais</h1>

                    <?php if (isset($_POST['cadastrar_pt_1'])) {
                        
                        $id_aluno = $_GET['inscricao'];
                        $data_nascimento_aluno = $_POST['data_nascimento_aluno'];
                        $rg_aluno = $_POST['rg_aluno'];
                        $cpf_aluno = (trim($_POST['cpf_aluno'])) ?: NULL; 
                        $rua = $_POST['rua_aluno'];
                        $numero = $_POST['numero_aluno'];
                        $bairro_aluno = $_POST['bairro_aluno'];
                        $cidade_aluno = $_POST['cidade_aluno'];
                        $complemento_aluno = (trim($_POST['complemento_aluno'])) ?: NULL;
                        $cep_aluno= (trim($_POST['cep_aluno'])) ?: NULL;
                        $escolaridade = $_POST['escolaridade'];                        
                        $escola = $_POST['escola'];
                        
                        $insert_aluno = $crud->insert('aluno', 'id_aluno, data_nascimento_aluno, rg_aluno, cpf, rua_aluno, numero_aluno, bairro_aluno, cidade_aluno, complemento_aluno, cep_aluno, escolaridade, escola', '(:id_aluno, :data_nascimento_aluno, :rg_aluno, :cpf_aluno, :rua_aluno, :numero_aluno, :bairro_aluno, :cidade_aluno, :complemento_aluno, :cep_aluno, :escolaridade, :escola)')->run([':id_aluno' => $id_aluno, ':data_nascimento_aluno' => $data_nascimento_aluno, ':rg_aluno' => $rg_aluno, ':cpf_aluno' => $cpf_aluno, ':rua_aluno' => $rua, ':numero_aluno' => $numero, ':bairro_aluno' => $bairro_aluno, ':cidade_aluno' => $cidade_aluno, ':complemento_aluno' => $complemento_aluno, ':cep_aluno' => $cep_aluno, ':escolaridade' => $escolaridade, ':escola' => $escola]);
                        $crud->update('inscricao', 'inscrito = 1', 'WHERE id_inscricao = ?')->run([$id_aluno]);

                        if ($insert_aluno->rowCount() <= 0) {
                            echo "<script language='javascript'> window.alert('Erro ao Cadastrar!');</script>";
                        } else {
                            echo "<script language='javascript'>window.location='estudantes.php?pg=cadastra&etapa=2&aluno=$id_aluno';</script>"; 
                        }
                    } ?>

                    <form method="POST">
                        <table width="900" border="0">
                            <tr>
                                <td>Código</td>
                                <td>Nome completo</td>
                                <td>Data de nascimento</td>
                                <td>RG:</td>
                            </tr>
                            <tr>
                                <?php $get_id = $crud->select('id_inscricao, nome_aluno', 'inscricao', 'WHERE id_inscricao = ?')->run([$_GET['inscricao']]);
                                $val_get_id = $get_id->fetch(PDO::FETCH_ASSOC); ?>
                                <td><input type="text" disabled="disabled" value="<?php echo $val_get_id['id_inscricao']; ?>" /></td>
                                <td><input type="text" disabled="disabled" value="<?php echo $val_get_id['nome_aluno']; ?>" /></td>
                                <!-- <td><input type="number" title="Insira o código de inscrição" name="cod_inscricao" onkeyup="mostra_nome_aluno(this.value)" /></td>
                                <td>
                                    <div id = "mostra_nome_aluno">
                                        <input type="text" disabled="disabled" />
                                    </div>
                                </td>-->
                                <td><input type="date" title="Selecione a data de nascimento" name="data_nascimento_aluno" /></td>
                                <td><input type="text" title="Insira o RG" name="rg_aluno" maxlength="14"/></td>
                            </tr>
                            <tr>                                
                                <td>CPF (opcional)</td>
                                <td>Rua</td>
                                <td>Número</td>
                            </tr>
                            <tr>                                
                                <td><input type="text" title="Insira o CPF" name="cpf_aluno" maxlength="11"/></td>
                                <td><input type="text" title="Insira o rua" name="rua_aluno" maxlength="60"/></td>
                                <td><input type="text" title="Insira o número residêncial" maxlength="5" name="numero_aluno"/></td>
                            </tr>
                            <tr>														  	
                                <td>Bairro</td>
                                <td>Cidade</td>
                                <td>Complemento (opcional)</td>
                            </tr>
                            <tr>
                                <td><input type="text" title="Insira o bairro" maxlength="60" name="bairro_aluno" /></td>
                                <td><input type="text" title="Insire a cidade" maxlength="60" name="cidade_aluno" /></td>
                                <td><input type="text" title="Insire algun complemento" maxlength="100" name="complemento_aluno" /></td>
                            </tr>
                            <tr>
                                <td>Cep (opcional)</td>
                                <td>Escolaridade</td>
                                <td>Escola</td> 
                            </tr>
                            <tr>								
                                <td><input type="text" title="Insira o CEP" name="cep_aluno" maxlength="8" /></td>
                                <td>
                                    <select name="escolaridade" title="Selecione a escolaridade">
                                        <option value="Ensino_fundamental_cursando">Ensino fundamental cursando</option>
                                        <option value="Ensino_fundamental_concluido">Ensino fundamental concluído</option>
                                        <option value="Ensino_medio_cursando">Ensino médio cursando</option>
                                        <option value="Ensino_medio_concluido">Ensino médio concluído</option>
                                    </select>									
                                </td>
                                <td><input type="text" name="escola" title="Insira o nome da escola" /></td>
                            </tr>
                            <tr>
                                <td colspan="3"><center><input class="input" title="Avançar" type="submit" name="cadastrar_pt_1" value="Avançar"/></center></td>
                            </tr>
                        </table>
                    </form>
                    <br/> 				
                <?php } // aqui fecha a etapa 1 ?>
                <?php if (@$_GET['etapa'] == '2') { // aqui abre a etapa 2 ?>			
                    <h1>2ª Etapa: Cadastro de dados do responsável</h1>
                    <?php $id_aluno = $_GET['aluno'];?>
                    <table class="buttons_cadastra"><tr><td><a href="<?php echo 'estudantes.php?pg=cadastra&etapa=2&aluno='.$id_aluno.'&cadastro=sim';?>">Já Possuí Cadastro?</a></td></tr></table>
                    <?php if (isset($_POST['cadastrar_pt_2'])) {
                        
                        if (@$_GET['cadastro'] == 'sim' ) {
                            
                            $id_responsavel = $_POST['id_resp'];
                            $id_aluno = $_GET['aluno'];
                            
                            $crud->update('aluno', 'id_responsavel = :id_responsavel', 'WHERE id_aluno = :id_inscricao')->run([':id_responsavel' => $id_responsavel, ':id_inscricao' => $id_aluno]);
                            
                            echo "<script language='javascript'>window.location='estudantes.php?pg=cadastra&etapa=3&aluno=$id_aluno';</script>";
                            
                        } else {
                            
                            $id_inscricao = $_GET['inscricao'];
                            $id_responsavel = $_POST['id_responsavel'];
                            $nome_responsavel = $_POST['nome_responsavel'];
                            $data_nascimento_responsavel = $_POST['data_nasc_resp'];
                            $sexo_responsavel = $_POST['sexo_responsavel'];
                            $cpf_responsavel = (trim($_POST['cpf_responsavel'])) ?: NULL; 
                            $rg_responsavel = (trim($_POST['rg_responsavel'])) ?: NULL; 
                            $email_responsavel = (trim($_POST['email_responsavel'])) ?: NULL; 
                             

                            $insert_responsavel = $crud->insert('responsavel', 'nome_responsavel, data_nascimento_responsavel, sexo_responsavel, cpf, rg_responsavel, email', '(:nome, :data, :sexo, :cpf, :rg, :email)')->run([':nome' => $nome_responsavel, ':data' => $data_nascimento_responsavel, ':sexo' => $sexo_responsavel, ':cpf' => $cpf_responsavel, ':rg' => $rg_responsavel, ':email' => $email_responsavel]);
                            if ($insert_responsavel->rowCount() <= 0) {
                                echo "<script language='javascript'> window.alert('Erro ao Cadastrar!');</script>";
                            } else {
                                $last_id_respondavel = $crud->con()->lastInsertId();

                                $crud->update('aluno', 'id_responsavel = :id_responsavel', 'WHERE id_aluno = :id_inscricao')->run([':id_responsavel' => $last_id_respondavel, ':id_inscricao' => $id_inscricao]);
                                
                                echo "<script language='javascript'>window.location='estudantes.php?pg=cadastra&etapa=3&aluno=$id_aluno';</script>";
                            }                        
                        }
                    } 
                    if (@$_GET['cadastro'] == 'sim'){
                        
                        if (isset($_POST['busca_id_responsavel'])) {
                            
                            $id_responsavel = $_POST['id_responsavel'];
                            $busca_resp = $crud->select('id_responsavel, nome_responsavel, sexo_responsavel, data_nascimento_responsavel, cpf, rg_responsavel, email', 'responsavel', 'WHERE id_responsavel = ? AND status_responsavel = 1')->run([$id_responsavel]);
                            $valores_responsavel = $busca_resp->fetch(PDO::FETCH_ASSOC);    
                        } ?>
                        <form method="POST">
                        <table width="900" border="0">
                            <tr>
                                <td>Código do responsável</td>			
                                <td>Nome do responsável</td>
                                <td>Sexo do responsável</td>
                                <td>data de Nascimento do Responsavel</td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="id_responsavel" maxlength="6" value="<?php echo @$valores_responsavel['id_responsavel'];?>" style="width: 130px;"/><input type="hidden" name="id_resp" value="<?php echo @$valores_responsavel['id_responsavel'];?>"/><input style="margin-left: 10px;" type="submit" class="input" value="Buscar" title="Clique aqui para pesquisar o codigo do responsavel" name="busca_id_responsavel"/>
                                </td>                             
                                <td>
                                    <input type="text" disabled value="<?php echo @$valores_responsavel['nome_responsavel'];?>" />
                                </td>
                                <td>
                                    <input type="text" disabled value="<?php echo @$valores_responsavel['sexo_responsavel'];?>" />
                                </td>
                                <td>
                                    <input type="date" disabled value="<?php echo @$valores_responsavel['data_nascimento_responsavel'];?>" />
                                </td>     
                            </tr>
                            <tr>
                                <td>CPF do responsável</td>
                                <td>RG do responsável</td>
                                <td>E-mail do responsável</td>
                            </tr>
                            <tr>
                                <td><input type="text" disabled value="<?php echo @$valores_responsavel['cpf'];?>" /></td>
                                <td><input type="text" disabled value="<?php echo @$valores_responsavel['rg_responsavel'];?>" /></td>
                                <td><input type="email" disabled value="<?php echo @$valores_responsavel['email'];?>" /></td>
                            </tr>    
                            <tr>
                                <td colspan="4" style="padding-top: 10px;"><center><input class="input" title="Concluir" type="submit" name="cadastrar_pt_2" id="button" value="Concluir"/></center></td>
                            </tr>
                        </table>
                    </form>                       
                        
                    <?php die; } ?>

                    <form name="form1" method="post">
                        <table width="900" border="0">
                            <tr>
                                <td><b>Código do responsável</b></td>			
                                <td>Nome do responsável</td>
                                <td>Sexo do responsável</td>
                                <td>data de Nascimento do Responsavel</td>
                            </tr>
                            <tr>
                                <?php 
                                $select_novo_id_responsavel = $crud->select('id_responsavel', 'responsavel', 'ORDER BY id_responsavel DESC LIMIT 1')->run();                                

                                if ($select_novo_id_responsavel->rowCount() <= 0) {
                                    $novo_id = 1; ?>

                                    <td><input type="text" name="id_responsavel" disabled="disabled" value="<?php echo $novo_id; ?>"/></td>
                                    <input type="hidden" name="id_responsavel" value="<?php echo $novo_id; ?>"/> 
                                <?php } else {
                                    while ($val_novo_id_resp = $select_novo_id_responsavel->fetch(PDO::FETCH_ASSOC)) {
                                        $novo_id = $val_novo_id_resp['id_responsavel'] + 1; ?>
                                        <td><input type="text" name="id_responsavel" disabled="disabled" value="<?php echo $novo_id; ?>"/></td>
                                        <input type="hidden" name="id_responsavel" value="<?php echo $novo_id; ?>" />
                                    <?php }
                                } ?>
                                <td><input type="text" title="Insira o nome do responsável" name="nome_responsavel" /></td>
                                <td>
                                    <select name="sexo_responsavel" title="Selecione o sexo do responsável" size="1" >
                                        <option value="MASCULINO">Masculino</option>
                                        <option value="FEMININO">Feminino</option>
                                        <option value="OUTRO">Outro</option>
                                    </select>
                                </td>
                                <td><input type="date" title="Selecione a data de nascimento do responsável" name="data_nasc_resp" /></td>     
                            </tr>
                            <tr>
                                <td>CPF do responsável (opcional)</td>
                                <td>RG do responsável (opcional)</td>
                                <td>E-mail do responsável (opcional)</td>
                            </tr>
                            <tr>
                                <td><input type="text" title="Insira o CPF do responsável" name="cpf_responsavel" maxlength="11"/></td>
                                <td><input type="text" title="Insira o RG do responsável" name="rg_responsavel" maxlength="14"/></td>
                                <td><input type="email" title="Insira o email do Responsável" name="email_responsavel" /></td>
                            </tr>    
                            <tr>
                                <td colspan="3"><input class="input" title="Concluir" type="submit" name="cadastrar_pt_2" id="button" value="Concluir"/></td>
                            </tr>
                        </table>
                    </form>
                    <br/>			
                <?php }// aqui fecha o bloco 2 ?>
                    
                <?php if (@$_GET['etapa'] == '3') { // aqui abre a etapa 3 
                    if (@$_GET['turma'] != NULL) {
                        
                        $id_aluno = $_GET['aluno'];
                        $id_turma = $_GET['turma'];
                        $insert_turma_into_aluno = $crud->update('aluno', 'id_turma = :turma, data_matricula = :dt, matriculado = 1', 'WHERE id_aluno = :aluno')->run([':turma' => $id_turma, ':dt' => date('Y-m-d'), ':aluno' => $id_aluno]);                                              
                        
                        echo "<script language='javascript'>window.location='estudantes.php?pg=cadastra&etapa=resumo';</script>";
                    } ?>
                    
                    <h1>3ª Etapa: - Escolher Turma</h1>
                    
                    <?php $id_aluno = $_GET['aluno'];
                    $select_turma = $crud->select('id_turma, nome_turma, quantidade_alunos, disponivel', 'turma', 'ORDER BY nome_turma')->run(); ?>
                    <form method="POST">                          
                        <table width="900" border="0" class="bordasimples">
                            <thead>
                                <tr>
                                    <th><center><strong> Turma </strong></center></th>
                                    <th><center><strong>Total de alunos nesta turma</strong></center></th>
                                    <th><center><strong>Selecionar</strong></center></th>
                                </tr>
                            </thead>
                            <?php while ($valores_turma = $select_turma->fetch(PDO::FETCH_ASSOC)) {

                                $class = @$i % 2 == 0 ? ' class="dif"' : '';
                                $nome_turma = $valores_turma['nome_turma'];
                                $qtde_alunos = $valores_turma['quantidade_alunos'];
                                $cod_turma = $valores_turma['id_turma'];
                                $select_count_turma = $crud->select('id_aluno', 'aluno', 'WHERE id_turma = ? AND status_aluno = 1')->run([$cod_turma]);
                                $qtde_total = $select_count_turma->rowCount();
                                if ($qtde_total == $qtde_alunos) {
                                    $crud->update('turma', 'disponivel = 0', 'WHERE id_turma = ?')->run([$cod_turma]);                                  
                                }?>

                                <tr <?php echo $class; ?>>
                                    <td><center><?php echo $nome_turma; ?></center></td>
                                    <td><center><?php echo $qtde_total . ' | ' . $qtde_alunos; ?></center></td>
                                    <?php if ($valores_turma['disponivel'] == 1) { ?>
                                        <td><center><a href="<?php echo 'estudantes.php?pg=cadastra&etapa=3&aluno='.$id_aluno.'&turma='.$cod_turma;?>"><img title="Selecionar Turma <?php echo $nome_turma; ?>" src="img/success.png" width="18" height="18" border="0"/></a></center></td>
                                    <?php } else { ?>
                                        <td><center><label>Indisponível</label></center></td>
                                    <?php } ?>                                    
                                </tr>
                            <?php @$i++; } ?>
                        </table>
                    </form>
                <?php } // aqui fecha a etapa 3 ?>
                    
                <?php if (@$_GET['etapa'] == 'resumo') { // aqui abre a etapa resumo ?>
                    <h1>4º Passo - Aviso</h1>
                    <table>
                        <tr>
                            <td>
                                <h4>Este(a) Estudante Foi cadastrado com sucesso!
                                <ul>
                                    <li>Fique atento em relação a chamada pois com 3 faltas não justificadas ele será removido do cursinho!</li>
                                </ul>
                                <a href="estudantes.php?pg=aluno">Clique aqui para voltar para página de consultas</a>
                                </h4>
                            </td>
                        </tr>
                    </table>
                    <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
                <?php }// aqui fecha a etapa resumo ?>
            <?php }// aqui fecha a PG cadastra ?>
        <!Justificar Faltas do Aluno>
            <?php if (@$_GET['justificar']){
                
                $cod_aluno = $_GET['aluno'];
                
                //relacionado a chamada
                $qtde_faltas = $crud->select('COUNT(presenca) AS faltas', 'chamada', 'WHERE id_aluno = :id_aluno AND presenca = 0')->run([':id_aluno' => $cod_aluno]);
                $val_faltas = $qtde_faltas->fetch(PDO::FETCH_ASSOC);
                $faltas = $val_faltas['faltas'];

                //quantidade de aulas já dadas
                $select_qtde_aulas = $crud->select('COUNT(DISTINCT(c.data_chamada)) AS aulas_dadas, a.id_turma', 'chamada c', 'INNER JOIN aluno a ON a.id_aluno = c.id_aluno WHERE (c.data_chamada BETWEEN a.data_matricula AND CURRENT_DATE) AND c.id_aluno = ?')->run([$cod_aluno]);
                $val_aulas_dadas = $select_qtde_aulas->fetch(PDO::FETCH_ASSOC);
                $qtde_aulas = $val_aulas_dadas['aulas_dadas'];
                $cod_turma = $val_aulas_dadas['id_turma'];

                $chamada = $crud->select('c.id_chamada, c.data_chamada data_chamada, t.nome_turma nome_turma, p.nome_professor nome_professor, i.nome_aluno nome_aluno, c.presenca presenca, c.justificada', 'inscricao i', 'INNER JOIN aluno a ON i.id_inscricao = a.id_aluno INNER JOIN turma t ON a.id_turma = t.id_turma INNER JOIN chamada c ON c.id_aluno = a.id_aluno INNER JOIN professor p ON p.id_professor = c.id_professor WHERE (c.data_chamada BETWEEN a.data_matricula AND CURRENT_DATE) AND a.id_aluno = :id_aluno AND a.id_turma = :id_turma ORDER BY c.data_chamada')->run([':id_aluno' => $cod_aluno, ':id_turma' => $cod_turma]); 
                
                if (@$_GET['chamada']) {
                    
                    $id_chamada = $_GET['chamada'];
                    $crud->update('chamada', 'justificada = 1', 'WHERE id_chamada = ?')->run([$id_chamada]);
                    
                    echo "<script language='javascript'>window.alert('Justificado com sucesso!');window.location='estudantes.php?pg=aluno&mod=visualiza&aluno=".$cod_aluno."';</script>";
                    
                } ?>
                
                    <table width="900" border="0">
                        <thead>
                            <th><b>Data da chamada</b></th>
                            <th><b>Nome da turma</b></th>
                            <th><b>Nome do professor</b></th>
                            <th><b>Nome do aluno</b></th>
                            <th><b>Status</b></th>								
                            <th><center>Alterar</center></th>								
                        </thead>							
                        <?php
                        while ($val_chamada = $chamada->fetch(PDO::FETCH_ASSOC)) {
                            $id_chamada = $val_chamada['id_chamada'];
                            $data_chamada = $val_chamada['data_chamada'];
                            $data_chamada = date("d/m/Y", strtotime($data_chamada));
                            $nomeTurma = $val_chamada['nome_turma'];
                            $nomeProfessor = $val_chamada['nome_professor'];
                            $nomeAluno = $val_chamada['nome_aluno'];
                                                        
                            $falta_justificada = $val_chamada['justificada'];
                            $status = $val_chamada['presenca'];
                            
                            if ($status) {
                                $cor = 'lightgreen';
                                $mostra_status = 'Presença';
                            } else {
                                if ($falta_justificada) {
                                    $cor = 'mediumslateblue';
                                    $mostra_status = 'Justificada';
                                } else {
                                    $cor = 'tomato';
                                    $mostra_status = 'Falta';
                                }
                            } ?>
                            <tr style="background-color: <?php echo $cor; ?>;height: 35px;" >
                                <td><?php echo $data_chamada; ?></td>
                                <td><?php echo $nomeTurma; ?></td>
                                <td><?php echo $nomeProfessor; ?></td>
                                <td><?php echo $nomeAluno; ?></td>
                                <td><?php echo $mostra_status; ?></td>
                                <td style="width: 99px; background-color: white;">
                                    <?php echo $td = $status || $falta_justificada ? '' : '<a class="a2" href="estudantes.php?pg=aluno&justificar=sim&aluno='.$cod_aluno.'&chamada='.$id_chamada.'" style="width: auto; height: auto; margin-left: 10px; margin-right: 10px;" >Alterar</a>';?>
                                </td>
                            </tr>
                        <?php } ?>    
                    </table>
            <?php die; } ?>
        
                    
        <!Trocar Aluno de Turma>
            <?php if (@$_GET['trocar_turma'] == 'sim'){
                
                $id_aluno = @$_GET['aluno'];
                $id_turma = @$_GET['turma'];
                
                if (@$_GET['new_turma']){
                    $new_turma = @$_GET['new_turma'];
                    $crud->update('aluno', 'id_turma = ?', 'WHERE id_aluno = ?')->run([$new_turma, $id_aluno]);
                    echo "<script language='javascript'> window.alert('Atualizado com Sucesso'); window.location='estudantes.php?pg=aluno&mod=visualiza&aluno=$id_aluno';</script>";                    
                }?>

                <h1>Alteração de Turma</h1>

                <?php $select_turma = $crud->select('id_turma, nome_turma, quantidade_alunos, disponivel', 'turma', 'ORDER BY nome_turma')->run(); ?>
                <form method="POST">                          
                    <table width="900" border="0" class="bordasimples">
                        <thead>
                            <tr>
                                <th><center><strong> Turma </strong></center></th>
                                <th><center><strong>Total de alunos nesta turma</strong></center></th>
                                <th><center><strong>Selecionar</strong></center></th>
                            </tr>
                        </thead>
                        <?php while ($valores_turma = $select_turma->fetch(PDO::FETCH_ASSOC)) {

                            $class = @$i % 2 == 0 ? ' class="dif"' : '';
                            $nome_turma = $valores_turma['nome_turma'];
                            $qtde_alunos = $valores_turma['quantidade_alunos'];
                            $cod_turma = $valores_turma['id_turma'];
                            $select_count_turma = $crud->select('id_aluno', 'aluno', 'WHERE id_turma = ? AND status_aluno = 1')->run([$cod_turma]);
                            $qtde_total = $select_count_turma->rowCount();
                            if ($qtde_alunos == $qtde_total) {
                                $crud->update('turma', 'disponivel = 0', 'WHERE id_turma = ?')->run([$cod_turma]);                                  
                            } else {
                                $crud->update('turma', 'disponivel = 1', 'WHERE id_turma = ?')->run([$cod_turma]);
                            }?>

                            <tr <?php echo $class; ?>>
                                <td><center><?php echo $nome_turma; ?></center></td>
                                <td><center><?php echo $qtde_total . ' | ' . $qtde_alunos; ?></center></td>
                                
                                <?php if ($id_turma == $cod_turma) { ?>
                                    <td><center><label>Matriculado Aqui</label></center></td>
                                <?php } else {
                                    if ($valores_turma['disponivel'] == 1) { ?>
                                        <td><center><a href="estudantes.php?pg=aluno&trocar_turma=sim&aluno=<?php echo $id_aluno; ?>&turma=<?php echo $id_turma; ?>&new_turma=<?php echo $cod_turma;?>"><img title="Selecionar Turma <?php echo $nome_turma; ?>" src="img/success.png" width="18" height="18" border="0"/></a></center></td>
                                    <?php } else { ?>
                                        <td><center><label>Indisponível</label></center></td>
                                    <?php }
                                } ?>
                            </tr>
                        <?php @$i++; } ?>
                    </table>
                </form>
            <?php die; }?>    

            <!BUSCANDO ESTUDANTES NO BANCO>

            <?php if (@$_GET['pg'] == 'aluno') { ?>                                                     
                <table class="buttons_cadastra">
                    <tr>
                        <td>
                            <?php if (@$_GET['mostra'] == 'inativo') { 
                                $val_status = 0; ?>                    
                                <a class='a2' style='color: white; background-color: #044c88;' href='estudantes.php?pg=aluno'>Mostrar Alunos Ativos</a>                    
                            <?php } else { 
                                $val_status = 1; ?>                    
                                <a class='a2' style='color: white; background-color: #b93434;' href='estudantes.php?pg=aluno&mostra=inativo'>Mostrar Alunos Inativos</a>                    
                            <?php }?>                            
                        </td>
                        <td style="text-align: right; padding-right: 5px; color: #FFF;">Buscar:</td>
                        <td style="width: 240px;"><input id="txt_consulta" placeholder="Insira o nome, cpf, rg ou código aqui" type="text" style="border-radius: 8px; border: none;" /></td>
                    </tr>
                </table>
                <h1>Alunos Cadastrados</h1>
                </br>
                
                    
                <?php $select_inscricao_aluno = $crud->select('a.id_aluno, i.nome_aluno, a.rg_aluno, a.cpf, i.telefone_contato, i.celular_contato', 'inscricao i', 'INNER JOIN aluno a ON i.id_inscricao = a.id_aluno WHERE i.nome_aluno IS NOT NULL AND status_aluno = ? ORDER BY i.nome_aluno')->run([$val_status]);
                
                if ($select_inscricao_aluno->rowCount() <= 0) { ?>
                    <table width="900" border="0"><tr><td><h2>Ainda não há nenhum registro</h2></td></tr></table>
                <?php } else { ?>
                    <table width="900" border="0" id="tabela" class="bordasimples">
                        <thead>
                            <tr>						
                                <th><center><strong>Código</strong></center></th>
                                <th><center><strong>Nome Completo</strong></center></th>
                                <th><center><strong>RG</strong></center></th>
                                <th><center><strong>CPF</strong></center></th>
                                <th><center><strong>Telefone </strong></center></th>                                    
                                <th><center><strong>Celular</strong></center></th>
                                <?php echo (@$_GET['mostra'] == 'inativo') ?'':'<th><center><strong>Modificar</strong></center></th>';?>
                            </tr>
                        </thead>
                        <?php while ($val_inscricao_aluno = $select_inscricao_aluno->fetch(PDO::FETCH_ASSOC)) { 
                            $class = @$i % 2 == 0 ? ' class="dif"' : '';
                            $id_aluno = $val_inscricao_aluno['id_aluno'];?>
                            
                            <?php if (@$_GET['mostra'] == 'inativo') { ?>
                                <tr <?php echo $class;?> style="color: #b93434" onclick="location.href = 'estudantes.php?pg=aluno&mostra=inativo&mod=visualiza&aluno=<?php echo $id_aluno;?>'" >    
                            <?php } else { ?>
                                <tr <?php echo $class;?>>
                            <?php } ?>
                                <td><center><?php echo $id_aluno; ?></center></td>
                                <td><center><?php echo $val_inscricao_aluno['nome_aluno']; ?></center></td>
                                <td><center><?php echo $val_inscricao_aluno['rg_aluno']; ?></center></td>
                                <td><center><?php echo $val_inscricao_aluno['cpf']; ?></center></td>
                                <td><center><?php echo $val_inscricao_aluno['telefone_contato']; ?></center></td>
                                <td><center><?php echo $val_inscricao_aluno['celular_contato']; ?></center></td>
                                <?php if (!@$_GET['mostra'] == 'inativo') { ?>
                                    <td>
                                        <center>									
                                            <a href="estudantes.php?pg=aluno&mod=visualiza&aluno=<?php echo $id_aluno; ?>"><img title="Visualizar" src="img/lupa_turma.png" width="18" height="18" border="0"></a>
                                            <a href="estudantes.php?pg=aluno&mod=atualiza&aluno=<?php echo $id_aluno; ?>"><img title="Atualizar" src="img/editar.png" width="18" height="18" border="0"></a>                                            
                                        </center>	
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php @$i++; } ?>
                    </table>
                    <script>
                        $('input#txt_consulta').quicksearch('table#tabela tbody tr');
                    </script>
                    <br/> 
                <?php die; } ?>
            <?php } ?>                        
        </div>
    </body>
</html>