<div class="table-responsive text-center">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">Nome do solicitante</th>
        <th scope="col">Turma</th>
        <th scope="col">Nome da escola</th>
        <th scope="col">Data de registro</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $cmdsql = "
          SELECT S.nome, T.num_turma, E.nome, S.data_registro FROM solicitações S INNER JOIN turmas T ON S.codigo_turma = T.codigo INNER JOIN escolas E ON T.codigo_escola = E.codigo WHERE S.status = 1 ORDER BY E.nome
        ";
        $execsql = mysqli_query($linkmy, $cmdsql);
        while($registro = mysqli_fetch_array($execsql)) { ?>
          <tr>
            <td><?= $registro[0] ?></td>
            <td><?= $registro[1] ?></td>
            <td><?= $registro[2] ?></td>
            <td><?= date_format(new DateTime($registro['3']), "d/m/Y"); ?></td>
          </tr>
      <?php } ?>
    </tbody>
  </table>
</div>   