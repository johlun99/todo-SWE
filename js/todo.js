$(document).ready(() => {
    get_todo();
});

function get_todo() {
    $.get("ajax/get-todo.php",
        function(data, status) {
            data = JSON.parse(data);
            console.log("Data:\n:" + data + "\nStatus:\n" + status);

            html = "";
            $.each(data, function (index, value) {
                console.log("Row: " + index + "\n value: " + value);

                html += "<tr>";

                html += "<td>" + (index + 1) + "</td>";
                html += "<td>" + value[1] + "</td>";
                html += "<td>" + value[2] + "</td>";

                if (value[3] == 0) {
                    html += "<td><input type='checkbox' class='form-check-input' onclick='update_state(this)' id='" + value[0] + "'></td>";
                } else if (value[3] == 1) {
                    html += "<td><input type='checkbox' class='form-check-input' onclick='update_state(this)' id='" + value[0] + "' checked></td>";
                }

                html += "<td><a href='javascript:void(0)' class='remove-todo' onclick='remove_todo(" + value[0] + ")'><i class='far fa-trash-alt'></i></a></td>";
                //html += "<td>" + value[3] + "</td>";

                html += "</tr>";
            });

            $("#todo-table").html(html);
        });
}

$("#todo-add-form").submit((e) => {
    e.preventDefault();

    title = $("#title").val();
    description = $("#description").val();

    if (title.length == 0)
        alert("Du måste skriva in en titel");

    else if (description.length == 0)
        alert("Du måste ange en beskrivning");

    else
        $.get("ajax/add-todo.php",
            {
                title: title,
                description: description
            },
            function (data, status) {
                console.log("Data:\n" + data + "\nStatus:\n" + status);

                get_todo();
                clear_form();
            });
});

function clear_form() {
    $("#title").val("").focus();
    $("#description").val("");
}

function update_state(obj){
    $.get("ajax/update-done-state.php",
        {
            todo_id: $(obj).attr("id")
        },
        function(data, status) {
            console.log("Data:\n" + data + "\nStatus:\n" + status);
        });
}

function remove_todo(todo_id) {
    $.get("ajax/remove_todo.php",
        {
            todo_id: todo_id
        },
        function (data, status) {
            data = JSON.parse(data);
            console.log("Data:\n" + data + "\nStatus:\n" + status);

            if (data == true)
                get_todo();

            else
                alert("Couldn't remove todo");
        });
}

$("#sign-out-button").click(() => {
    window.location.replace("login.php");
});
   /*
$("#sign-out").click(() => {
    window.location.replace("login.php");
});     */