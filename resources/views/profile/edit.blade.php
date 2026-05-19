@extends('layouts.app')

@section('title', 'Modifier le profil')

@section('content')
<div class="py-12 text-white">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-[#1a1a1a] border border-[#333] rounded-lg shadow">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>
        <div class="p-4 sm:p-8 bg-[#1a1a1a] border border-[#333] rounded-lg shadow">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>
        <div class="p-4 sm:p-8 bg-[#1a1a1a] border border-[#333] rounded-lg shadow">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>
@endsection
