@section('title')
<title>{{ucfirst($settings['site_name'])}}</title>
@endsection
@extends('layouts.home')
@section('content')

<main id="app">
    <v-app class="bg-gray-100">
        <div class="content md:flex">
            <nav-bar class="mr-9" logourl="{{asset($settings['logo']) }}"></nav-bar>
            <div class="flex-grow p-8">
                <v-main class="relative">
                    <transition 
                        enter-active-class="animate__animated animate__fadeIn animate__faster"
                        leave-active-class="animate__animated animate__fadeOut animate__faster"
                        >
                            <router-view class="absolute w-full" ></router-view>
                        </transition>
                </v-main>
            </div>
        </div>
    </v-app>
</main>
@endsection
