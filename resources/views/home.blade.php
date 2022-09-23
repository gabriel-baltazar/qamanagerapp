@extends('layouts.main', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header card-header-danger">
                        <h4 class="card-title">Tarefas</h4>
                        <p class="category">Tarefas em aberto</p>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Titulo</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-right">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tasks as $task)
                                <tr>
                                    <td>{{$task->title}}</td>
                                    <td class="text-center">{{$task->_status()}}</td>
                                    <td class="td-actions text-right">
                                    <form action="{{ route('tasks.getTask', $task->id) }}" method="post" class="form-horizontal">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" rel="tooltip" class="btn btn-info">
                                            <i class="material-icons">forward</i>
                                        </button>
                                    </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2">Sem registros.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header card-header-danger">
                        <h4 class="card-title">Minhas Tarefas</h4>
                        <p class="category">Tarefas a fazer</p>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Titulo</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Cronometro</th>
                                    <th class="text-right">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($myTasks as $task)
                                <tr>
                                    <td>{{$task->title}}</td>
                                    <td class="text-center">{{$task->_status()}}</td>
                                    <td class="text-center">
                                        <div id="chronoExample">
                                            <div class="values">00:00:00</div>
                                            <div>
                                                <button class="btn btn-success btn-sm startButton">Start</button>
                                                <button class="btn btn-warning btn-sm pauseButton" >Pause</button>
                                                <button class="btn btn-danger btn-sm stopButton">Stop</button>
                                                <!-- <button class="btn btn-info btn-sm resetButton">Reset</button> -->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" class="btn btn-success">
                                            <i class="material-icons">done</i>
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2">Sem registros.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="lib/easytimer/dist/easytimer.min.js"></script>
<script>
    var timerInstance = new easytimer.Timer();
</script>
<script>
    var timer = new Timer();
$('#chronoExample .startButton').click(function () {
    timer.start();
});

$('#chronoExample .pauseButton').click(function () {
    timer.pause();
});

$('#chronoExample .stopButton').click(function () {
    timer.stop();
});

$('#chronoExample .resetButton').click(function () {
    timer.reset();
});

timer.addEventListener('secondsUpdated', function (e) {
    $('#chronoExample .values').html(timer.getTimeValues().toString());
});

timer.addEventListener('started', function (e) {
    $('#chronoExample .values').html(timer.getTimeValues().toString());
});

timer.addEventListener('reset', function (e) {
    $('#chronoExample .values').html(timer.getTimeValues().toString());
});
</script>
@endpush