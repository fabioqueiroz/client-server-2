function showHint(str) {
    if (str.length === 0) {
        document.getElementById("txtHint").innerHTML = "";
        //document.getElementById("resultsSelectionBox").innerHTML = "";
        return;

    } else {
        let xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                // var uic = document.getElementById("txtHint");
                // let uic = document.getElementById("resultsSelectionBox");
                // uic.innerHTML = this.responseText;

                let uic = document.getElementById("resultsSelectionBox");
                let names = this.responseText.split(',');

                var optionValues =[];
                for (let i = 0; i < names.length; i++) {
                    let opt = document.createElement('option');
                    opt.value = names[i];
                    opt.innerHTML = names[i];
                    uic.appendChild(opt);

                    // $('#resultsSelectionBox option').each(function(){
                    //     if($.inArray(this.value, optionValues) > -1){
                    //         $(this).remove()
                    //     }else{
                    //         optionValues.push(this.value);
                    //         //uic.appendChild(opt);
                    //     }
                    // });

                }
            }
        };

        xmlhttp.open("GET", "forum.php?q=" + str, true);
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

 document.getElementById('txtHint').addEventListener('input', onClickSearchHandler, false);