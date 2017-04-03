<script>
	$(function() {
		$( "#datepicker" ).datepicker();
		
	});
	
	function excluirRegistro(id) {
		if (confirm("Deseja realmente excluir o registro selecionado?")) {
			retorno = $.ajax({
				type:'post', 
				url: 'agenda.php', 
				timeout:90000, 
				data: {
					a: 'excluir',
					id: id
				},
				beforeSend: function() {
					
				}
			}).done(function() {
				alert('Registro excluído com sucesso!');
				$('#registro' + id).fadeOut();
			}).fail(function() { alert("error"); });	
		}
	}
</script>
<style>
.filtro-manutencao {
	overflow:hidden	
}
.filtro-manutencao > li:first-child
{
	float:left;
}
.filtro-manutencao > li:last-child
{
	float:right;
}
.acoes li
{
	float:left;
	margin:0 6px;
}
</style>
<ul class="filtro-manutencao">
	<li>
        <form name="" method="get" action="">
            <ul class="form">
                <li>
                    <strong>Data:</strong> <input name="data" type="text" id="datepicker" size="10" value="<?php echo Util::formatDate($data); ?>" />
                </li>
                <li>
                    <strong>Funcionário: </strong>
                    <select name="IdFuncionario">
                        <option value="0">Todos</option>
                        <?php foreach ($funcionarios as $item) : ?>
                        <option value="<?php echo $item->Id; ?>" <?php if ($_REQUEST["IdFuncionario"] == $item->Id) : ?>selected="selected"<?php endif; ?>><?php echo ($item->Nome . " " . $item->Sobrenome); ?></option>
                        <?php endforeach; ?>
                    </select>
                </li>
                <li>
                    <strong>&nbsp;</strong>
                    <button>Atualizar</button>
                </li>
            </ul>
        </form>
    </li>
    <li>
    	<div class="titulo">Avisos/Manutenção</div>
        <div style="height:140px; overflow:auto; width:550px; border:1px solid #936; padding:4px; background:#FFF;">
            
            <table class="table table-mini">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Cliente</th>
                        <th>Tipo</th>
                        <th>Descrição</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($avisos as $item) : ?>
                    <tr>
                        <td><?php echo $item->data; ?></td>
                        <td><?php echo ($item->cliente); ?></td>
                        <td><?php echo ($item->tipo); ?></td>
                        <td><?php echo ($item->descricao); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </li>
</ul>

    
<div class="titulo">Agenda do dia <?php echo Util::formatDate($data); ?></div>
<?php if (count($agendamentos) > 0) : ?>
<table class="table">
	<thead>
		<tr>
			<th>Funcionário</th>
			<th>Dia</th>
			<th>Hora</th>
			<th>Cliente</th>
			<th>Descri&ccedil;&atilde;o</th>
			<th>Como conheceu?</th>
			<th>Ações</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($agendamentos as $item) : ?>
		<tr id="registro<?php echo $item->agenda_id; ?>">
			<td><?php echo ($item->funcionario); ?></td>
			<td><?php echo $item->dia; ?></td>
			<td><?php echo $item->hora; ?></td>
			<td><?php echo ($item->cliente); ?></td>
			<td><?php echo ($item->descricao); ?></td>
			<td><?php echo ($item->comoConheceu); ?></td>
			<td>
            	<ul class="acoes">
                	<li><a href="javascript:void(0)" onclick="javascript:excluirRegistro(<?php echo $item->agenda_id; ?>)"><img src="../images/button_delete.png" alt="Excluir este registro" /></a></li>
                   	<li><a href="agendaFuncionario.php?id=<?php echo $item->agenda_id; ?>"><img src="../images/button_edit.png" alt="Editar evento" /></a></li>
                </ul>
            </td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<?php else : ?>
<center>Nenhum registro encontrado...</center>
<?php endif; ?>
