$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('.dd').nestable({

    callback: function(l,e){

        var movedTaskId = $(e).data('id');
        var newTaskOrder = $('.dd').nestable('serialize');

        $.ajax({
            type: "POST",
            url: '/reorder/task',
            data: { movedTaskId: movedTaskId, newTaskOrder: newTaskOrder },
            success: function(data){
                window.location.reload();
            },
        });
    }

});