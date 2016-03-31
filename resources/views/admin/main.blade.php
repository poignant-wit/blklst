@extends('layouts.app')

@section('content')


@if(isset($comments))


    <div class="container">

<h4>Отзывы</h4>


        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home">В ожидании</a></li>
            <li><a data-toggle="tab" href="#menu1">Подтвержденные</a></li>
            <li><a data-toggle="tab" href="#menu2">Неподтвержденные</a></li>
            <li><a data-toggle="tab" href="#menu3">Menu 3</a></li>
        </ul>

        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">



                <table class="table">

                    <thead>
                    <tr>

                        <th>Отзыв оставил</th>
                        <th>Кандидат</th>
                        <th>Тип отзыва</th>
                        <th>Отзыв</th>
                        <th>Статус</th>

                    </tr>
                    </thead>
                    <tbody>

                    @foreach($comments as $comment)

                        <tr>
                            <td>
                                <address>
                                    <strong>Имя: </strong>{{$comment->owner_name}}<br>
                                    <strong>Email: </strong>{{$comment->owner_email}}<br>
                                    <strong>Skype: </strong>{{$comment->owner_skype}}<br>
                                    <strong>Linkedin: </strong><a>{{$comment->owner_linkedin_link}}</a><br>
                                </address>
                            </td>
                            <td>
                                <address>
                                    <strong>Имя: </strong>{{$comment->target_name}}<br>
                                    <strong>Email: </strong>{{$comment->target_email}}<br>
                                    <strong>Skype: </strong>{{$comment->target_skype}}<br>
                                    <strong>Linkedin: </strong><a>{{$comment->target_linkedin_link}}</a><br>
                                </address>
                            </td>
                            <td>{{$comment->rating}}</td>
                            <td>{{$comment->body}}</td>
                            <td>
                                <div class="dropdown clearfix" >
                                    <button aria-expanded="true" aria-haspopup="true" data-toggle="dropdown" id="dropdownMenu1" type="button"
                                            class="btn btn-default dropdown-toggle"> Dropdown <span class="caret"></span></button>
                                    <ul aria-labelledby="dropdownMenu1" class="dropdown-menu">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>









            </div>
            <div id="menu1" class="tab-pane fade">
                <h3>Menu 1</h3>
                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
            <div id="menu2" class="tab-pane fade">
                <h3>Menu 2</h3>
                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
            </div>
            <div id="menu3" class="tab-pane fade">
                <h3>Menu 3</h3>
                <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
            </div>
        </div>









@endif
























    </div>
@endsection