@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <form action="{{ url('/search') }}" method="get">
                <div class="col-md-6 col-md-offset-3">
                    <div class="input-group">
                        <input type="text" name="query" class="form-control"
                               aria-label="Text input with segmented button dropdown"
                               placeholder="Введите имя или email">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-default">Поиск</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>



    @if(isset($users))
        @if(count($users) == 0)
            <hr>
            <h3 class="text-center">НИЧЕГО НЕ НАЙДЕНО</h3>


            <p class="text-center">
                <a href="{{url('/register')}}">Зарегистрируйся</a>, чтоб получить уведомление, когда тебя внесут в черный список
            </p>


            <br>
        @else
            <hr>
            <h3 class="text-center">РЕЗУЛЬТАТЫ ПОИСКА</h3>

            <br>

            @can('show_comments')




            <div class="row">
                <div class="col-md-2 col-md-offset-5">
                    @foreach($users as $user)
                        @include('user.partials.search')
                    @endforeach
                </div>
            </div>
            @else



                @if(Auth::check())

                    <h5 class="text-center">
                        Кандидат существует<br>
                        <br>
                    </h5>


                    @else


                    <h5 class="text-center">
                        Кандидат существует<br>
                        <br>
                        <a href="{{url('/register')}}">Зарегистрируйся</a>, чтоб видеть комментарии
                    </h5>

                    @endif



            @endcan


        @endif
    @endif

@endsection
