<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PDF</title>
</head>
<body>
  <h1>Cronometros</h1>
  <table border="1">
    <thead>
      <tr>
        <th>Tarefa</th>
        <th>Sessão</th>
        <th>Tempo</th>
        <th>Criado em</th>
      </tr>
    </thead>
    <tbody>
    @foreach($stopwatches as $stopwatch)
      <tr>
        <td>{{$stopwatch->task_id}}</td>
        <td>{{$stopwatch->session}}</td>
        <td>{{$stopwatch->time}}</td>
        <td>{{$stopwatch->created_at->toFormattedDateString()}}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
</body>
</html>