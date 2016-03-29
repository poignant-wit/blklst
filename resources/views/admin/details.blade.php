@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Детали</h2>
        <p>{{$user->name}}</p>
        <p>{{$user->email}}</p>
        <p>{{$user->created_at}}</p>
        <h2>Комментарии</h2>




        <table class="table table-hover">
            <thead>
            <tr>
                <th>Имя</th>
                <th>Email</th>
                <th>Роль</th>
            </tr>
            </thead>
            <tbody>


            </tbody>
        </table>



    </div>
@endsection