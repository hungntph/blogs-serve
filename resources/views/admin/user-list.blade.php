@extends('layouts.master')

@section('content')

@include('layouts.sidebar')

@include('layouts.main-content')

@php
    use App\Models\User;
@endphp

<div class="list">
    <div class="list-header">
        <div>
            <span>{{ __('message.ul-total') }}: </span><span>{{ $users->count() }}</span>
        </div>
        <div class="list-header-search">
            <form action="{{ route('user-list') }}" method="GET">
                <input type="text" name="query" value="{{ old('query', request()->input('query')) }}" placeholder="Search user">
                <button type="submit">
                    <span><i class="fa-solid fa-magnifying-glass"></i></span>
                </button>
            </form>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{ __('message.ul-name') }}</th>
                <th scope="col">{{ __('message.ul-avatar') }}</th>
                <th scope="col">{{ __('message.ul-email') }}</th>
                <th scope="col">{{ __('message.ul-phone') }}</th>
                <th scope="col">{{ __('message.ul-status') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $key => $user)
            <form action="{{ route('toggle-block', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <tr>
                <th scope="row">{{ $key+1 }}</th>
                <td>{{ $user->name }}</td>
                <td>
                    @if ($user->avatar)
                    <img src="{{ Vite::asset('public/storage/upload/' . $user->avatar) }}" alt="">
                    @endif
                </td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
                <td>
                    {{  User::STATUSES[$user->status] }}
                </td>
                <td>
                    @if ($user->status == User::STATUS_BLOCKED)
                    <button type="submit" class="unblocked" >{{ __('message.ul-unblock') }}</button>
                    @else
                    <button type="submit" class="blocked">{{ __('message.ul-block') }}</button>
                    @endif
                </td>
            </tr>
            </form>
            @endforeach
        </tbody>
    </table>
    <div class="list-pagination">
        <div>
            {{ $users->withQueryString()->links() }}
        </div>
    </div>
</div>

@endsection
