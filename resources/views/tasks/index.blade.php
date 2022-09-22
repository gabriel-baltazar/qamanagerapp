@extends('layouts.main', ['activePage' => 'tasks', 'titlePage' => 'Tarefas'])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-info">
            <h4 class="card-title">Tarefas</h4>
            <p class="card-category">Lista de tarefas</p>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-12 text-right">
                @can('task_create')
                <a href="{{ route('tasks.create') }}" class="btn btn-sm btn-facebook">Nova Tarefa</a>
                @endcan
              </div>
            </div>
            <div class="table-responsive">
              <table class="table ">
                <thead class="text-dark">
                  <th> ID </th>
                  <th> Titulo </th>
                  <th> Descrição </th>
                  <th> Status </th>
                  <th> Criado por </th>
                  <th> Criado em </th>
                  <th> Fechado em </th>
                  <th class="text-right"> Ações </th>
                </thead>
                <tbody>
                  @forelse ($tasks as $task)
                  <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ $task->_status() }}</td>
                    <td>{{ $task->user->name }}</td>
                    <td class="text-dark">{{ $task->created_at->toFormattedDateString() }}</td>
                    <td class="text-dark">@if($task->closed_at){{ $task->closed_at->toFormattedDateString() }}@endif</td>
                    <td class="td-actions text-right">
                    @can('task_show')
                      <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-info"> <i
                          class="material-icons">person</i> </a>
                    @endcan
                    @can('task_edit')
                      <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning"> <i
                          class="material-icons">edit</i> </a>
                    @endcan
                    @can('task_destroy')
                      <form action="{{ route('tasks.destroy', $task->id) }}" method="post"
                        onsubmit="return confirm('Deseja realmente excluir?')" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" rel="tooltip" class="btn btn-danger">
                          <i class="material-icons">close</i>
                        </button>
                      </form>
                      @endcan
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="2">Sem registros.</td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
              {{-- {{ $users->links() }} --}}
            </div>
          </div>
          <!--Footer-->
          <div class="card-footer mr-auto">
            {{ $tasks->links() }}
          </div>
          <!--End footer-->
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
