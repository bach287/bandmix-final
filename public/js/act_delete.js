$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {
    $('.btnRemove').click(function () {
        let url = $('#act-url').val();
        let data = $(this).parent().parent().children(".act-id").val();
        alert(url);
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                'act_id': data
            },
            success: function (response) {
                console.log(response);
            },
            error: function (error) {}
        });
    })
});