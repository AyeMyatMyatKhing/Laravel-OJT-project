function postDetail(id) {
    var post_id = id;
    $.get("api/posts/" + post_id, function (response) {
        var post_title = response.title.escape();
        var post_description = response.description.escape();
        var post_status = response.status;
        var post_created_at = moment(response.post_created_at).format('DD-MM-YYYY');
        var post_created_user_id = response.created_user_id;
        var post_updated_at = moment(response.post_updated_at).format('DD-MM-YYYY');
        if (post_status == 0) {
            var status = 'Inactive';
        } else {
            var status = 'Active';
        }
        $.get("api/users/" + post_created_user_id, function (data) {
            var user_name = data.name;

            $('#displayArea').append("<tr><th>Title</th><td>" + post_title + "</td></tr><tr><th>Description</th><td>" + post_description + "</td></tr><tr><th>Status</th><td>" + status + "</td></tr><tr><th>Created at</th><td>" + post_created_at + "</td></tr><tr><th>Created User</th><td>" + user_name + "</td></tr><tr><th>Updated at</th><td>" + post_updated_at + "</td></tr>");
        });
    });
}
$('#mymodal').on('hidden.bs.modal', function () {
    window.location.reload(true)
})


function clearInputs() {
    var myinputs = document.getElementsByClassName('form-control');
    for (let i = 0; i < myinputs.length; i++) {
        myinputs[i].value = "";
    }
}

function displaySelectedPhoto(selectedfile_id, img_id) {
    var fileSelected =
        document.getElementById(selectedfile_id).files;
    var image_ui = document.getElementById(img_id);
    if (fileSelected.length > 0) {
        var fileToLoad = fileSelected[0];
        if (fileToLoad.type.match("image.*")) {
            var fileReader = new FileReader();
            fileReader.onload = function (fileLoadedEvent) {
                image_ui.src = fileLoadedEvent.target.result;
            };
            fileReader.readAsDataURL(fileToLoad);
        }
    }
}