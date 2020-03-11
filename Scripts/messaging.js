let xmlhttp = new XMLHttpRequest();

function getInboxMessages(id) {

    xmlhttp.onreadystatechange = function() {

        if (this.readyState === 4 && this.status === 200) {

            let response = document.getElementById("xxxxxxxx");
            response.innerHTML = "<br/>";
            console.log(this.responseText);

            let messages = JSON.parse(this.responseText);
            console.log(messages);

        }

    }

    xmlhttp.open("GET", "ajaxMessaging.php?userID=" + id, true);
    xmlhttp.send();
}

function getChatUsers() {

    xmlhttp.onreadystatechange = function() {

        if (this.readyState === 4 && this.status === 200) {

            let response = document.getElementById("chat-user");
            response.innerHTML = "<br/>";

            let users = JSON.parse(this.responseText);

            let domParser = new DOMParser();

            users.forEach((user) => {

                let userDetails = "<p class=''>" + user.firstName + " "+ user.lastName+ "</p>";
                let names = domParser.parseFromString(userDetails, "text/html");
                // console.log(names);

                window.innerHTML += names.documentElement.innerText;

                names.documentElement.addEventListener('click', () => {

                     //response.innerHTML += names;
                    //window.location.href = "";

                });

                response.appendChild(names.documentElement);

            });
        }

    }

    xmlhttp.open("GET", "ajaxUsers.php", true);
    xmlhttp.send();
}
