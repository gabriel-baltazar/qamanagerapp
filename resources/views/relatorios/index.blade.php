@extends('layouts.main', ['activePage' => 'relatorio','titlePage' => 'Tarefa'])
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <!--Header-->
          <div class="card-header card-header-info">
            <h4 class="card-title">Relatórios</h4>
            <p class="card-category">Emitir relatorio das tarefas</p>
          </div>
          <!--End header-->
          <!--Body-->
          <div class="card-body">
            <div class="row">
              <!-- first -->
              <div class="col-md-4">
                <div>
                  <h4>Tarefas</h4>
                  <form method="POST" action="{{route('relatorios.export')}}" target="_blank">
                    @csrf
                    @method('POST')
                    <input name="tipo" type="text" value="tarefa" hidden>

                    <div>
                      <label class="form-label" for="formato">Formato</label>
                        <select class="form-control" name="formato" id="formato">
                          <option value="0">Selecione o formato</option>
                          <option value="pdf">PDF</option>
                          <option value="excel">Excel</option>
                        </select>
                    </div>
                    <div>
                      <label class="form-label" for="date_fim">De</label>
                      <input type="date" class="form-control" name="date_ini">
                    </div>
                    <div>
                      <label class="form-label" for="date_fim">Até</label>
                      <input type="date" class="form-control" name="date_fim">
                    </div>
                    <div>
                      <label class="form-label" for="user_id">Filtrar por usuário</label>
                      <select class="form-control" name="user_id" id="user_id">
                        <option value="0">Selecione</option>
                        @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                      </select>
                    </div>
                    <button type="submit" class="btn btn-warning btn-sm">Emitir relatório</button>
                  </form>
                </div>
              </div>
              <div class="col-md-4">
                <div>
                  <h4>Cronometros</h4>
                  <form method="POST" action="{{route('relatorios.export')}}" target="_blank">
                    @csrf
                    @method('POST')
                    <input name="tipo" type="text" value="cronometro" hidden>
                    <div>
                      <label class="form-label" for="formato">Formato</label>
                        <select class="form-control" name="formato" id="formato">
                          <option value="0">Selecione o formato</option>
                          <option value="pdf">PDF</option>
                          <option value="excel">Excel</option>
                        </select>
                    </div>
                    <div>
                      <label class="form-label" for="date_fim">De</label>
                      <input type="date" class="form-control" name="date_ini">
                    </div>
                    <div>
                      <label class="form-label" for="date_fim">Até</label>
                      <input type="date" class="form-control" name="date_fim">
                    </div>
                    <button type="submit" class="btn btn-warning btn-sm">Emitir relatório</button>
                  </form>
                </div>
              </div>
            </div>
            <!--end first-->
          </div>
          <!--end row-->
        </div>
        <!--End card body-->
      </div>
      <!--End card-->
    </div>
  </div>
</div>
</div>
@endsection