<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PDF</title>
</head>
<body>
  <h1>Tarefas</h1>
  <table border="1">
    <thead>
      <tr>
        <th>#</th>
        <th>Titulo</th>
        <th>Status</th>
        <th>Descrição</th>
        <th>Data de criação</th>
        <th>Data de atualização</th>
        <th>Data de fechamento</th>
        <th>Responsavel</th>
      </tr>
    </thead>
    <tbody>
    @foreach($tasks as $task)
      <tr>
        <td>{{ $task->id }}</td>
        <td>{{$task->title}}</td>
        @switch($task->status)
          @case(0)
            <td>Em aberto</td>
            @break
          @case(1)
            <td>Cancelada</td>
            @break
          @case(2)
            <td>Finalizada</td>
            @break
        @endswitch
        <td>{{$task->description}}</td>
        <td>{{$task->created_at}}</td>
        <td>{{$task->updated_at}}</td>
        <td>{{$task->closed_at}}</td>
        <td>{{$task->responsible_name}}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
  
  
</body>
</html>