<?php require_once '../../_scripts/utilidades/connection.php' ?>
<?php require_once 'session.php' ?>

<?php

	$codigo_solicitação = $_GET['codigo_solicitação'];

	$comida = 0;
	$bebida = 0;
	$sono = 0;
	$banheiro = 0;
	$participacao_sala = 0;
	$participacao_livre = 0;
	$relacionamento = 0;

	$cmdsql = "
		SELECT * FROM integração I INNER JOIN matriculas M
	    ON I.codigo_matricula = M.codigo INNER JOIN solicitações S
	    ON M.codigo_solicitação = S.codigo WHERE S.codigo = $codigo_solicitação
	    ORDER BY I.data_registro DESC
	";

	$execsql = mysqli_query($linkmy, $cmdsql);
	while($registro = mysqli_fetch_array($execsql)) {
		if($registro['comida'] == 'Sim') {
			$comida++;
		}

		if($registro['bebida'] == 'Sim') {
			$bebida++;
		}

		if($registro['sono'] == 'Sim') {
			$sono++;
		}

		if($registro['banheiro'] == 'Sim') {
			$banheiro++;
		}

		if($registro['participação_sala'] == 'Sim') {
			$participacao_sala++;
		}

		if($registro['participação_livre'] == 'Sim') {
			$participacao_livre++;
		}

		if($registro['relacionamento'] == 'Sim') {
			$relacionamento++;
		}
	}

	$cmdsql = "
		SELECT COUNT(*) FROM integração I INNER JOIN matriculas M
	    ON I.codigo_matricula = M.codigo INNER JOIN solicitações S
	    ON M.codigo_solicitação = S.codigo WHERE S.codigo = $codigo_solicitação
	";
	$execsql = mysqli_query($linkmy, $cmdsql);
	$result = mysqli_fetch_array($execsql);
	$total = $result[0];

	if($total == 0) {
		$total = 1;
	}

	$comida = ($comida / $total) * 100;
	$bebida = ($bebida / $total) * 100;
	$sono = ($sono / $total) * 100;
	$banheiro = ($banheiro / $total) * 100;
	$participacao_sala = ($participacao_sala / $total) * 100;
	$participacao_livre = ($participacao_livre / $total) * 100;
	$relacionamento = ($relacionamento / $total) * 100;
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Relatório</title>

    <style type="text/css">
    	.title {
    		font-size: 0.8rem;
    		font-weight: 500;
    		margin-bottom: 5px;
    	}
    </style>
  </head>
  <body>
  	<?php
  		$cmdsql = "
  			SELECT E.nome, S.nome, P.nome, T.num_turma, T.periodo FROM solicitações S INNER JOIN matriculas M
			ON S.codigo = M.codigo_solicitação INNER JOIN turmas T
			ON T.codigo = M.codigo_turma INNER JOIN professores P
			ON P.codigo = T.codigo_professor INNER JOIN escolas E
			ON E.codigo = T.codigo_escola WHERE S.codigo = $codigo_solicitação
  		";
  		$execsql = mysqli_query($linkmy, $cmdsql);
  		$result = mysqli_fetch_array($execsql);
  	?>
  	<div class="container my-4">
  		<div class="row">
  			<div class="col-md-4">
  				<div class="card">
  				<div class="card-header"><b>Informações do aluno</b></div>
				  <ul class="list-group list-group-flush">
				    <li class="list-group-item"><span class="h6">Nome</span>: <span class=""><?= $result[1] ?></span></li>
				    <li class="list-group-item"><span class="h6">Escola</span>: <span class=""><?= $result[0] ?></span></li>
				    <li class="list-group-item"><span class="h6">Professor</span>: <span class=""><?= $result[2] ?></span></li>
				    <li class="list-group-item"><span class="h6">Turma</span>: <span class=""><?= $result[3] ?> / <?= $result[4] ?></span></li>
				  </ul>
				</div>
  			</div>

  			<div class="col-md-8">
  				<div class="card">
  					<div class="card-header"><b>Dados estatistícos</b></div>
  					<div class="card-body">
  						<span class="title">Comeu?</span>
		  				<div class="progress">
						  <div class="progress-bar bg-primary" role="progressbar" style="width: <?= $comida ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?= number_format($comida, 0, ',','.'); ?>%</div>
						</div>

						<span class="title">Bebeu?</span>
						<div class="progress">
						  <div class="progress-bar bg-secondary" role="progressbar" style="width: <?= $bebida ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?= number_format($bebida, 0, ',','.'); ?>%</div>
						</div>

						<span class="title">Dormiu?</span>
						<div class="progress">
						  <div class="progress-bar bg-success" role="progressbar" style="width: <?= $sono ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?= number_format($sono, 0, ',','.'); ?>%</div>
						</div>

						<span class="title">Usou o banheiro?</span>
						<div class="progress">
						  <div class="progress-bar bg-danger" role="progressbar" style="width: <?= $banheiro ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?= number_format($banheiro, 0, ',','.'); ?>%</div>
						</div>

						<span class="title">Participou das atividades na sala?</span>
						<div class="progress">
						  <div class="progress-bar bg-warning" role="progressbar" style="width: <?= $participacao_sala ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?= number_format($participacao_sala, 0, ',','.'); ?>%</div>
						</div>

						<span class="title">Participou das atividades ao ar livre?</span>
						<div class="progress">
						  <div class="progress-bar bg-dark" role="progressbar" style="width: <?= $participacao_livre ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?= number_format($participacao_livre, 0, ',','.'); ?>%</div>
						</div>

						<span class="title">Brincou com outros alunos?</span>
						<div class="progress">
						  <div class="progress-bar bg-info" role="progressbar" style="width: <?= $relacionamento ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?= number_format($relacionamento, 0, ',','.'); ?>%</div>
						</div>
  					</div>
  				</div>
  			</div>
  		</div>
  	</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>