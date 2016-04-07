@extends('layouts.app')

@section('content')




    {{--<div class="container">--}}
        {{--<h4>Список юзеров</h4>--}}
        {{--<p>Все юзеры в системе</p>--}}
        {{--<table class="table table-hover">--}}
            {{--<thead>--}}
            {{--<tr>--}}
                {{--<th>Имя</th>--}}
                {{--<th>Email</th>--}}
                {{--<th>Роль</th>--}}
            {{--</tr>--}}
            {{--</thead>--}}
            {{--<tbody>--}}

            {{--@foreach($users as $user)--}}

                {{--<tr>--}}
                    {{--<td>{{$user->name}}</td>--}}
                    {{--<td>{{$user->email}}</td>--}}
                    {{--<td>{{$user->role}}</td>--}}
                {{--</tr>--}}

            {{--@endforeach--}}
            {{--</tbody>--}}
        {{--</table>--}}
    {{--</div>--}}
    {{----}}
    <div class="container admin-users-content">

        <h4>Пользователи</h4>


        @include('admin.users-table')

</div>


@endsection