@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Список юзеров</h2>
    <p>Все юзеры в системе</p>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Имя</th>
            <th>Email</th>
            <th>Роль</th>
        </tr>
        </thead>
        <tbody>

        @foreach($users as $user)

        <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->role}}</td>
        </tr>

            @endforeach
        </tbody>
    </table>
</div>
    @endsection