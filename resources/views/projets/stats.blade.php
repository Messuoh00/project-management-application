@extends('layout.main')


@section('styles')




@endsection





@section('content')







                            <!-- Page Heading -->

  
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800">Statistique:</h1>
                                
                            </div>

                     
                            <!-- Content Row -->
                            <div class="row">

                                <!-- Pending Requests Card Example -->
                                <div class="col" style="margin-bottom: 30px">
                                    <div class="card shadow">
                                        <div
                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Stat projet</h6>
                                        <div class="dropdown no-arrow">
                                           
                                        </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col ">
                                                   
                                                                

        
                                                   
                                                        <canvas id="bar-chart-grouped" height="60"></canvas>
                                                 
                                                       
                                                        
                                                        
                                                    
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>


                            
                                             <!-- Content Row -->
                    <div class="row">

                      
                     
                      <div class="col" style="max-width: 50% ;">
                       
                            
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-2 col-md-6 mb-4" style="height: 90px;" >
                            <a href="">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                      hey
                                    </div>
                                </div>
                            </div>
                        </a>
                        </div>
   
                         
                          <!-- Earnings (Monthly) Card Example -->
                          <div class="col-xl-2 col-md-6 mb-4" style="height: 90px">
                             <a href="">
                             <div class="card border-left-success shadow h-100 py-2">
                                 <div class="card-body">
                                    
                                     <div class="row no-gutters align-items-center">
                                       hey
                                     </div>
                                 </div>
                             </div>
                         </a>
                         </div>
   
                         
                         <!-- Earnings (Monthly) Card Example -->
                         <div class="col-xl-2 col-md-6 mb-4" style="height: 90px;" >
                             <a href="">
                             <div class="card border-left-info shadow h-100 py-2">
                                 <div class="card-body">
                                    
                                     <div class="row no-gutters align-items-center">
                                       hey
                                     </div>
                                 </div>
                             </div>
                         </a>
                         </div>
                      
                         

                       
                    </div>
     

                        <!-- Pie Chart -->
                        <div class="col" style="max-width: 50% ;">
                          <div class="card shadow mb-4">
                              <!-- Card Header - Dropdown -->
                              <div
                                  class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                  <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
                                  <div class="dropdown no-arrow">
                                     
                                  </div>
                              </div>
                              <!-- Card Body -->
                              <div class="card-body">
                                  <div class="chart-pie pt-4 pb-2">
                                      <canvas id="myPieChart"></canvas>
                                  </div>
                                  <div class="mt-4 text-center small">
                                      <span class="mr-2">
                                          <i class="fas fa-circle text-primary"></i> Direct
                                      </span>
                                      <span class="mr-2">
                                          <i class="fas fa-circle text-success"></i> Social
                                      </span>
                                      <span class="mr-2">
                                          <i class="fas fa-circle text-info"></i> Referral
                                      </span>
                                  </div>
                              </div>
                          </div>
                      </div>


                  </div>







                            
                  
                        
                            <!-- Page level plugins -->
                            <script src="vendor/chart.js/Chart.min.js"></script>
                        
                            <!-- Page level custom scripts -->
                            <script src="js/demo/chart-area-demo.js"></script>
                            <script src="js/demo/chart-pie-demo.js"></script>
              
                            <!-- Page level plugins -->
                            <script src="vendor/chart.js/Chart.min.js"></script>
                           

                            <script>
                             let names=[];
                             Array.prototype.push.apply(names,@json($names));
                             let vis=[];
                             Array.prototype.push.apply(vis,@json($vis));
                             let reac=[];
                             Array.prototype.push.apply(reac,@json($reac));
                             let avan=[];
                             Array.prototype.push.apply(avan,@json($avan));


                               new Chart(document.getElementById("bar-chart-grouped"), {
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
                                title: {
                                    display: true,
                                    text: 'avancement projet'

                                }
                                }
                            });


                            </script>


@endsection

