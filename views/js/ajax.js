$(function(){
    $('#upload').on('submit', function(e){
        e.preventDefault();
        var form = $(this),
            formData = new FormData(form.get(0));
        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            contentType: false,
            processData: false,
            data: formData,
            dataType: 'text',
            beforeSend: function () {
                $('#submit').attr('disabled', 'disabled');
            },
            success: function(data){
                alert(data);
            },
            complete: [
                function () {
                    $('#submit').prop('disabled', false);
                }
            ]
        });
    });
});