@extends('layouts.app')

@section('title', Auth::user()->name . ' - Nidhi')

@section('content')
<div class="flex">
    <aside class="w-64 flex flex-col space-y-4">
        <a class="text-blue-400 hover:text-blue-300 {{ request()->routeIs('user.profile') ? 'font-bold text-blue-600' : '' }}"
            href="{{ route('user.profile') }}">Manage My Profile</a>
        <a class="text-blue-400 hover:text-blue-300 {{ request()->routeIs('order.index') ? 'font-bold text-blue-600' : '' }}"
            href="{{ route('order.index') }}">My Orders</a>
        <a class="text-blue-400 hover:text-blue-300 {{ request()->routeIs('cart.index') ? 'font-bold text-blue-600' : '' }}"
            href="{{ route('cart.index') }}">My Cart</a>
    </aside>
    <main class="flex-1">
        <h1 class="text-2xl font-bold text-blue-300">My Profile</h1>
        <section class="bg-white p-5 h-96">
            <form action="{{ route('user.profile.update') }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-gray-700">Name:</label>
                    <input type="text" name="name" value="{{ Auth::user()->name }}"
                        class="w-full p-2 border rounded-md focus:ring focus:ring-blue-200">
                </div>

                <div>
                    <label class="block text-gray-700">Email address:</label>
                    <input type="email" name="email" value="{{ Auth::user()->email }}"
                        class="w-full p-2 border rounded-md focus:ring focus:ring-blue-200">
                </div>
                <div>
                    <labe class="block text-gray-700">New Password (optional):</label>
                        <input type="password" name="password" placeholder="Enter new password" class="w-full p-2 border rounded-md focus:ring focus:ring-blue-200">
                </div>
                <div>
                    <label class="block text-gray-700">Confirm Password:</label>
                    <input type="password" name="password_confirmation" placeholder="Re-enter new password" class="w-full p-2 border rounded-md focus:ring focus:ring-blue-200">
                </div>

                <button type=" submit" class="bg-orange-400 p-2 rounded hover:bg-orange-300 hover:text-white">
                    Save Changes
                    </button>
            </form>
        </section>
    </main>
</div>
@endsection