let xmlhttp = new XMLHttpRequest();

let recipientId = "";
let myNewMessage = "";
let dbMessageCounter = "";
let notificationCounter = "";
let selectedUser = "";

const url = 'imageProcessor.php';
const form = document.querySelector('form');

// Listen for form submit on file uploading
form.addEventListener('submit', e => {
    e.preventDefault();

    const files = document.querySelector('[type=file]').files;
    const formData = new FormData();

    for (let i = 0; i < files.length; i++) {
        let file = files[i];

        formData.append('files[]', file);
    }

    fetch(url + "?userID=" + userId + "&receiverID="+ recipientId , {
        method: 'POST',
        body: formData,
    }).then(response => {
        return response.text();
        //console.log(response)

    }).catch(function (error) {
        files.innerText ='Error: ' + error;
    });
})


// Load users when the page opens
function getChatUsers(id) {

    //getInboxCounter(id);
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
                        userDetails = "<div onclick='displayActiveName()'><p class=''>" + user.firstName + " " + user.lastName + "</p></div>";
                    }


                    let names = domParser.parseFromString(userDetails, "text/html");

                    window.innerHTML += names.documentElement.innerText;

                    names.documentElement.addEventListener('click', () => {

                        recipientId = user.Id;

                        response.location = "" + getInboxMessages(id, user);

                        let inbox = new InboxManager(id, user);
                        //response.location = "" + inbox.getInboxMessages(); // TODO: ***** bug not showing sender name ****

                        // Fetch new messages
                         //setInterval(() => response.location = "" + getInboxMessages(id, user), 10000);
                        //setInterval(() => response.location = "" + inbox.getInboxMessages(), 10000);
                        inbox.loadingTimer();

                        selectedUser = user.firstName + " " + user.lastName;

                    });

                    response.appendChild(names.documentElement);
                }

            });
        }

    }

    xmlhttp.open("GET", "ajaxUsers.php", true);
    xmlhttp.send();
}

function displayActiveName() {

    let selectedName = document.getElementById("selected-user");
    selectedName.innerHTML = selectedUser + "<br/>";
    selectedName.classList.add("user-active-name");
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

    if (myNewMessage !== "" && recipientId !== "") {

        document.getElementById("new-chat-message").innerHTML = "";

        xmlhttp.open("POST", "ajaxCreateMessage.php?newChatMessage=" + myNewMessage + "&userID=" + userId + "&receiverID="+ recipientId, true);
        xmlhttp.send();

        notificationCounter = dbMessageCounter + 2;
        myNewMessage = "";
    }
}

// TODO: ////////////////////////// classes  ///////////////////////////////////

class UserChatMessage {

    constructor(msg, userSessionId, sender, date, myImage) {
        this._msg = msg;
        this._userSessionId = userSessionId;
        this._sender = sender;
        this._date = date;
        this._myImage = myImage;
    }

     displayMessage() {

        let messageInfo = "";

        if(this._msg.receiverID === this._userSessionId ) {

            if (this._msg.message === null) {

                messageInfo = "<div class=''><p class='user-chat-div'>" + this._date + "<br/>" + this._sender.firstName + "<img id='img-size' src='" + this._myImage.src + "'/>" + "</p></div>";

            } else {
                messageInfo = "<div class=''><p class='user-chat-div'>" + this._date + "<br/>" + this._sender.firstName + ": "+ this._msg.message + "</p></div>";
            }


        } else {

            if (this._msg.message === null) {

                messageInfo = "<div class=''><p class='me-chat-div'>" + this._date + "<br/>" + "Me: " + "<img id='img-size' src='" + this._myImage.src + "'/>" + "</p></div>";

            } else {
                messageInfo = "<div class=''><p class='me-chat-div'>" + this._date + "<br/>" + "Me: " + this._msg.message + "</p></div>";
            }

        }

        return messageInfo;
    }
}

class InboxManager {

    constructor(userSessionId, sender) {
        this._userSessionId = userSessionId;
        this._sender = sender;

    }

    getInboxMessages() {

        xmlhttp.onreadystatechange = function() {

            if (this.readyState === 4 && this.status === 200) {

                let response = document.getElementById("chat-message-display-area");
                response.innerHTML = "<br/>";

                let messages = JSON.parse(this.responseText);
                console.log(messages);

                let domParser = new DOMParser();

                dbMessageCounter = messages.length;
                console.log("dbMessageCounter: ", dbMessageCounter)
                //console.log("notificationCounter", notificationCounter)

                messages.forEach((msg) => {

                    let date = dateFormatter(msg.messageDate);

                    let myImage = new Image(100, 100);
                    myImage.src = msg.image;

                    let userChatMessage = new UserChatMessage(msg, this._userSessionId, this._sender, date, myImage);

                    let message = domParser.parseFromString(userChatMessage.displayMessage(), "text/html");

                    window.innerHTML += message.documentElement.innerText;

                    response.appendChild(message.documentElement);
                });

            }

        }

        xmlhttp.open("GET", "ajaxMessaging.php?userID=" + this._userSessionId + "&senderID="+ this._sender.Id, true);
        xmlhttp.send();
    }

    // TODO: fix notification
    loadingTimer() {

        function moveDots() {
            let count = 0;
            setInterval(function() {
                count++;
                document.getElementById('timer').innerHTML = "Loading messages." + new Array(count % 5).join('.');
            }, 500);

            setInterval(function() {
                document.getElementById('timer').innerHTML = " " + "<br/>";
            }, 10000);

        }

        moveDots();

        // setInterval(() => document.getElementById("timer").innerHTML = "Loading messages..."
        //     , 3000);

        // setInterval(() => document.getElementById("timer").innerHTML = " " + "<br/>"
        //     , 7000);
    }

}

// TODO: ////////////////////////// load initial data  ///////////////////////////////////

function getInboxCounter(sessionId) {
    let inboxCounter = document.getElementById("inbox-counter");
    let counterDiv = document.getElementById("inbox-counter-div");
    inboxCounter.innerHTML = notificationCounter;
    console.log(inboxCounter.innerHTML);

    // if (counterDiv.style.display === "block") { // inboxCounter.innerHTML !== "" // counterDiv.style.display === "block"
    //     counterDiv.style.display = "none";
    //
    // } else {
    //     counterDiv.style.display = "block";
    // }

    xmlhttp.open("GET", "ajaxNotification.php?userID=" + sessionId, true);
    xmlhttp.send();

}


// TODO: ////////////////////////// replaced methods  ///////////////////////////////////

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

                let date = dateFormatter(msg.messageDate);

                let myImage = new Image(100, 100);
                myImage.src = msg.image;

                let userChatMessage = new UserChatMessage(msg, userSessionId, sender, date, myImage);

                let message = domParser.parseFromString(userChatMessage.displayMessage(), "text/html");

                // let messageInfo = "";
                //
                // // create class for this conversion
                // if(msg.receiverID === userSessionId) {
                //
                //     // messageInfo = "<div class=''><p class='user-chat-div'>" + date + "<br/>" + sender.firstName + ": "+ msg.message + "</p></div>";
                //
                //     if (msg.message === null) {
                //
                //         messageInfo = "<div class=''><p class='user-chat-div'>" + date + "<br/>" + sender.firstName + "<img id='img-size' src='" + myImage.src + "'/>" + "</p></div>"; // width='100' height='100'
                //
                //     } else {
                //         messageInfo = "<div class=''><p class='user-chat-div'>" + date + "<br/>" + sender.firstName + ": "+ msg.message + "</p></div>";
                //     }
                //
                //
                // } else {
                //
                //     // messageInfo = "<div class=''><p class='me-chat-div'>" + date + "<br/>" + "Me: " + msg.message + "</p></div>";
                //
                //     if (msg.message === null) {
                //
                //         messageInfo = "<div class=''><p class='me-chat-div'>" + date + "<br/>" + "Me: " + "<img id='img-size' src='" + myImage.src + "'/>" + "</p></div>"; // width='100' height='100'
                //
                //     } else {
                //         messageInfo = "<div class=''><p class='me-chat-div'>" + date + "<br/>" + "Me: " + msg.message + "</p></div>";
                //     }
                //
                // }
                //
                // let message = domParser.parseFromString(messageInfo, "text/html");

                window.innerHTML += message.documentElement.innerText;

                response.appendChild(message.documentElement);
            });

        }

    }

    xmlhttp.open("GET", "ajaxMessaging.php?userID=" + userSessionId + "&senderID="+ sender.Id, true);
    xmlhttp.send();
}

// function typingTimer() {
//
//     function moveDots() {
//         let count = 0;
//         setInterval(function() {
//             count++;
//             document.getElementById('timer').innerHTML = "." + new Array(count % 5).join('.');
//         }, 500);
//
//         setInterval(function() {
//             document.getElementById('timer').innerHTML = " " + "<br/>";
//         }, 10000);
//
//     }
//
//     moveDots();
//
//     // setInterval(() => document.getElementById("timer").innerHTML = "Loading messages..."
//     //     , 3000);
//
//     // setInterval(() => document.getElementById("timer").innerHTML = " " + "<br/>"
//     //     , 7000);
// }