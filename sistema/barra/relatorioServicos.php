<?php
	include "kernel.martha_sys.inc.php";
	if(!isLogged()) {
		die("sessão não iniciada");
	}
	Nivel(2);
	$data_inicio = isset($_POST["data_inicio"]) ? $_POST["data_inicio"] : "01/" . date("m/Y", strtotime("today"));
	$data_fim = isset($_POST["data_fim"]) ? $_POST["data_fim"] : date("d/m/Y", strtotime("today"));
//	$mvts = getMovimentacoesPeriodo($data_inicio,$data_fim,'','');
	unset($busca_pars);
	$busca_pars['data_inicio'] = $data_inicio;
	$busca_pars['data_fim'] = $data_fim;
	$busca_pars['receitas'] = "todas";
	$busca_pars['despesas'] = 0;	
	connect();
	$mvts = getReceitasPeriodo($data_inicio,$data_fim,"");
	disconnect();
	usort($mvts, "cmp"); 
	$total_servs = 0;
	$qtde_servs = 0;
	unset($acum_servicos);
?>
<html>
<head>
<title>MarthaHair - Sistema</title>
<link rel="stylesheet" href="martha_sys.css" type="text/css">
<script language="javascript">
function enviaForm(action_url,confirma) {
	var envia = true;
	if(confirma)
		envia = confirm("Tem certeza?");
	if(envia)
		window.location = action_url;
}

</script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="carregar.js"></script>
</head>
<body>
<form action="relatorioServicos.php" method="post">
&nbsp;&nbsp;&nbsp;
Período: de <input type="text" name="data_inicio" size="10" value="<?=$data_inicio?>"> a <input type="text" name="data_fim" size="10" value="<?=$data_fim?>">
<input type="submit" value="gerar relatório">		

</form>
<h3 class="titulo_secao">Extrato - período: <?=$data_inicio?> a <?=$data_fim?></h3>

<table cellpadding="1" cellspacing="0">
	<tr>
    	<td class="formulario">Id</td>
    	<td class="formulario">Usuário</td>
    	<td class="formulario">Data</td>
    	<td class="formulario">Cliente</td>
       	<td class="formulario" width="250">Serviço</td>
    	<td class="formulario">Valor</td>

	</tr><?php foreach($mvts as $item) {
			extract($item);
			$usuario = getUsuario($IdUsuario);
			$usuario = $usuario["Nome"]; 
			$conta="";
			$cliente = getCliente($IdCliente);
			$cliente = $cliente["Nome"] . " " . $cliente["Sobrenome"]; 
			unset($servs);
			$servs_nome = explode('||',$ServicosNomes);
			$servs_valor = explode('||',$ServicosValores);
			for($i=0;$i<sizeof($servs_nome);$i++) {
				if($servs_valor[$i]!=0) {
					$total_servs += $servs_valor[$i];
					$qtde_servs += 1;
					$acum_servicos[$servs_nome[$i]]['Valor'] += $servs_valor[$i];
					$acum_servicos[$servs_nome[$i]]['Qtde'] += 1;					
			?>       
                <tr>
                    <td class="tabela_pqno"><?=$Id?></td>
                    <td class="tabela_pqno"><?=$usuario?></td>
                    <td class="tabela_pqno"><?=date("d/m/Y", strtotime($DataTransacao));?></td>
                    <td class="tabela_pqno"><?=$cliente?></td>
                    <td class="tabela_pqno"><?=$servs_nome[$i]?></td>
                    <td class="tabela_pqno"><?=number_format($servs_valor[$i], 2, ',','.')?></td>
                </tr>
			<?php 
				}
			}
			} 
	?>
    <tr>
    	<td colspan="5" align="right"><b>Total no período</b></td>
   		<td><b>R$ <?=number_format($total_servs, 2, ',','.')?></b></td>
    </tr>
</table>
<br><br>

<h3 class="titulo_secao">Totais por serviço</h3>
<table>
	<tr>
    	<td class="formulario">Serviço</td>
        <td class="formulario">Quantidade</td>
        <td class="formulario">Total</td>
        <td class="formulario">Média</td>
    </tr>
<?php
	foreach($acum_servicos as $c => $s) {
	?>
    	<tr>
            <td class="formulario"><?=$c?></td>
            <td class="formulario"><?=$s['Qtde']?></td>
            <td class="formulario"><?=number_format($s['Valor'],2,',','.')?></td>        
            <td class="formulario"><?=number_format($s['Valor']/$s['Qtde'],2,',','.')?></td>
		</tr>
    <?php		
	}
?>
    	<tr>
            <td><b>TOTAL</b></td>
            <td><b><?=$qtde_servs?></b></td>
            <td><b>R$ <?=number_format($total_servs,2,',','.')?></b></td>        
            <td><b>R$ <?=number_format($total_servs/$qtde_servs,4,',','.')?></b></td>
		</tr>
</table>
</body>
</html>

