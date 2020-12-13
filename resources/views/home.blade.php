@section('title')
<title>Brvest</title>
@endsection
@extends('layouts.home')
@section('content')

<main id="app">
    <v-app class="bg-gray-100">
        <div class="content md:flex">
            <nav-bar class="mr-9" logourl="https://99designs-blog.imgix.net/blog/wp-content/uploads/2017/05/attachment_61493098-e1582727199132.png?auto=format&q=60&fit=max&w=930"></nav-bar>
            <div class="flex-grow p-8">
                <v-main>
                    <router-view></router-view>
                </v-main>
            </div>
        </div>
    </v-app>
</main>
@endsection
