<?php
require "../class/config.class.php";

// get the q parameter from URL
$nome = intval($_GET['nome']);

if ($nome == '') {
    ?>

    <input type="text" disabled="disabled" value="">

    <?php
} else {

    $select_nome_aluno = $crud->select('nome_aluno', 'inscricao', 'WHERE id_inscricao = ?')->run([$nome]);

    if ($select_nome_aluno->rowCount() <= 0) {
        ?>

        <input type="text" disabled="disabled" value="Aluno não encontrado!">

    <?php
    } else {

        $val_nome_aluno = $select_nome_aluno->fetch(PDO::FETCH_ASSOC);
        ?>
        <input type="text" disabled="disabled" value="<?php echo $val_nome_aluno['nome_aluno']; ?>">

    <?php
    }
}
?>