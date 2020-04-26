let xmlhttp = new XMLHttpRequest();

let recipientId = "";
let myNewMessage = "";
let dbMessageCounter = ""; // returns the number of messages between 2 users
let totalNoOfMessagesInDb = ""; // returns the total number of messages sent to the session user
let selectedUser = "";
let chatUser = "";
let info = "";

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
});

// Notification, get the total number of messages sent to the session user
async function notificationChecker(sessionId)
{
    let response = await fetch(`ajaxNotification.php?userID=${sessionId}`);
    let data = await response.json();
    document.getElementById('inbox-counter').innerHTML = "" + data;
    totalNoOfMessagesInDb = data;
    return data;
}


// Load users when the page opens
function getChatUsers(sessionId) {

    // Check the total number of messages when the page loads
    notificationChecker(sessionId)
        .then(data => console.log(data))
        .catch((error) => {
            Error(error);
            console.log(error)
        });

    let response = "";
    let inbox = "";

    // Retrieve and output a list of all the users
    xmlhttp.onreadystatechange = function() {

        if (this.readyState === 4 && this.status === 200) {

            response = document.getElementById("chat-user");
            response.innerHTML = "<br/>";

            let users = JSON.parse(this.responseText);
            //console.log(users);

            let domParser = new DOMParser();

            users.forEach((user) => {

                if(user.Id !== sessionId) {

                    let userDetails = "<div onclick='HelperClass.displayActiveName(); HelperClass.displayDots();'><p class=''>" + user.firstName + " " + user.lastName + "</p></div>";

                    let names = domParser.parseFromString(userDetails, "text/html");

                    window.innerHTML += names.documentElement.innerText;

                    names.documentElement.addEventListener('click', () => {

                        recipientId = user.Id;
                        chatUser = user;

                        response.location = "" + getInboxMessages(sessionId, chatUser); // working correctly

                        inbox = new InboxManager(sessionId, user);
                        //response.location = "" + inbox.getInboxMessages();

                        selectedUser = user.firstName + " " + user.lastName;

                    });

                    response.appendChild(names.documentElement);
                }

            });
        }

    }

    xmlhttp.open("GET", "ajaxUsers.php", true);
    xmlhttp.send();

    setInterval(() => {

        InboxManager.loadingTimer();

        // // **** Uncomment to update the inbox counter ****
        // notificationChecker(sessionId)
        //     .then(data => console.log(data))
        //     .catch((error) => {
        //         Error(error);
        //         console.log(error)
        //     });

        // Fetch new messages
        response.location = "" + getInboxMessages(sessionId, chatUser); // working correctly
        //response.location = "" + inbox.getInboxMessages();

    }, 5000);

}

// Class definitions
class InboxManager {

    constructor(userSessionId, sender) {
        this._userSessionId = userSessionId;
        this._sender = sender;
    }

    // Not identifying the user's message colour
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

                messages.forEach((msg) => {

                    let date = HelperClass.dateFormatter(msg.messageDate);

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

    static loadingTimer() {

        function moveDots() {
            let count = 0;
            setInterval(function() {
                count++;
                document.getElementById('timer').innerHTML = "Checking for new messages." + new Array(count % 5).join('.');
            }, 500);

            setInterval(function() {
                document.getElementById('timer').innerHTML = " " + "<br/>";
            }, 5000);

        }

        moveDots();

    }

}

class UserChatMessage extends InboxManager {

    constructor(msg, userSessionId, sender, date, myImage) {
        super(userSessionId, sender)
        this._msg = msg;
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

    static getMessageInput(input) {
        //TODO: sanitize the data
        return myNewMessage = input.trim();
    }

    static createNewMessage(userId) {

        if (myNewMessage !== "" && recipientId !== "") {

            let newChatToken = document.getElementById("chat-checker").value;

            xmlhttp.open("POST", "ajaxCreateMessage.php?newChatMessage=" + myNewMessage + "&userID=" + userId + "&receiverID="+ recipientId + "&chatToken=" + newChatToken, true);
            xmlhttp.send();

            document.getElementById("new-chat-message").value = "";

        }
    }
}

class HelperClass {

    static displayActiveName() {

        let selectedName = document.getElementById("selected-user");
        selectedName.innerHTML = selectedUser + "<br/>";
        selectedName.classList.add("user-active-name");
    }

    static displayDots() {

        // Display the 3 moving message dots
        let dotsContainer = document.getElementById("dots-container");
        dotsContainer.classList.add("ticontainer");

        let dotsBlock = document.getElementById("dots-block");
        dotsBlock.classList.add("tiblock");

        let singleDot = document.getElementById("dots-single-dot");
        singleDot.classList.add("tidot");

        let singleDotTwo = document.getElementById("dots-single-dot-2");
        singleDotTwo.classList.add("tidot");

        let singleDotThree = document.getElementById("dots-single-dot-3");
        singleDotThree.classList.add("tidot");

        // Hide the timer
        document.getElementById('timer').style.display = "none";
    }

    static dateFormatter(sqlDate) {

        let formattedDate = new Date(Date.parse(sqlDate.replace(/-/g, '/')));

        return formattedDate.toLocaleString();
    }
}

// Retrieve messages in the inbox
function getInboxMessages(userSessionId, sender) {

    xmlhttp.onreadystatechange = function() {

        if (this.readyState === 4 && this.status === 200) {

            let response = document.getElementById("chat-message-display-area");
            response.innerHTML = "<br/>";

            let messages = JSON.parse(this.responseText);
            //console.log(messages);

            let domParser = new DOMParser();

            dbMessageCounter = messages.length;
            //console.log("dbMessageCounter: ", dbMessageCounter);

            messages.forEach((msg) => {

                let date = HelperClass.dateFormatter(msg.messageDate);

                let myImage = new Image(100, 100);
                myImage.src = msg.image;

                let userChatMessage = new UserChatMessage(msg, userSessionId, sender, date, myImage);

                let message = domParser.parseFromString(userChatMessage.displayMessage(), "text/html");

                window.innerHTML += message.documentElement.innerText;

                response.appendChild(message.documentElement);
            });

        }

    }

    if (sender.Id !== undefined) {

        let newChatToken = document.getElementById("chat-checker").value;

        xmlhttp.open("GET", "ajaxMessaging.php?userID=" + userSessionId + "&senderID="+ sender.Id + "&chatToken=" + newChatToken, true);
        xmlhttp.send();
    }

}

// Notification
// Get the last message sent to the session user
async function findLastMessage(sessionId)
{
    let response = await fetch(`ajaxAlert.php?userID=${sessionId}`);
    let data = await response.json();
    info = data[0].firstName + " at " + HelperClass.dateFormatter(data[0].messageDate);

    return data;
}

function notifyMe(sessionId) {
    // Check if the browser supports notifications
    if (!("Notification" in window)) {
        alert("This browser does not support desktop notification");
    }

    // Check whether notification permissions have already been granted
    else if (Notification.permission === "granted") {

        let messageInfo = [];
        // Query the last entry in the db
        findLastMessage(sessionId)
            .then(data => console.log(data))
            .then(data => messageInfo = data)
            .catch((error) => {
                Error(error);
                console.log(error)
            });


        // If it's ok create a notification
        let notification = new Notification(`Last message from: ${info}`);
        notification.onshow = () => new Notification(`Last message from:`, {
            body: `${info}`
        });


    }

    // Otherwise ask the user for permission
    else if (Notification.permission !== "denied") {
        Notification.requestPermission().then(function (permission) {
            // If the user accepts, let's create a notification
            if (permission === "granted") {
                let notification = new Notification("Hi there!");
            }
        });
    }
}














