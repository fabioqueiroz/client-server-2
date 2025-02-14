function showHint(str) {
    if (str.length === 0) {
        document.getElementById("txtHint").innerHTML = "";
        document.getElementById("txtHint").style.border = "0px";
        document.getElementById("resultsSelectionBox").innerHTML = "";

        return;

    } else {

        if(str.length > 2) {

            let xmlhttp = new XMLHttpRequest();

            xmlhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {

                    let response = document.getElementById("resultsSelectionBox");
                    let domParser = new DOMParser();

                    response.innerHTML = "<br/>";
                    response.style.border = "0px solid #A5ACB2";
                    response.style.width = "305px";
                    response.style.marginTop = "-32px";

                    let suggestionBody = "";
                    let suggestion = "";

                    if (this.response != "No suggestions") {

                        try{

                            let postNames = JSON.parse(this.responseText);
                            //console.log(postNames);

                            postNames.forEach((post) => {

                                suggestionBody = "<div class=''><p class='suggestion-option list-group-item'>" + post.title + "</p></div>";
                                suggestion = domParser.parseFromString(suggestionBody, "text/html");

                                // re-direct to the post
                                suggestion.documentElement.addEventListener('click', () => {
                                    window.location.href = "postReplies.php?postID=" + post.postId + "&postingUser=" + post.postingUser;
                                });

                                response.appendChild(suggestion.documentElement);

                            });

                        } catch (e) {
                            console.log(e.message);
                        }

                    } else {

                        suggestionBody = "<div class=''><p class='no-suggestion-option list-group-item'>" + "No matches found" + "</p></div>";
                        suggestion = domParser.parseFromString(suggestionBody, "text/html");

                        response.appendChild(suggestion.documentElement);
                    }
                }
            };

            let newToken = document.getElementById("live-search-checker").value;

            xmlhttp.open("GET", "liveSearch.php?q=" + str + "&token=" + newToken, true);
            xmlhttp.send();
        }

    }
}

// // **** draft infinite scrolling ****
// let listElm = document.querySelector('#infinite-list');
//
// // Add 20 items.
// let nextItem = 1;
// let loadMore = function() {
//     for (let i = 0; i < 20; i++) {
//         let item = document.createElement('li');
//         item.innerText = 'Item ' + nextItem++;
//
//         // fetch('../forum.php').then(function (response) {
//         //     return response.text(); }).then(function (data) {
//         //     document.getElementById('infinite-list').innerText = data;
//         //     console.log(data);
//         // }).catch(function (error) {
//         //     document.getElementById('infinite-list').innerText ='Error: ' + error;
//         // });
//         listElm.appendChild(item);
//     }
// }
//
// // Detect when scrolled to bottom.
// listElm.addEventListener('scroll', function() {
//     if (listElm.scrollTop + listElm.clientHeight >= listElm.scrollHeight) {
//         loadMore();
//     }
// });
//
// // Initially load some items.
// loadMore();
