<div class="container">

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

</div>