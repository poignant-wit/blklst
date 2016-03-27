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
                            <button type="submit" class="btn btn-default">Search</button>
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"><span class="caret"></span> <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
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
            <br>
        @else
            <hr>
            <h3 class="text-center">РЕЗУЛЬТАТЫ ПОИСКА</h3>
            <br>
            <div class="row">
                <div class="col-md-2 col-md-offset-5">
                    @foreach($users as $user)
                        @include('user.partials.search')
                    @endforeach
                </div>
            </div>
        @endif
    @endif




@endsection
