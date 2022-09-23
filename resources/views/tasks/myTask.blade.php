@extends('layouts.main', ['activePage' => '','titlePage' => 'Tarefa'])
@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <!--Header-->
          <div class="card-header card-header-info">
            <h4 class="card-title">Tarefa</h4>
            <p class="card-category">Detalhes</p>
          </div>
          <!--End header-->
          <!--Body-->
          <div class="card-body">
            <div class="row">
              <!-- first -->
              <div class="col-md-4">
                <div class="card card-user">
                  <div class="card-body">
                    <p class="card-text">
                    <div class="author" style="height: 192px;">
                      <div class="block block-one"></div>
                      <div class="block block-two"></div>
                      <div class="block block-three"></div>
                      <div class="block block-four"></div>
                      <h5 class="title mt-3">{{ $task->title }}</h5>
                      <p class="description">
                        <b>Status:</b> {{ $task->_status() }} <br>
                        <b>Criado em:</b> {{ $task->created_at }} <br>
                        <b>Description:</b> {{ $task->description }} <br>
                      </p>
                    </div>
                    </p>
                  </div>
                  <div class="card-footer">
                    <br><br><br>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
              <div class="card card-user">
                  <div class="card-body">
                    <p class="card-text">
                    <div class="author" style="height: 200px;overflow: scroll;">
                      <table class="table">
                        <thead class="fixed">
                          <tr>
                            <th>Sessão</th>
                            <th>Tempo</th>
                          </tr>
                        </thead>
                        <tbody id="stopwatch-table">
                          @foreach($stopwatches as $stopwatch)
                            <tr>
                              <td>{{$stopwatch->session}}</td>
                              <td>{{$stopwatch->time}}</td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    </p>
                  </div>
                  <div class="card-footer">
                    <div class="block mx-auto" id="chrono">
                      <div class="text-center values stopwatch-time">00:00:00</div>
                      <div>
                        <button class="btn btn-success btn-sm startButton">Start</button>
                        <button class="btn btn-warning btn-sm pauseButton">Pause</button>
                        <button class="btn btn-info btn-sm stopButton" onclick="saveStopwatch()">Salvar</button>
                      </div>
                    </div>
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
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/easytimer@1.1.1/src/easytimer.min.js"></script>
<script>
var timer = new Timer();
$('#chrono .startButton').click(function () {
    timer.start();
});

$('#chrono .pauseButton').click(function () {
    timer.pause();
});


timer.addEventListener('secondsUpdated', function (e) {
    $('#chrono .values').html(timer.getTimeValues().toString());
});

timer.addEventListener('started', function (e) {
    $('#chrono .values').html(timer.getTimeValues().toString());
});

function saveStopwatch(){
  var stopwatchTime = $('.stopwatch-time').html()
  var _token = $('meta[name="csrf-token"]').attr('content');
  $.ajax({
    url: "{{ route('stopwatches.store') }}",
    type:"POST",
    data:{
      _token:_token,
      task_id: {{ $task->id }},
      time: stopwatchTime
    },
    success:function(response){
      if(response) {
        $('.stopwatch-time').html('00:00:00')
        timer.stop()
        $('#stopwatch-table').append('<tr><td>'+response.session+'</td><td>'+response.time+'</td></tr>')
      }
    },
  });
}
</script>
@endpush