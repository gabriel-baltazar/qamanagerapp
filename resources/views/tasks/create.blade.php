@extends('layouts.main', ['activePage' => 'tasks', 'titlePage' => 'Nova Tarefa'])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <form method="POST" action="{{ route('tasks.store') }}" class="form-horizontal">
          @csrf
          <div class="card ">
            <!--Header-->
            <div class="card-header card-header-info">
              <h4 class="card-title">Tarefa</h4>
              <p class="card-category">Inserir dados da nova tarefa</p>
            </div>
            <!--End header-->
            <!--Body-->
              <div class="card-body">
                <div class="row">
                    <label for="title" class="col-sm-2 col-form-label">Titulo da tarefa</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" name="title" placeholder="Titulo"
                        autocomplete="off" autofocus>
                    </div>
                </div>
                <div class="row">
                    <label for="description" class="col-sm-2 col-form-label">Descrição da tarefa</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" name="description" placeholder="Descrição"
                          autocomplete="off" autofocus>
                    </div>
                </div>
                <div class="row">
                    <label for="description" class="col-sm-2 col-form-label">Responsavel</label>
                    <div class="col-sm-6">
                      <select class="form-control" name="responsible_id">
                        <option value="0">Selecionar responsavel</option>
                        @foreach ($users as $user)
                          <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                      </select>
                    </div>
                </div>
              </div>
            </div>

            <!--End body-->

            <!--Footer-->
            <div class="card-footer ml-auto mr-auto">
              <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
            <!--End footer-->
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection