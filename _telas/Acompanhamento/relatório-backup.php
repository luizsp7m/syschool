<?php require_once '../../_scripts/utilidades/connection.php' ?>

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
  	<div class="container my-4 text-center">
  		<p><b>Nome do aluno: </b><?= $result[1] ?></p>
  		<p><b>Nome da escola: </b><?= $result[0] ?></p>
  		<p><b>Nome do professor: </b><?= $result[2] ?></p>
  		<p><b>Turma: </b><?= $result[3] ?></p>
  		<p><b>Período: </b><?= $result[4] ?></p>

  		<span>Comida: <?= number_format($comida, 1, ',','.'); ?>%</span>
  		<div class="progress">
		  <div class="progress-bar progress-bar-striped" role="progressbar" style="width: <?= $comida ?>%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
		</div><br>

		<span>Bebida: <?= number_format($bebida, 1, ',','.'); ?>%</span>
		<div class="progress">
		  <div class="progress-bar progress-bar-striped" role="progressbar" style="width: <?= $bebida ?>%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
		</div><br>

		<span>Sono: <?= number_format($sono, 1, ',','.'); ?>%</span>
		<div class="progress">
		  <div class="progress-bar progress-bar-striped" role="progressbar" style="width: <?= $sono ?>%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
		</div><br>

		<span>Banheiro: <?= number_format($banheiro, 1, ',','.'); ?>%</span>
		<div class="progress">
		  <div class="progress-bar progress-bar-striped" role="progressbar" style="width: <?= $banheiro ?>%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
		</div><br>

		<span>Participação em sala: <?= number_format($participacao_sala, 1, ',','.'); ?>%</span>
		<div class="progress">
		  <div class="progress-bar progress-bar-striped" role="progressbar" style="width: <?= $participacao_sala ?>%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
		</div><br>

		<span>Participação livre: <?= number_format($participacao_livre, 1, ',','.'); ?>%</span>
		<div class="progress">
		  <div class="progress-bar progress-bar-striped" role="progressbar" style="width: <?= $participacao_livre ?>%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
		</div><br>

		<span>Relacionamento com os outros alunos: <?= number_format($relacionamento, 1, ',','.'); ?>%</span>
		<div class="progress">
		  <div class="progress-bar progress-bar-striped" role="progressbar" style="width: <?= $relacionamento ?>%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
  	</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>