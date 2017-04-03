<?php

require_once("../init.php");

// abre conexão com o banco
$conexao = new Conexao();

// carrega funcionarios
$funcionarios = $conexao->carregarTodos(_TABLE_PREFIX . "funcionarios");

$titulo = "Cadastro de Evento";

if (isset($_REQUEST["id"]) && !empty($_REQUEST["id"])) :
	$agenda = $conexao->carregarPorId(_TABLE_PREFIX . "agenda", $_REQUEST["id"]);
	$titulo = "Edição de Evento";
	$horaInicio = date("H:i", strtotime($agenda->HoraInicio));
	$edicao = true;
endif;

$conexao->desconectar();

	include "kernel.martha_sys.inc.php";
	if(!isLogged()) {
		die("sessão não iniciada");
	}
	if(isset($_POST["Opcoes"])) 
		$id = $_POST["Opcoes"];
	else
		$id = $_GET["id"];
	$funcionario = getFuncionario($id);

	//$data_inicio = isset($_POST["data_inicio"]) ? $_POST["data_inicio"] : date("d/m/Y", strtotime("today"));
	//$data_fim = isset($_POST["data_fim"]) ? $_POST["data_fim"] : date("d/m/Y", strtotime("+1 month"));
	//$agenda = getAgendaFuncionario($id,$data_inicio,$data_fim);

?>
<html>
<head>
<title>MarthaHair - Sistema</title>
<link rel="stylesheet" href="martha_sys.css" type="text/css">
<script language="javascript">
function windowContrato(url) {
  	var wProduto = window.open(url,'MyWin','width=800,height=500,toolbar=0,menubar=0,status=1,scrollbars=1,resizable=1');
}

function enviaForm(action_url,confirma) {
	var envia = true;
	if(confirma)
		envia = confirm("Tem certeza?");
	if(envia)
		window.location = action_url;
}

function popEditarObs(id_compromisso)  {
  	var wEditar = window.open('formEditarAgendaObs.php?id=' + id_compromisso,'MyWin','width=300,height=150,toolbar=0,menubar=0,status=1,scrollbars=1,resizable=1');
}

</script>

<link href="/sistema/css/smoothness/jquery-ui-1.10.1.custom.css" rel="stylesheet">
<link href="/sistema/css/sistema.css" rel="stylesheet" />
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="/sistema/js/jquery-ui-1.10.1.custom.js"></script>

<script>
	$(function() {
		$( "#datepicker" ).datepicker();
	});
</script>
</head>
<body>
<h3 class="titulo_secao">Agenda - <?php echo $titulo; ?></h3>

<!--
<form action="agendaFuncionario.php?id=<?=$id?>" method="post">
Por período: <input type="text" name="data_inicio" size="10" value="<?=$data_inicio?>"> a <input type="text" name="data_fim" size="10" value="<?=$data_fim?>"><input type="submit" value="Mostrar agenda">
</form>
-->

<!--
<table width="100%" cellpadding="0" cellspacing="0" border="0"><br>
<?php
	if(sizeof($agenda)==0) {?>
		<tr>
			<td colspan="2" class="formulario">Nenhum compromisso cadastrado no período.</td>
		</tr>	
<?php } else {?>
	<tr>
		<td class="formulario"><b>Cliente</b></td>
		<td class="formulario"><b>Descrição</b></td>
		<td class="formulario"><b>Início</b></td>
		<td class="formulario"><b>Término</b></td>
		<td class="formulario"><b>Observações</b></td>
	</tr>
<?php	foreach($agenda as $comp) {
			extract($comp);
			$cliente = getCliente($IdCliente);			
			?>
			<tr>
				<td valign="top" class="formulario"><?=$cliente['Nome'] . ' ' . $cliente['Sobrenome']?></td>				
				<td valign="top" class="formulario"><?=$Descricao?></td>				
				<td valign="top" class="formulario"><?=date('d/m/Y',strtotime($HoraInicio))?> às <?=date('H:i',strtotime($HoraInicio))?></td>				
				<td valign="top" class="formulario"><?=date('d/m/Y',strtotime($HoraInicio))?> às <?=date('H:i',strtotime($HoraFim))?></td>				
				<td valign="top" class="formulario"><?=$Obs?> <a href="javascript:popEditarObs('<?=$Id?>');">editar</a></td>				
				<td valign="top" class="formulario"><a href="javascript:enviaForm('remover.php?tabela=agenda&id=<?=$Id?>',true);">Remover</a></td>
			</tr>
			<?php } 
		}
?>
</table>
--><a href="formCliente.php">Cadastrar novo cliente</a>
<form name="fCadastrar" action="agenda.php" method="post" enctype="multipart/form-data">
	<!--<input type="hidden" name="IdFuncionario" value="<?=$id?>">-->
	<input type="hidden" name="a" value="salvar">
	<table cellpadding="5" cellspacing="5" border="0">
		<tr>
		  <td class="formulario">Funcion&aacute;rio:</td>
		  <td>
          	<select name="IdFuncionario">
            	<?php foreach ($funcionarios as $item) : ?>
                <option value="<?php echo $item->Id; ?>" <?php if ($agenda->IdFuncionario == $item->Id) : ?>selected="selected"<?php endif; ?>><?php echo ($item->Nome . " " . $item->Sobrenome); ?></option>
                <?php endforeach; ?>
            </select>
          </td>
	  </tr>
		<tr>
		  <td class="formulario">Descrição:</td>
		  <td><input type="type" name="Descricao" size="40" value="<?php echo $agenda->Descricao; ?>"></td>
		</tr>
		<tr>
		  <td class="formulario">Cliente:</td>
		  <td>
						<select name="IdCliente">
							<option value="0">-
				<?php 
					$regs = getClientes();
					foreach($regs as $reg) {
						extract($reg);
				?>		<option value="<?=$Id?>" <?php if ($agenda->IdCliente == $Id) : ?>selected="selected"<?php endif; ?>><?=$Nome . ' ' . $Sobrenome?><?php		
					}
				?>			
						</select>  
		  </td>
		</tr>
		<tr>
		  <td class="formulario">Data:</td>
		  <td>
          	<input name="data" type="text" id="datepicker" size="30" rel="" <? if ($edicao == true) : ?>value="<?php echo Util::formatDate($agenda->HoraInicio); ?>"<?php endif; ?> />
          </td>
		</tr>
		<tr>
		  <td class="formulario">Hora:</td>
		  <td>
          	<select name="Inicio">
            	<?php 
				for ($contador = 9; $contador <= 20; $contador++) :
					$hora = str_pad($contador, 2, "0", STR_PAD_LEFT);
					$hora00 = $hora . ":00";
					$hora30 = $hora . ":30"
				?>
                <option value="<?php echo $hora00; ?>" <?php if ($hora00 == $horaInicio) echo 'selected="selected"'; ?>><?php echo $hora00; ?></option>
                <option value="<?php echo $hora30; ?>" <?php if ($hora30 == $horaInicio) echo 'selected="selected"'; ?>><?php echo $hora30; ?></option>
                <?php endfor; ?>
            </select>
          </td>
		</tr>
		<tr>
		  <td class="formulario">Duração prevista:</td>
		  <td>
		  	<select name="Duracao">
				<option value='0'>Não especificada</option>
				<option value='0.5'>30min</option>
				<option value='1'>1h</option>
				<option value='1.5'>1h30min</option>
				<option value='2'>2h</option>
				<option value='2.5'>2h30</option>
				<option value='3'>3h</option>
				<option value='3.5'>3h30</option>
				<option value='4'>4h</option>
				<option value='4.5'>4h30</option>
				<option value='5'>5h</option>
				<option value='5.5'>5h50</option>
				<option value='6'>6h</option>
			</select>
		  </td>
		</tr>
		<tr>
		  <td class="formulario" colspan="2">
          	Como conheceu?<br>
            <textarea name="ComoConheceu" cols="30" rows="3"><?php echo $agenda->ComoConheceu; ?></textarea>
          </td>
	  </tr>
		<tr>
		  <td class="formulario" colspan="2">
		  	Observações:<br>
		  	<textarea name="Obs" cols="30" rows="6"><?php echo $agenda->Obs; ?></textarea>
		  </td>
		</tr>
		<tr>
			<td colspan="2">
				<div align="right">
				  <input type="hidden" name="id" value="<?php echo $agenda->Id; ?>">
                  <input type="submit" value="Enviar!">		
			  </div></td>
		</tr>
	</table>
</form>
</body>
</html>
