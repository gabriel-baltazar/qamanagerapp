@extends('layouts.main', ['activePage' => 'tasks', 'titlePage' => 'Editar Tarefa'])
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <form method="POST" action="{{ route('tasks.update', $task->id) }}" class="form-horizontal">
          @csrf
          @method('PUT')
          <div class="card">
            <!--Header-->
            <div class="card-header card-header-info">
              <h4 class="card-title">Editar tarefa</h4>
              <p class="card-category">Editar dados da tarefa</p>
            </div>
            <!--End header-->
            <!--Body-->
            <div class="card-body">
              <div class="row">
                    <div class="col-sm-6">
                      <label for="title" class="form-label">Titulo da tarefa</label>
                      <input type="text" class="form-control" name="title" placeholder="Titulo"
                      value="{{ old('title', $task->title) }}" autocomplete="off" autofocus>
                    </div>
                    <div class="col-sm-6">
                      <label for="description" class="form-label">Descrição da tarefa</label>
                      <input type="text" class="form-control" name="description" placeholder="Descrição"
                        value="{{ old('description', $task->description) }}" autocomplete="off" autofocus>
                    </div>
                </div>
            </div>
            <!--End body-->
            <!--Footer-->
            <div class="card-footer ml-auto mr-auto">
              <button type="submit" class="btn btn-primary">Atualizar</button>
            </div>
          </div>
          <!--End footer-->
        </form>
      </div>
    </div>
  </div>
</div>
@endsection