@extends('layouts.app')

@section('title', Auth::user()->name . ' - Nidhi')

@section('content')
<div class="flex">
    <aside class="w-64 flex flex-col space-y-4">
        <a class="text-blue-400 hover:text-blue-300" href="">Manage My Profile</a>
        <a class="text-blue-400 hover:text-blue-300" href="{{route('orders.index')}}">My Orders</a>
    </aside>
    <main>
        <h1 class="text-2xl font-bold text-blue-300">
            My Profile
        </h1>
        <section class="bg-white p-5 h-48">

            <p>
                Name:
            </p>
            <p>
                {{Auth::user()->name}}
            </p>

            <p>
                Email address:
            </p>
            <p>
                {{Auth::user()->email}}
            </p>
            <button class="bg-orange-400 p-2 hover:cursor-pointer hover:bg-orange-300 hover:text-white"> <a href="">Edit Profile</a></button>
        </section>
    </main>
</div>
@endsection