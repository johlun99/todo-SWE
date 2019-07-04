$(document).ready(() => {
    //$("#login-form").slideDown(700);
    $("#login-form").fadeToggle(900);
    $("#username").focus();
});

$("form").submit((e) => {
    e.preventDefault();
    validate_login();
});

function validate_login() {
    username = $("#username").val();
    password = $("#password").val();

    if (username.length == 0) {
        alert("Vänligen skriv in ditt användarnamn");
        $("#username").focus();
    }

    else if (password.length == 0) {
        alert("Vänligen skriv in ditt lösenord");
        $("#password").focus();
    }

    else
        $.get("ajax/login.php",
            {
                username: username,
                password: password
            },
            function (data, status) {
                console.log("Data:\n" + data + "\nStatus:\n" + status);

                if (data == 1)
                    window.location.replace("todo.php");

                else
                    alert("Den här användaren verkar inte finnas");
            });
}