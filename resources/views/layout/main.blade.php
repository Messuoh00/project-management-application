<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Houssem</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href={{ asset('css/sb-admin-2.min.css') }} rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.19.1/dist/bootstrap-table.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.19.1/dist/bootstrap-table.min.css">

    <link href="{{ asset('css/main.css') }}" rel="stylesheet" type="text/css"  >
    @yield('styles')
</head>

<body id="page-top">


    @php
    $phase = App\Models\Phase::orderBy('position')->get()->whereNotNull('position');
    @endphp

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gray-700 sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/coo-E&P">
                <div class="sidebar-brand-icon ">
                      <img src="{{url('/img/logo.png')}}" alt="" style="height:100px">
                </div>

            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <div class="sidebar-heading" style="color: rgb(34, 33, 33)">
               Info:
            </div>
            <!-- Nav Item - Dashboard -->

            <li class="nav-item  {{request()->is('coo-E&P','coo-E&P-R') ? 'active  ' : ''}}{{-- active --}}">
                <a class="nav-link  {{!request()->is('coo-E&P','coo-E&P-R') ? 'collapsed  ' : ''}}  {{-- collapsed --}} " href="#" data-toggle="collapse" data-target="#collapseone"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-archive"></i>
                    <span>Coordination E&P</span></a>
                </a>


                <div id="collapseone" class="collapse {{request()->is('coo-E&P','coo-E&P-R') ? 'show  ' : ''}} {{-- show --}} " aria-labelledby="headingTwo" data-parent="#accordionSidebar">


                    <div class="bg-white py-2 collapse-inner rounded">

                        <a class="collapse-item {{request()->is('coo-E&P') ? 'active text-warning ' : ''}}"   href="/coo-E&P" >Présentation Coordination <br> E&P</a>
                        <hr class="sidebar-divider my-0">

                        <a  class="collapse-item {{request()->is('coo-E&P-R') ? 'active text-warning ' : ''}}"  href="/coo-E&P-R">Rapports Coordination <br> E&P</a>


                    </div>
                </div>



            </li>

            {{-- yo lknlin--}}
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading" style="color: rgb(34, 33, 33)">
                projets:
            </div>

            <!-- Nav Item - -->
            <li class="nav-item {{request()->is('projet') && request()->missing('phase') ? 'active ' : ''}}">
                <a class="nav-link "  href="/projet">
                    <i class="fas fa-fw fa-database"></i>
                    <span>Tous les projets</span></a>
            </li>



            <li class="nav-item  {{request()->filled('phase')  ? 'active ' : ''}} {{-- active --}}">
                <a class="nav-link  {{!request()->filled('phase') ? 'collapsed ' : ''}}{{-- collapsed --}} " href="#" data-toggle="collapse" data-target="#collapsethree"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-tasks"></i>
                    <span>Phase projets</span>
                </a>


                <div id="collapsethree" class="collapse {{request()->has('phase') ? 'show ' : ''}} {{-- show --}} " aria-labelledby="headingTwo" data-parent="#accordionSidebar">


                    <div class="bg-white py-2 collapse-inner rounded">

                        @foreach ($phase as $p)


                        <a class="collapse-item  {{  request()->input('phase')==$p->position ? 'active text-warning ' : ''}} " href="/projet?phase={{$p->position}}">Phase {{$p->name}}</a>


                        @endforeach


                    </div>
                </div>



            </li>


            @if(Auth::user()->poste=='admin')
            <!-- Nav Item - -->
            <li class="nav-item {{request()->is('projet/create') ? 'active ' : ''}}">
                <a class="nav-link "  href="/projet/create">
                    <i class="fas fa-fw fa-plus-circle"></i>
                    <span>Ajouter un projet</span></a>
            </li>
            @endif


            @if(Auth::user()->poste=='admin')
            <!-- Nav Item - -->
            <li class="nav-item {{request()->is('Phase/create') ? 'active ' : ''}}">
                <a class="nav-link "  href="/Phase/create">
                    <i class="fas fa-fw fa-th-list"></i>
                    <span>Modifier Phase</span></a>
            </li>
            @endif


            @if(Auth::user()->poste=='admin')
            <!-- Nav Item - -->
            <li class="nav-item {{request()->is('Departement/create') ? 'active ' : ''}}">
                <a class="nav-link "  href="/Departement/create">
                    <i class="fas fa-fw  fa-building"></i>
                    <span>Modifier Departements</span></a>
            </li>
            @endif




            <!-- Divider -->
            <hr class="sidebar-divider">


            <div class="sidebar-heading "style="color: rgb(34, 33, 33)">
                Données
             </div>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link {{request()->is('') ? 'active ' : ''}}" href="/stat">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Statistique</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            @if(Auth::user()->poste=='admin')


            <div class="sidebar-heading" style="color: rgb(34, 33, 33)">
                Utulisateur:
             </div>

            <!-- Nav Item - Tables -->
            <li class="nav-item  {{request()->is('users') ? 'active ' : ''}}">
                <a class="nav-link " href="/users">
                    <i class="fas fa-fw fa-user"></i>
                    <span>List Utulisateur</span></a>
            </li>

            <li class="nav-item {{request()->is('users/create') ? 'active ' : ''}}">
                <a class="nav-link" href="/users/create">
                    <i class="fas fa-fw fa-plus-circle"></i>
                    <span>Ajouter Utulisateur</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            @endif





            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">



                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3" style="color: orange">
                        <i class="fa fa-bars"></i>
                    </button>



                    <div class="ml-auto">


                                                     <div></div>
                       <a href="/publications" style="color: orange"> <i class="fas fa-fw fa-lg fa-home" style="margin-right: 60px;margin-left: 132px"></i></a>

                       <a href="/publications/create" style="color: orange"> <i class="fas fa-fw fa-lg  fa-plus-circle" style="margin-left: 60px"> </i></a>



                    </div>



                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto" >




                        <div class="topbar-divider d-none d-sm-block"></div>



                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{Auth::user()->nom}} {{Auth::user()->prenom}} </span>
                                <img class="img-profile rounded-circle"
                                    src={{ asset("img/user.png") }}>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="/users/{{Auth::user()->id}}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <a class="dropdown-item" href="{{ url('/passwordedit')}}">
                                    <i class="fas fa-list fa-lock fa-fw mr-2 text-gray-400"></i>
                                    modification du mot de passe
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ url('/logout')}}" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">


                        @yield('content')



                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->



    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ url('/logout')}}">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src= {{ asset('vendor/jquery/jquery.min.js') }}></script>
    <script src={{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}></script>

    <!-- Core plugin JavaScript-->
    <script src={{ asset("vendor/jquery-easing/jquery.easing.min.js") }}></script>

    <!-- Custom scripts for all pages-->
    <script src= {{ asset("js/sb-admin-2.min.js") }}></script>

    <script src="https://unpkg.com/bootstrap-table@1.19.1/dist/bootstrap-table.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.19.1/dist/locale/bootstrap-table-fr-FR.min.js"></script>
</body>

</html>


