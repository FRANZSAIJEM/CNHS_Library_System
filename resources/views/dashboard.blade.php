<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('DASHBOARD') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg" style="">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div style="place-content: center">
                        <div class="rounded-lg" style="box-shadow: 0px 20px 15px 5px rgba(0, 0, 0, 0.306); background-color: rgb(58, 123, 151); padding: 20px; margin-bottom: 20px">
                            <h1 style="font-size: 25px; color: black; text-align: center;">Total Books</h1>
                            <h3 style="text-align: center; padding-top: 20x; color: black;">{{$totalBooks}}</h3>
                            @if (!Auth::user()->is_admin)
                            <h3 style="text-align: center; padding-top: 20x">
                                <x-nav-link style="font-size: 13px; color: black; padding: 10px; border-radius: 5px; background-color: rgb(215, 215, 215)" :href="route('bookList')" :active="request()->routeIs('bookList')">
                                    <b>{{ __('Borrow Book') }}</b>
                                </x-nav-link>
                            </h3>
                            @endif

                            @if (Auth::user()->is_admin)
                            <h3 style="text-align: center; padding-top: 20x">
                                <x-nav-link style="font-size: 13px; color: black; padding: 10px; border-radius: 5px; background-color: rgb(215, 215, 215)" :href="route('bookList')" :active="request()->routeIs('bookList')">
                                    <b>{{ __('View All Books') }}</b>
                                </x-nav-link>
                            </h3>
                            @endif
                        </div>
                        @if (!Auth::user()->is_admin)
                        <div class="rounded-lg" style="box-shadow: 0px 20px 15px 5px rgba(0, 0, 0, 0.306); background-color: rgb(58, 123, 151); padding: 20px; margin-bottom: 20px">

                            <h1 style="font-size: 25px; color: black; text-align: center;">Total Fines</h1>
                            <h3 style="text-align: center; padding-top: 20x; color: black;">₱ &nbsp;{{ number_format($totalFines, 2) ?? '0.00' }}</h3>


                            <h3 style="text-align: center; padding-top: 20x">
                                <x-nav-link style="font-size: 13px; color: black; padding: 10px; border-radius: 5px; background-color: rgb(215, 215, 215)" :href="route('notifications')" :active="request()->routeIs('notifications')">
                                    <b>{{ __('Details') }}</b>
                                </x-nav-link>
                            </h3>

                        </div>
                        @endif

                        <br>
                        @if (Auth::user()->is_admin)
                        <div class="rounded-lg" style="background-color: rgb(58, 123, 151); padding: 20px; margin-bottom: 20px">
                            <h1 style="font-size: 25px; color: black; text-align: center;">Total Requests</h1>
                            <h3 style="text-align: center; padding-top: 20px; color: black;">{{ $totalRequests }}</h3>
                            <h3 style="text-align: center; padding-top: 20x">
                                <x-nav-link style="font-size: 13px; color: black; padding: 10px; border-radius: 5px; background-color: rgb(215, 215, 215)" :href="route('requests')" :active="request()->routeIs('requests')">
                                    <b>{{ __('View All Requests') }}</b>
                                </x-nav-link>
                            </h3>
                        </div>

                        <br>
                        @endif
                        @if (Auth::user()->is_admin)
                        <div class="rounded-lg" style="background-color: rgb(58, 123, 151); padding: 20px; margin-bottom: 20px">
                            <h1 style="font-size: 25px; color: black; text-align: center;">Total Students</h1>
                            <h3 style="text-align: center; padding-top: 20x; color: black;">{{ $totalStudents }}</h3>
                            <h3 style="text-align: center; padding-top: 20x">
                                <x-nav-link style="font-size: 13px; color: black; padding: 10px; border-radius: 5px; background-color: rgb(215, 215, 215)" :href="route('student')" :active="request()->routeIs('student')">
                                    <b>{{ __('View All Students') }}</b>
                                </x-nav-link>
                            </h3>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>

<style>

</style>
