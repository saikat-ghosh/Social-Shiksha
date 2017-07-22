@extends('layouts.app')

    @section('content')
        <div class="container-fluid no-margin-padding">

            <div class="row no-padding">

                <!-- Left Sidebar goes here -->
                <div class="col-sm-3">
                    @yield('sidebar-menu-left')
                </div>
                <!-- Sidebar Menu Content goes here -->
                <div class="col-sm-7 small-font">

                    <!-- Social-Shiksha Logo -->
                    <div class="row">
                        <center>
                            <img src="{{asset('images\logo.png')}}">
                        </center>
                    </div>

                    <!-- Main Content -->
                    @yield('menu-content')
                </div>
                <!-- Right Sidebar goes here -->
                <div class="col-sm-2 text-center">
                    @yield('sidebar-right')
                </div>

            </div>

        </div>
    @endsection
