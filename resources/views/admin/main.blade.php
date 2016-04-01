@extends('layouts.app')

@section('content')


@if(isset($comments))


    <div class="container">

<h4>Отзывы</h4>


        <ul class="nav nav-tabs">

            <li class="active"><a data-toggle="tab" href="#waiting" >Ожидают</a></li>
            <li><a data-toggle="tab" href="#enabled" >Доступны</a></li>
            <li><a data-toggle="tab" href="#disabled" >Недоступны</a></li>


        </ul>

        <div class="tab-content">
            <div id="waiting" class="tab-pane fade in active">

                <div class="waiting_comments">
                    @include('admin.table')
                </div>

            </div>
            <div id="enabled" class="tab-pane fade">
                <div class="enabled_comments">

                </div>

            </div>
            <div id="disabled" class="tab-pane fade">
                <div class="disabled_comments">
                </div>
            </div>
        </div>









@endif
























    </div>
@endsection