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

    @foreach($paginator->getCollection() as $comment)

        <tr id="{{$comment->comment_id}}">
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


                <select class="comment_status">
                    @foreach($statuses as $status)
                        <option value="{{$status->id}}" {{ ($status->id == $comment->status_id)? 'selected=selected': ''}}>{{$status->label}}</option>
                    @endforeach
                </select>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $paginator->render() }}