$('#create').on('click', function () {
    var file_data = $('#image').prop('files')[0];
    var year = $('#year').val();
    var month = $('#month').val();
    var day = $('#day').val();
    if (!file_data) {
        $('.status').text('Please upload photo');
        return;
    }
    var type = file_data.type;
    var match = ["image/gif", "image/png", "image/jpg", "image/jpeg"];
    if (match.indexOf(type) === -1) {
        $('.status').text('Please upload photo');
        return;
    } else {
        var form_data = new FormData();
        form_data.append('image', file_data);
        if (year && month && day) {
            form_data.append('date', year + "-" + month + "-" + day);
        }
        form_data.append('workplace_id', $('#workplace_id').val());
        form_data.append('hours', $('#hours').val());
        form_data.append('info', $('#info').val());
        $.ajax({
            url: '/timereport/create',
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (res) {
                console.log(res);
                $('.status').text(res);
            }
        });
    }
    return false;
});