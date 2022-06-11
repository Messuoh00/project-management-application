@extends('layout.main')


@section('styles')




@endsection





@section('content')


                    <!-- Page Heading -->



                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800">Statistiques:</h1>
                                @if ($errors->any())
                                <div><h4 style="color: red">{{$errors}}</h4></div>
                                @endif
                            </div>

                            <form action="stat" method="get" enctype="multipart/form-data">
                                @csrf

                            <div class="form">


                                <div class="form-content">
                                    <div class="row">



                                        <div class="col-md-3">
                                        <div class="form-group">
                                            <h6 class="mb-0">  mois:</h6>
                                            <input type="month" class=" form-control"  value="{{request('month')}}" pattern="\d{2}-\d{2}"  name="month">
                                        </div>
                                        </div>




                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h6 class="mb-0">  Phase:</h6>
                                                @php
                                                     $ph=App\Models\Phase::orderBy('position')->get()->whereNotNull('position');

                                                @endphp
                                                <select class="custom-select form-control "   name="phase" >


                                                    @foreach ($ph as $p)
                                                     <option value={{$p->position}}  @if(request('phase')==$p->position) selected @endif >{{$p->name}}</option>
                                                    @endforeach
                                                    <option disabled  @if(!is_numeric(request('phase'))) selected @endif> ---- </option>
                                                </select>

                                        </div>
                                        </div>



                                        <div class="col-md-3">
                                        <div class="form-group">
                                            <h6 class="mb-0">  Structure pilote:</h6>
                                            <select class="custom-select form-control "   name="stp" >
                                                <option disabled selected > ---- </option>
                                                @foreach ($dep as $d)
                                                 <option value={{$d->id}} @if(request('stp')==$d->id) selected @endif >{{$d->nomdep}}</option>
                                                @endforeach
                                              </select>

                                        </div>
                                        </div>


                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h6 class="mb-0">Etude echo:</h6>
                                                <select class="custom-select form-control "   name="echo" >
                                                    <option disabled selected > ---- </option>
                                                     <option value="na"  @if(request('echo')=="na") selected @endif>na</option>
                                                     <option value="oui"  @if(request('echo')=="oui") selected @endif>oui</option>
                                                     <option value="non"  @if(request('echo')=="non") selected @endif>non</option>


                                                  </select>

                                        </div>
                                        </div>




                                    </div>


                                </div>


                            </div>

                            <button type="submit" class="btn btn-sm btn-primary shadow-sm" name="filt" style="float: right">confirme</button>

                            <a href="/stat" class="btn btn-sm btn-primary shadow-sm" style="float: right;margin-right:13px">reset</a>
                            <br><br>
                        </form>

                        <div class="row"  >

                            <div class="col-xl-9 col-lg-7">


                                <!-- Bar Chart -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Projet :</h6>
                                    </div>
                                    <div class="card-body" >
                                        <div class="chart-bar"style="height: 100%">
                                            <canvas id="bar-chart-grouped" style="max-height: 100%"></canvas>
                                        </div>


                                    </div>
                                </div>


                            </div>

                            <!-- Donut Chart -->
                            <div class="col-xl-3 col-lg-5">
                                <div class="card shadow mb-4" >
                                    <!-- Card Header - Dropdown -->
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Nombre Projet :</h6>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <div class="chart-pie pt-4">
                                            <canvas id="myPieChart"></canvas>
                                        </div>
                                        <div class="mt-4 text-center small">

                                            @php
                                                $colors=array("","text-primary","text-secondary","text-success","text-danger","text-warning","text-info");
                                            @endphp
                                            @foreach ($phases as $item)


                                            <span class="mr-2">
                                                <i class="fas fa-circle {{next($colors)}}"></i> {{$item}}
                                            </span>

                                            @endforeach

                                        </div>
                                    </div>
                                </div>


                            </div>

                        </div>







                            <!-- Page level plugins -->
                            <script src="vendor/chart.js/Chart.min.js"></script>



                            <!-- Page level plugins -->
                            <script src="vendor/chart.js/Chart.min.js"></script>



                            <script>




                             let phases=[];

                             Array.prototype.push.apply(phases,@json($phases));



                            let counts=[];

                             Array.prototype.push.apply(counts,@json($counts));



                             let names=[];
                             Array.prototype.push.apply(names,@json($names));

                             let vis=[];
                             Array.prototype.push.apply(vis,@json($vis));

                             let reac=[];
                             Array.prototype.push.apply(reac,@json($reac));

                             let avan=[];
                             Array.prototype.push.apply(avan,@json($avan));

                             var  ctxbar = document.getElementById("myPieChart");
                              var bar= new Chart(document.getElementById("bar-chart-grouped"), {
                                type: 'bar',
                                data: {
                                labels: names,

                                datasets: [
                                    {
                                    label: "Visibilite",
                                    backgroundColor: "blue",
                                    data: vis
                                    },

                                    {
                                    label: "Reactivite",
                                    backgroundColor: "red",
                                    data: reac
                                    },

                                    {
                                    label: "Avancement",
                                    backgroundColor: "green",
                                    data: avan
                                    }

                                ]
                                },
                                options: {

                                    scales: {
                                            xAxes: [{


                                                ticks: {

                                                },

                                            }],
                                            yAxes: [{
                                                ticks: {
                                                min: 0,
                                                max: 100,

                                                },

                                            }],
                                        },

                                title: {
                                    display: true,
                                    text: 'avancement projet'

                                }


                                }
                            });


                            </script>


                            <script>
                                // Set new default font family and font color to mimic Bootstrap's default styling
                            Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                            Chart.defaults.global.defaultFontColor = '#858796';

                            // Pie Chart Example
                            var ctx = document.getElementById("myPieChart");
                            var myPieChart = new Chart(ctx, {
                            type: 'doughnut',
                            data: {
                                labels:phases,
                                datasets: [{
                                data:counts,
                                backgroundColor: ['blue', 'grey', 'green', 'red','yellow','#78cceb','black'],
                                hoverBackgroundColor:  ['blue', 'grey', 'green', 'red','yellow','#78cceb','black'],
                                hoverBorderColor: "rgba(234, 236, 244, 1,69)",
                                }],
                            },
                            options: {
                                maintainAspectRatio: false,
                                tooltips: {
                                backgroundColor: "rgb(255,255,255)",
                                bodyFontColor: "#858796",
                                borderColor: '#dddfeb',
                                borderWidth: 1,
                                xPadding: 15,
                                yPadding: 15,
                                displayColors: false,
                                caretPadding: 10,
                                },
                                legend: {
                                display: false
                                },
                                cutoutPercentage: 10,
                            },
                            });



                            </script>




@endsection

