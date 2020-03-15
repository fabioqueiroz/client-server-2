let xmlhttp = new XMLHttpRequest();
let recipientId = "";
let myNewMessage = "";
let dbMessageCounter = "";
let notificationCounter = "";

function getInboxMessages(userSessionId, sender) {

    xmlhttp.onreadystatechange = function() {

        if (this.readyState === 4 && this.status === 200) {

            let response = document.getElementById("chat-message-display-area");
            response.innerHTML = "<br/>";

            let messages = JSON.parse(this.responseText);
            console.log(messages);

            let domParser = new DOMParser();

            dbMessageCounter = messages.length;
            console.log(dbMessageCounter)

            messages.forEach((msg) => {

                let messageInfo = "";

                let date = dateFormatter(msg.messageDate);

                if(msg.receiverID === userSessionId) {

                    messageInfo = "<div class=''><p class='user-chat-div'>" + date + "<br/>" + sender.firstName + ": "+ msg.message + "</p></div>";

                } else {
                    messageInfo = "<div class=''><p class='me-chat-div'>" + date + "<br/>" + "Me: " + msg.message + "</p></div>";
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

                    // let userDetails = "<p class=''>" + user.firstName + " " + user.lastName + "</p>";

                    let userDetails = "";

                    if (notificationCounter > dbMessageCounter) {

                        userDetails = "<p class=''>" + user.firstName + " " + user.lastName + " " + "<span class='badge'>New</span></p>";
                        notificationCounter = dbMessageCounter;

                    } else {
                        userDetails = "<p class=''>" + user.firstName + " " + user.lastName + "</p>";
                    }

                    let names = domParser.parseFromString(userDetails, "text/html");

                    window.innerHTML += names.documentElement.innerText;

                    names.documentElement.addEventListener('click', () => {

                        recipientId = user.Id;
                        // dbMessageCounter = notificationCounter;

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

function dateFormatter(sqlDate) {

    let formattedDate = new Date(Date.parse(sqlDate.replace(/-/g, '/')));

    return formattedDate.toLocaleString();
}

function getMessageInput(input) {
    //TODO: sanitize the data
    return myNewMessage = input.trim();
}

function createNewMessage(userId) {

    if (myNewMessage !== "" && recipientId !== "") { //ajaxCreateMessage.php?newChatMessage=test&userID=81&receiverID=41

        document.getElementById("new-chat-message").innerHTML = "";

        xmlhttp.open("POST", "ajaxCreateMessage.php?newChatMessage=" + myNewMessage + "&userID=" + userId + "&receiverID="+ recipientId, true);
        xmlhttp.send();

        notificationCounter = dbMessageCounter;
        notificationCounter += 2;
        myNewMessage = "";
    }
}

function loadingTimer() {

    function getDots() {
        let count = 0;
        setInterval(function() {
            count++;
            document.getElementById('timer').innerHTML = "Loading messages." + new Array(count % 5).join('.');
        }, 500);

        setInterval(function() {
            document.getElementById('timer').innerHTML = " " + "<br/>";
        }, 10000);

    }

    getDots();

    // setInterval(() => document.getElementById("timer").innerHTML = "Loading messages..."
    //     , 3000);

    // setInterval(() => document.getElementById("timer").innerHTML = " " + "<br/>"
    //     , 7000);
}


// TODO: set notification
// TODO: upload image
// TODO: refactor to class

