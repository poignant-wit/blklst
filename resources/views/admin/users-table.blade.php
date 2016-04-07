<table class="table">

    <thead>
    <tr>

        <th>Имя</th>
        <th>Email</th>
        <th>Роль</th>


    </tr>
    </thead>
    <tbody>

    @foreach($paginator->getCollection() as $user)




        <tr id="{{$user->id}}" >

            <td>

                {{$user->name}}
            </td>

            <td>
                {{$user->email}}
            </td>

            <td>


                <select class="user_role">
                    @foreach($roles as $role)
                        <option value="{{$role->id}}" {{ ($role->id == $user->role_id)? 'selected=selected': ''}}>{{$role->label}}</option>
                    @endforeach
                </select>

            </td>
        </tr>
    @endforeach



    </tbody>
</table>

{{ $paginator->render() }}