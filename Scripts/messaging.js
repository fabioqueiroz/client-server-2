function getInboxMessages(id)
{
    let xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {

        if (this.readyState === 4 && this.status === 200) {

            let response = document.getElementById("inbox-messages");
            response.innerHTML = "<br/>";

            let messages = JSON.parse(this.responseText);
            console.log(messages);
            console.log("loading");

        }

    }

    xmlhttp.open("GET", "inboxAjax.php?userID=" + id, true);
    xmlhttp.send();
}

