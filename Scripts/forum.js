function showHint(str) {
    if (str.length === 0) {
        document.getElementById("txtHint").innerHTML = "";
        document.getElementById("txtHint").style.border = "0px";
        return;

    } else {
        let xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {

                let uic = document.getElementById("resultsSelectionBox");
                let names = this.responseText.split(", "); // ","
                //console.log(names);
                let dom = new DOMParser();


                if (this.response != "no suggestions") {
                    uic.innerHTML = "<br/>";
                    uic.style.border = "1px solid #A5ACB2";
                    uic.style.width = "305px";
                    uic.style.marginTop = "-16px";
                    console.log(this.responseText);
                    let postNames = JSON.parse(this.responseText);
                    console.log(postNames);

                    postNames.forEach(function (obj) {
                        //uic.innerHTML += "<ul>" + obj.title + "</ul>";
                        let suggestionBody = "<ul>" + obj.title + "</ul>";
                        let suggestion = dom.parseFromString(suggestionBody, "text/html");
                        // search for substitute for documentElement
                        suggestion.documentElement.addEventListener('click', () => {
                            window.location.href = "postReplies.php?postID=" + obj.postId + "&postingUser=" + obj.postingUser;
                        });
                        uic.appendChild(suggestion.documentElement);
                        //console.log(obj.name);
                    });

                }
            }
        };


        xmlhttp.open("GET", "liveSearch.php?q=" + str, true);
        xmlhttp.send();
    }
}

function onClickSearchHandler(event) {
    document.getElementById('txtHint').innerText = 'fetching...';
    fetch('../forum.php').then(function (response) {
        return response.text(); }).then(function (data) {
        document.getElementById('txtHint').innerText = data;
        console.log(data);
    }).catch(function (error) {
        document.getElementById('txtHint').innerText ='Error: ' + error;
    });
}

 //document.getElementById('txtHint').addEventListener('input', onClickSearchHandler, false);


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
