@extends('layout.main')


@section('styles')




@endsection





@section('content')







                            <!-- Page Heading -->


                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800">Stat Projet<a href="/projet/{{$project->id}}">{{$project->id}}</a> :</h1>

                            </div>

                            <!-- Content Row -->
                            <div class="row">

                                <!-- Pending Requests Card Example -->
                                <div class="col">
                                    <div class="card ">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col ">


                                                    <div>
                                                        <canvas id="lineChart"></canvas>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

                            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>

                            <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/mdbootstrap@4.5.14/js/mdb.min.js"></script>


                            <script type="text/javascript">

                            let dates=[];
                             Array.prototype.push.apply(dates,@json($dates));

                             let vis=[];
                             Array.prototype.push.apply(vis,@json($vis));

                             let reac=[];
                             Array.prototype.push.apply(reac,@json($reac));

                             let avan=[];
                             Array.prototype.push.apply(avan,@json($avan));

                            var ctxL = document.getElementById("lineChart").getContext('2d');
                            var myLineChart = new Chart(ctxL, {
                                type: 'line',
                                data: {
                                labels: dates,
                                datasets: [{
                                    label: "Visibilite",
                                    data: vis,
                                    fill: false,
                                    borderColor: [
                                        'blue',
                                    ],
                                    borderWidth: 5
                                    },
                                    {
                                    label: "Reactivite",
                                    data: reac,
                                    fill: false,
                                    borderColor: [
                                        'red',
                                    ],
                                    borderWidth: 5
                                    },

                                    {
                                    label: "Avancement",
                                    data: avan,
                                    fill: false,
                                    borderColor: [
                                        'green',
                                    ],
                                    borderWidth: 5
                                    }
                                ]
                                },


                                options: {
                                    responsive:true,
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

                                }
                            });
                            </script>
@endsection

