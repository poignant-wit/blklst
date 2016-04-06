@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <h3 class="text-center">Кандидат</h3>
            <div class="col-md-4 col-md-offset-2">
                <br>
                <h3><strong>Имя: </strong>{{$candidate->name}}</h3>
                <h3><strong>Email: </strong>{{$candidate->email}}</h3>
                <br>
            </div>
        </div>
    </div>

    <hr>


    @can('show_comments')
    @if(isset($comments))
        <h3 class="text-center">Комментарии</h3>

        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/comment') }}">
                    {!! csrf_field() !!}
                    <input type="hidden" value="{{$candidate->id}}" name="target_id">
                    <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                        <textarea class="form-control" rows="5" name="comment" value="{{ old('comment') }}"></textarea>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('comment') }}</strong>
                                    </span>
                        @endif
                    </div>
                    @if(isset($ratings))
                        <div class="form-group pull-left">
                            <select class="form-control" name="rating">
                                @foreach($ratings as $rating)
                                    <option value="{{ $rating->id }}">{{ $rating->name }}</option>


                                @endforeach
                            </select>
                        </div>
                    @endif
                    <div class="form-group text-right pull-right">
                       <button type="submit" class="btn btn-primary">
                            <i class="fa fa-btn fa-sign-in"></i>Add
                        </button>
                    </div>
                </form>
            </div>
        </div>




        <div class="container">
            {{--<ul>--}}
            {{--@foreach($comments as $comment)--}}
            {{--@include('user.partials.comment')--}}
            {{--@endforeach--}}

            {{--</ul>--}}
            <ul class="list-group">

                @foreach($comments as $comment)
                @include('user.partials.comment')
                @endforeach
                {{--<li class="list-group-item">Cras justo odio</li>--}}

            </ul>
        </div>


    @endif
    @else

        <div class="text-center">
            <h3>Комментарии</h3>
            <br>
            <h4>Комментарии доступны только зарегистрированным пользователям</h4>
            <br>
            <a class="btn btn-primary" href="{{url('register')}}">ЗАРЕГИСТРИРОВАТЬСЯ</a>
        </div>



        @endcan

@endsection
