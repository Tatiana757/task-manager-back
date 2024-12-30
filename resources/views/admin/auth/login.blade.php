@extends('layouts.app')

@section('title')
    {{ __('auth.title') }}
@endsection

@section('content')
    <div class="h-screen bg-white flex flex-col space-y-10 justify-center items-center">
        <div class="bg-white w-96 shadow-xl rounded p-5">

            <img src="/images/logo_color.svg" class="m-auto w-64" alt="logo">

            <form method="POST" action="{{route('admin.login_process')}}" class="space-y-5 mt-3">
                @csrf

                <input name="login" id="login" type="text" class="w-full h-12 border border-red-500 rounded px-3" placeholder="{{ __('auth.login') }}" />
                <input name="password" type="password" class="w-full h-12 border border-gray-800 rounded px-3" placeholder="{{ __('auth.password') }}" />
                    
                @error('error')
                    <p class="text-red-500">{{$message}}</p>
                @enderror

                <button type="submit" class="text-center w-full bg-gray-800 rounded-md text-white py-3 font-medium">{{ __('auth.sign_in') }}</button>
            </form>
        </div>
    </div>
@endsection