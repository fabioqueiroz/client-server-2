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
            //console.log(users);
            let domParser = new DOMParser();

            users.forEach((user) => {

                let userDetails = "<p>" + user.firstName + " "+ user.lastName+ "</p>";
                let names = domParser.parseFromString(userDetails, "text/html");
                // console.log(names);
                names.documentElement.addEventListener('click', () => {
                    // window.location.href = "postReplies.php?postID=" + post.postId + "&postingUser=" + post.postingUser;
                    response.innerHTML += names;

                });

                response.appendChild(names.documentElement);
            });
        }

    }

    xmlhttp.open("GET", "ajaxUsers.php", true);
    xmlhttp.send();
}
