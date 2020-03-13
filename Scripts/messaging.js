let xmlhttp = new XMLHttpRequest();

function getInboxMessages(userSessionId, sender) {

    xmlhttp.onreadystatechange = function() {

        if (this.readyState === 4 && this.status === 200) {

            let response = document.getElementById("chat-message-display-area");
            response.innerHTML = "<br/>";

            let messages = JSON.parse(this.responseText);
            console.log(messages);

            let domParser = new DOMParser();

            messages.forEach((msg) => {

                let messageInfo = "";

                if(msg.receiverID === userSessionId) {

                    messageInfo = "<div class=''><p class='user-chat-div'>" + sender.firstName + ": "+ msg.message + "</p></div>";

                } else {
                    messageInfo = "<div class=''><p class='me-chat-div'>" + "Me: " + msg.message + "</p></div>";
                }

                let message = domParser.parseFromString(messageInfo, "text/html");

                window.innerHTML += message.documentElement.innerText;

                response.appendChild(message.documentElement);
            });

        }

    }

    xmlhttp.open("GET", "ajaxMessaging.php?userID=" + userSessionId + "&senderID="+ sender.Id, true);
    xmlhttp.send();
}

function getChatUsers(id) {

    xmlhttp.onreadystatechange = function() {

        if (this.readyState === 4 && this.status === 200) {

            let response = document.getElementById("chat-user");
            response.innerHTML = "<br/>";

            let users = JSON.parse(this.responseText);
            //console.log(users);

            let domParser = new DOMParser();

            users.forEach((user) => {

                if(user.Id !== id) {

                    let userDetails = "<p class=''>" + user.firstName + " "+ user.lastName+ "</p>";
                    let names = domParser.parseFromString(userDetails, "text/html");

                    window.innerHTML += names.documentElement.innerText;

                    names.documentElement.addEventListener('click', () => {

                        //window.location.href = "ajaxMessaging.php?userID=" + id + "&senderID="+ user.Id; //ajaxMessaging.php?userID=81&senderID=41

                        //window.location.href = "chat.php?userID=" + id + "&senderID="+ user.Id; //chat.php?userID=81&senderID=41

                        // test - getInboxMessages
                        response.location = "" + getInboxMessages(id, user);

                    });

                    response.appendChild(names.documentElement);
                }

            });
        }

    }

    xmlhttp.open("GET", "ajaxUsers.php", true);
    xmlhttp.send();
}

function createNewMessage(userId, receiverId) {

    let newMessage = "";

    xmlhttp.onreadystatechange = function() {

        if (this.readyState === 4 && this.status === 200) {

            newMessage = document.getElementById("new-chat-message");

            // let response = document.getElementById("chat-message-display-area");
            // response.innerHTML = "<br/>";
            // console.log(this.responseText);
            //
            // let messages = JSON.parse(this.responseText);
            // console.log(messages);
            //
            // let domParser = new DOMParser();
            //
            // messages.forEach((msg) => {
            //
            //     let messageInfo = "<p class=''> Me: "+ msg.message + "</p>";
            //     let message = domParser.parseFromString(messageInfo, "text/html");
            //
            //     window.innerHTML += message.documentElement.innerText;
            //
            //     response.appendChild(message.documentElement);
            // });

        }

    }

    xmlhttp.open("POST", "ajaxCreateMessage.php?newChatMessage=" + newMessage + "&userID=" + userId + "&receiverID="+ receiverId, true); //ajaxCreateMessage.php?newChatMessage=test&userID=81&receiverID=41
    xmlhttp.send();
}
