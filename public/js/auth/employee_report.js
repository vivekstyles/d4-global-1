$(document).ready(function () {
    var usertype = $("#super_user").text();
    var request = $.ajax({
        url: "/ajax",
        method: "get",
        data: { action: "default", user: usertype },
        dataType: "html",
    });

    request.done(function (msg) {
        $("#mytablebody").html(msg);
    });

    request.fail(function (msg) {
        alert(JSON.stringify(msg));
    });
});

function handleSearch() {
    var usertype = $("#super_user").text();
    var s_val = $("#serach_input").val();
    var request = $.ajax({
        url: "/ajax",
        method: "get",
        data: { action: "search", ser_val: s_val, user: usertype },
        dataType: "html",
    });

    request.done(function (msg) {
        $("#mytablebody").empty();
        $("#mytablebody").html(msg);
    });

    request.fail(function (msg) {
        alert(JSON.stringify(msg));
    });
}

function handelpagination(val) {
    alert(val.text);
}

function handleNewUser() {
    $("#myModal").modal("show");
}

function handleModelClose() {
    $("#myModal").modal("hide");
}

function handleinsert() {
    var emp_name = $("#emp-name").val();
    var role = $("#role").val();
    var department = $("#department").val();

    var usertype = $("#super_user").text();
    var s_val = $("#serach_input").val();
    var request = $.ajax({
        url: "/ajax",
        method: "get",
        data: {
            action: "add_user",
            emp_val: emp_name,
            role_val: role,
            dep_val: department,
            user: usertype,
        },
        dataType: "html",
    });

    request.done(function (msg) {
        if (msg == "1") {
            $("#myModal").modal("hide");

            alert("Successfully add new user");
        }
        $(document).ready(function () {
            var usertype = $("#super_user").text();
            var request = $.ajax({
                url: "/ajax",
                method: "get",
                data: { action: "default", user: usertype },
                dataType: "html",
            });

            request.done(function (msg) {
                $("#mytablebody").html(msg);
            });

            request.fail(function (msg) {
                alert(JSON.stringify(msg));
            });
        });
    });

    request.fail(function (msg) {
        alert(JSON.stringify(msg));
    });
}

function handleDelete(val){
    var usertype = $("#super_user").text();
    var request = $.ajax({
        url: "/ajax",
        method: "get",
        data: {
            action: "delete",
            emp_id: val,
            user: usertype,
        },
        dataType: "html",
    });

    request.done(function (msg) {
        if (msg == "1") {
            $("#myModal").modal("hide");

            alert("Successfully deleted");
        }
        $(document).ready(function () {
            var usertype = $("#super_user").text();
            var request = $.ajax({
                url: "/ajax",
                method: "get",
                data: { action: "default", user: usertype },
                dataType: "html",
            });

            request.done(function (msg) {
                $("#mytablebody").html(msg);
            });

            request.fail(function (msg) {
                alert(JSON.stringify(msg));
            });
        });
    });

    request.fail(function (msg) {
        alert(JSON.stringify(msg));
    });
}
