<div class="container">
    @if(Auth::check() && Auth::user()->confirmed == 0)

        <div class="alert alert-dismissible alert-danger">
            Ваш профиль неактивирован
            <button data-dismiss="alert" class="close" type="button">×</button>
        </div>

    @endif

    @if(isset($info))
        <div class="alert alert-dismissible alert-info">
            {{ $info }}
            <button data-dismiss="alert" class="close" type="button">×</button>
        </div>
    @endif

    @if(isset($info_danger))
        <div class="alert alert-dismissible alert-danger">
            {{ $info_danger }}
            <button data-dismiss="alert" class="close" type="button">×</button>
        </div>
    @endif


        @if(Session::has('info'))

            <div class="alert alert-dismissible alert-info">
                {{ Session::get('info') }}
                <button data-dismiss="alert" class="close" type="button">×</button>
            </div>
        @endif

        @if(Session::has('info_danger'))

            <div class="alert alert-dismissible alert-danger">
                {{ Session::get('info_danger') }}
                <button data-dismiss="alert" class="close" type="button">×</button>
            </div>
        @endif

</div>

