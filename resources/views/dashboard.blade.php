@extends('layouts.store')

@section('content')
<section class="mx-auto max-w-5xl px-6 py-12">
    <h1 class="text-3xl font-display">Welcome back</h1>
    <p class="mt-2 text-ink/60">Manage your profile and track orders.</p>
    <div class="mt-6 flex flex-wrap gap-4">
        <a href="{{ route('account.orders') }}" class="btn-primary">View Orders</a>
        <a href="{{ route('profile.edit') }}" class="btn-outline">Edit Profile</a>
        @if(auth()->user()->is_admin)
            <a href="{{ route('admin.dashboard') }}" class="btn-outline">Admin Panel</a>
        @endif
    </div>
</section>
@endsection
