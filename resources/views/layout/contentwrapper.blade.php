@extends('layout.main')

@section('styles')
<link href="{{ asset('css/contentwrapper.css') }}" rel="stylesheet" type="text/css"  >
@yield('css')
@endsection


@section('content')
    


<div class="form">
    <div class="note">
      <h1>X</h1>
    </div>

    <div class="form-content">
        
        @yield('content')
        
    </div>

</div>


@endsection