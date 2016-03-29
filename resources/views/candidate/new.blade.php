@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <h2 class="text-center text-capitalize">Новый кандидат</h2>

                <div class="panel panel-default">
                    <div class="panel-heading">Login</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/candidate') }}">
                            {!! csrf_field() !!}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('skype') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Skype</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="skype" value="{{ old('skype') }}">

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('skype') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>





                           {{--<div class="btn-group" role="group" aria-label="Basic example">--}}
                                {{--<button type="button" class="btn btn-secondary">Left</button>--}}
                                {{--<button type="button" class="btn btn-secondary">Middle</button>--}}
                                {{--<button type="button" class="btn btn-secondary">Right</button>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}




                            <br>

                            @if(isset($ratings))

                            <div class="form-group">
                                <div class="col-md-3 col-md-offset-4">


                                    <select class="form-control" name="rating">

                                        @foreach($ratings as $rating)
                                        <option value="{{ $rating->id }}">{{ $rating->name }}</option>


                                            @endforeach
                                    </select>
                       </div>
                            </div>

                            @endif

                            <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Comment</label>

                                <div class="col-md-6">
                                    <textarea class="form-control" rows="5" name="comment"  value="{{ old('comment') }}"></textarea>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('comment') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>





                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-sign-in"></i>Add
                                    </button>
                                </div>
                            </div>
                        </form>







                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
