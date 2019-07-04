$(document).ready(() => {
    $("#sign-up-form").fadeToggle(800);
});

$("#sign-up-form").submit((e) => {
   e.preventDefault();
   validate_input();
});

function validate_input() {
    username = $("#username").val();
    email = $("#email").val();
    password = $("#password").val();
    re_password = $("#re-password").val();

    if (username.length == 0) {
        alert("Du måste skriva in ett användarnamn");
    } else if (!validate_email(email)) {
        alert("Skriv in en giltig email adress");
    } else if (password.length < 5) {
        alert("Du har valt ett för kort lösenord");
    } else if (password != re_password) {
        alert("Lösenorden stämmer inte överens");
    }

    else if(sign_up(username, email, password)  == 0)
        alert("Den här användaren finns redan");

    else
        window.location.replace("login.php");
}

function sign_up(username, email, password) {
    $.get("ajax/sign-up.php",
        {
            username: username,
            email: email,
            password: password
        }, function (data, status) {
            data = JSON.parse(data);
            console.log("Data:\n" + data + "\nStatus:\n" + status);
            return data;
        });
}

function validate_email(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}