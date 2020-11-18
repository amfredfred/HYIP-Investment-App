@section('title')

@endsection
@extends('layouts.home')
@section('content')

<div class="change-theme">
    <a href="/change-theme?theme=@if($color =='dark') white @else dark @endif"> 
        <i class="fa fa-moon-o" ></i>
    </a>

</div>
<main id="app">
    <div class="dashboard-content">

        @can('isUser')
        <div class="sidebar-menu">
            @if($color =='dark') 
            <admin-sidebar :user-type="'{{Auth::user()->type}}'" :logo="'{{asset($settings['logo'])}}'"></admin-sidebar>
            @else
            <admin-sidebar :user-type="'{{Auth::user()->type}}'" :logo="'{{asset('logo.png')}}'"></admin-sidebar>
            @endif
        </div>
        <div class="main-dashboard-content">
            <transition
                enter-active-class="animate__animated animate__fadeIn animate__faster"
                leave-class="animate__animated animate__fadeOut animate__faster"
                class
                >
                <router-view></router-view>
            </transition>
        </div>
        @endcan

        @can('isAdmin')
        <div class="sidebar-menu">
            @if($color =='dark') 
            <admin-sidebar-admin :user-type="'{{Auth::user()->type}}'" :logo="'{{asset($settings['logo'])}}'"></admin-sidebar-admin>
            @else
            <admin-sidebar-admin :user-type="'{{Auth::user()->type}}'" :logo="'{{asset('logo.png')}}'"></admin-sidebar-admin>
            @endif

        </div>
        <div class="main-dashboard-content">
            <router-view></router-view>
        </div>
        @endcan



    </div>
</main>
@endsection
