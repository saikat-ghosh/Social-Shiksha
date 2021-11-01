@extends('layouts.admin_layouts.admin_app')

    @section('sidebar-menu-left')
        <!-- Left sidebar menu goes here -->
            <ul class="list-group sidebar-list" id="sidebar">
                <li>
                    <a  href="{{url('admin/dashboard')}}" class="list-group-item sidebar-list-item"><i class="fa fa-home fa-2x"></i> Home</a>
                </li>
                <li>
                    <a  href="{{url('admin/registration-fees')}}" class="active list-group-item sidebar-list-item"><i class="fa fa-money fa-2x"></i> Registration Fees</a>
                </li>
                <li>
                    <a  href="{{url('admin/download-study-material')}}" class="list-group-item sidebar-list-item"><i class="fa fa-money fa-2x"></i> Collect Exam Fees</a>
                </li>
            </ul>
    @endsection

    @section('menu-content')
            <!-- Admin dashboard goes here -->
            <h1 style="font-family: Montserrat, Lato; color: red; text-decoration: none;font-size: 100%; text-shadow: 4px 4px 6px gray;font-style: none;"><u style="list-style: none;text-decoration: none;"><b> Welcome Admin!</b></u></h1>
    @endsection