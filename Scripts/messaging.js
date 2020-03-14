let xmlhttp = new XMLHttpRequest();
let recipientId = "";
let myNewMessage = "";

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
                // let dateParts = msg.messageDate.split(" ");
                // let day = dateParts[0].toString().split("-");
                // let msgTime = dateParts[1];
                //
                // //console.log(dateParts[0], dateParts[1])
                //
                // let date = new Date(day[0], day[1] - 1, day[2].substr(0,2));
                // console.log(date, "at ", msgTime)

                let formattedDate = new Date(Date.parse(msg.messageDate.replace(/-/g, '/')));

                console.log(formattedDate)

                if(msg.receiverID === userSessionId) {

                    messageInfo = "<div class=''><p class='user-chat-div'>" + msg.messageDate + "<br/>" + sender.firstName + ": "+ msg.message + "</p></div>";

                } else {
                    messageInfo = "<div class=''><p class='me-chat-div'>" + msg.messageDate + "<br/>" + "Me: " + msg.message + "</p></div>";
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

                        recipientId = user.Id;

                        response.location = "" + getInboxMessages(id, user);

                        // Fetch new messages
                        setInterval(() => response.location = "" + getInboxMessages(id, user), 10000);
                        loadingTimer();

                    });

                    response.appendChild(names.documentElement);
                }

            });
        }

    }

    xmlhttp.open("GET", "ajaxUsers.php", true);
    xmlhttp.send();
}

function getMessageInput(input) {
    //TODO: create a whitelist to sanitize the data

    return myNewMessage = input.trim();
}

function createNewMessage(userId) {

    console.log("clicked:", myNewMessage)

    if (myNewMessage !== "" && recipientId !== "") {
        console.log("after")
        document.getElementById("new-chat-message").innerHTML = "";

        xmlhttp.open("POST", "ajaxCreateMessage.php?newChatMessage=" + myNewMessage + "&userID=" + userId + "&receiverID="+ recipientId, true); //ajaxCreateMessage.php?newChatMessage=test&userID=81&receiverID=41
        xmlhttp.send();

        myNewMessage = "";
    }
}

function loadingTimer() {
    setInterval(() => document.getElementById("timer").innerHTML = "Loading messages..."
        , 3000);
    setInterval(() => document.getElementById("timer").innerHTML = " " + "<br/>"
        , 7000);
}
