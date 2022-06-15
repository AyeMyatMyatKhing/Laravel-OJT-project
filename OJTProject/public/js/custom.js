String.prototype.escape = function () {
    var tagsToReplace = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;'
    };
    return this.replace(/[&<>]/g, function (tag) {
        return tagsToReplace[tag] || tag;
    });
};


function postDetail(id) {
    var post_id = id;
    $.get("api/posts/" + post_id, function (response) {
        var post_title = response.title;
        var post_description = response.description;
        var post_status = response.status;
        var post_created_at = response.created_at;
        //var created_at = moment(post_created_at, "DD-MM-YYYY").format("YYYY-MM-DD");
        var post_created_user_id = response.created_user_id;
        var post_updated_at = response.updated_at;
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
    var fileSelected = document.getElementById(selectedfile_id).files;
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

function userDetail(id) {
    var user_id = id;
    $.get("api/users/" + user_id, function (response) {
        var user_name = response.name;
        var user_email = response.email;
        var user_type = response.type;
        var user_phone = response.phone;
        var user_dob = response.dob;
        var user_address = response.address;
        var user_profile = response.profile;
        if (user_type == 0) {
            var type = 'Admin';
        } else {
            var type = 'User';
        }
        $('#displayArea').append("<tr><th>Name</th><td>" + user_name + "</td></tr><tr><th>Email</th><td>" + user_email + "</td></tr><tr><th>Type</th><td>" + type + "</td></tr><tr><th>Phone</th><td>" + user_phone + "</td></tr>" + "</td></tr><tr><th>Date of Birth</th><td>" + user_dob + "</td></tr><tr><th>Address</th><td>" + user_address + "</td></tr>");
        var source = "public/profile-images/" + user_profile;
        var href = "users/" + user_id + "/edit";
        $('.user_profile').attr('src', source);
        $('#user_profile_id').attr('href', href);
    });
}


