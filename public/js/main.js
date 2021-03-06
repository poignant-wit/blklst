$(document).ready(function () {


    var current_tab = 'waiting';


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $('.tab-content').on('change', '.comment_status', function(){

        var index = this.selectedIndex;
        var option = $(this.options[index]);

        var $data = {
            comment_id: $(this).closest('tr').attr('id'),
            new_status_id: option.val()
        };

        $.ajax({
            type: "POST",
            url: 'admin/comment/change',
            data: $data,
            success: function(e){
                var $data = {
                    page: 1,
                    status: current_tab
                };
                getComments($data);

            }
        });


    });

    $('.admin-users-content').on('change', '.user_role', function(){

        var index = this.selectedIndex;
        var option = $(this.options[index]);

        var $data = {
            user_id: $(this).closest('tr').attr('id'),
            new_role_id: option.val()
        };

        console.log($data);
        $.ajax({
            type: "POST",
            url: '/admin/user/change',
            data: $data,
            success: function(e){
            console.log('CHANGED ROLE');
                }

        });


    });



    $('.tab-content').on('click', '.pagination a', function(event) {

        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        var $data = {
            page: page,
            status: current_tab
        };

        getComments($data)


    });

    $('.admin-users-content').on('click', '.pagination a', function(event) {

        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        //
        var $data = {
            page: page
        };
        //
        //getComments($data)

        $.ajax({
            type: "GET",
            url: 'users',
            data: $data
        }).done(function(data){
            $('.admin-users-content').html(data);
        });
    });




    function getComments($data){

        var container = '.' + current_tab + '_comments';
        $.ajax({
            type: "GET",
            url: 'admin/comments',
            data: $data
        }).done(function(data){
            $(container).html(data);
        });
    }

    function getUsers($data){
        $.ajax({
            type: "GET",
            url: 'admin/users',
            data: $data
        }).done(function(data){
            $('.admin-users-content').html(data);
        });
    }



    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var target = $(e.target).attr("href").split('#')[1]; // activated tab
        console.log(target);

        current_tab = target;

        var $data = {
            page: 1,
            status: current_tab
        };

        getComments($data);


    });




    $("body").css('height',$(document).height() );




});

$( window ).resize(function() {
    $("body").css('height',$(document).height() );
});
