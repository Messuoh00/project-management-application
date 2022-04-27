@extends('layout.main')


@section('styles')




@endsection





@section('content')




@php

$nomphase = array("Idee R/D Non Valider", "Idee R/D", "Maturation", "Recherche(En cours)",'Recherche(En TEST)','En implementation','En exploitation','');

@endphp


                            <!-- Page Heading -->


                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800">Statistique:</h1>
                                @if ($errors->any())
                                <div><h4 style="color: red">{{$errors}}</h4></div>
                                @endif




                                <span class="d-none d-sm-inline-block  shadow-sm"> choisir mois: <input type="month" value="april-2022"cname='x' id='url' required pattern="\d{2}-\d{2}"  style="width: 100px" onkeydown="return false">


                                    <button type="submit" class="btn btn-sm btn-primary shadow-sm" id="btn">go</button>
                                    {{-- href="/stat?var={{request()->input('var')}}&x=04-2022" --}}
                                   <br> <br>



                                    <div style="float: right">
                                    <a href="/stat?var={{request()->input('var')}}&x=" class="btn  btn-primary ">Statistique d'aujhordui</a>
                                    </div>

                                </span>



                            </div>




                        <div class="row"  >

                            <div class="col-xl-9 col-lg-7">


                                <!-- Bar Chart -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Projet {{$nomphase[request()->input('var')]}} {{  request()->input('x') }}:</h6>
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
                                            <span class="mr-2">
                                                <i class="fas fa-circle text-warning"></i> Idee R/D
                                            </span>
                                            <span class="mr-2">
                                                <i class="fas fa-circle text-primary"></i> Maturation
                                            </span>
                                            <span class="mr-2">
                                                <i class="fas fa-circle text-danger"></i> Recherche
                                            </span>
                                            <span class="mr-2">
                                                <i class="fas fa-circle text-success"></i> Test Pilote
                                            </span>

                                            <span class="mr-2">
                                                <i class="fas fa-circle"style="color:grey"></i> En implementation
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div style="text-align: center">
                                    <a href="/stat?var=1&x={{request()->input('x')}}">
                                        <div class="card border-left-warning shadow h-100 py-0" style="width: 50%;margin: auto;">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">

                                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                            Idee R/D
                                                        </div>

                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <a href="/stat?var=2&x={{request()->input('x')}}">
                                        <div class="card border-left-primary shadow h-100 py-0" style="width: 50%;margin: auto;">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">

                                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                            Maturation
                                                        </div>

                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <a href="/stat?var=3&x={{request()->input('x')}}">
                                        <div class="card border-left-danger shadow h-100 py-0" style="width: 50%;margin: auto;">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">

                                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                            Recherche
                                                        </div>

                                                </div>
                                            </div>
                                        </div>
                                     </a>

                                    <a href="/stat?var=4&x={{request()->input('x')}}">
                                        <div class="card border-left-success shadow h-100 py-0" style="width: 50%;margin: auto;">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">

                                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                            Test Pilote
                                                        </div>

                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <a href="/stat?var=5&x={{request()->input('x')}}">
                                        <div class="card border-left-secondary shadow h-100 py-0" style="width: 50%;margin: auto;">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">

                                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                            En implementation
                                                        </div>

                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                </div>





                            </div>

                        </div>







                            <!-- Page level plugins -->
                            <script src="vendor/chart.js/Chart.min.js"></script>



                            <!-- Page level plugins -->
                            <script src="vendor/chart.js/Chart.min.js"></script>

                            <script>
                                document.getElementById("btn").addEventListener("click", goToUrl);
                                function goToUrl(){
                                window.location = '/stat?var=2&x='+document.getElementById('url').value;
                                }
                            </script>

                            <script>
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
                                labels: ["Idee R/D", "Maturation", "Recherche", "Test Pilote","En implementation"],
                                datasets: [{
                                data: [{{$count1}},{{$count2}},{{$count3}},{{$count5}},{{$count5}}],
                                backgroundColor: ['#f6c23e', '#4e73df', '#e74a3b', '#1cc88a',, 'grey'],
                                hoverBackgroundColor: ['yellow', 'blue', 'red', 'green','grey'],
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

                            <script>
                                  function clickhandler(click){
                                const points=bar.getElementsAtEventForMode(click, 'nearest', {instersect: true}, true);
                                if(points.lenght){
                                    const firstpoint=points[0];
                                    consol.log(firstpoint);
                                }
                                ctxbar.onclick=clickhandler;
                            }
                            </script>


@endsection

