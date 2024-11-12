function addCategory(item) {
    send = {
        "id": item,
        "_token": $("meta[name='csrf-token']").attr("content")
    };
    $.ajax({
        url: url,
        method: 'POST',
        data: send
    }).done(function (data) {
        if (data.success === true) {
            console.log(data);
            let icon = document.getElementById('categoria-' + item).style;
            Toast.fire({
                type: 'success',
                title: data.message,
                icon: "success"
            });
        } else {
            Toast.fire({
                type: 'info',
                title: data.message,
                icon: "info"
            });
        }
    });
}