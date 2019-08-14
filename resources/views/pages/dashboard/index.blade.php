
@extends('layouts.app')

@section('content')

<div class="row">

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Proyek</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"> {{$countt}}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-door-open fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Proyek Aktif</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$aktif}}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-warehouse fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Proyek Non Aktif</div>
            <div class="row no-gutters align-items-center">
              <div class="col-auto">
                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$nonaktif}}</div>
              </div>
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-house-damage fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Pending Requests Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"><a href="{{ route('approval.index') }}" style="text-decoration: none; color: #edbf05;">Pending Requests Approval</a></div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$pengajuan}}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-comments fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">

  <div class="col-xl-8 col-md-8 mb-6">
    <div class="card shadow mb-6">
       <div class="form-group">
        <div class="card-header py-2">
         <form method="GET">
          <label for="exampleFormControlInput1" class="m-0 font-weight-bold text-primary"><b> Search</b></label>
          <select class="selectpicker form-control col-md-4" data-live-search="true" id="id_rab" name="id_rab" onchange="this.form.submit()">
            <option></option>
            <option></option>
            @foreach($rab as $r)
            <option  value="{{ $r->id_rab }}" style="font-size: 12px">{{ $r->nama_rab }}</option>
            @endforeach
          </select>
        </form>
      </div>  
      <canvas id="myBarchart"></canvas>
  </div>
  </div>
</div>



</div> <!-- Tutup Row -->

<div id="mytable">

</div>
   
@endsection
@section('script')

  <script>
    var randomScalingFactor = function() {
      return Math.round(Math.random() * 100);
    };

    var label = [];
    var rab = [];
    var realisasi = []
    @foreach($date as $i => $d)
      label[{{ $i }}] = '{{ $d["date"] }}';
      rab[{{ $i }}] = '{{ $d["rab"] }}';
      realisasi[{{ $i }}] = '{{ $d["realisasi"] }}';
    @endforeach

    console.log(label);
    var config = {
      type: 'line',
      data: {
        labels: label,
        datasets: [{
          label: 'Plan',
          fill: false,
          backgroundColor: '#eb4034',
          borderColor: '#eb4034',
          data: rab
        }, {
          label: 'Actual',
          fill: false,
          backgroundColor: '#5367cf',
          borderColor: '#5367cf',
          data: realisasi,
        }]
      },
      options: {
        responsive: true,
        title: {
          display: true,
          text: 'Realisasi Proyek'
        },
      }
    };

    window.onload = function() {
      var ctx = document.getElementById('myBarchart').getContext('2d');
      window.myLine = new Chart(ctx, config);
    };


  
  </script>

<script type="text/javascript">
   var ctx = document.getElementById('myPieChart');
var myPieChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
  
});
</script>
@endsection