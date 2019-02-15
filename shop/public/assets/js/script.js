function myFunction(id,btn) {
  var y = document.getElementById("feedback-"+id);
  var x = document.getElementById("editForm-"+id);
  if (x.style.display === "none") {
    x.style.display = "block";
    y.style.display = "none";
    document.getElementById("btn-"+id).innerHTML = "Скрыть";
  } else {
    x.style.display = "none";
    y.style.display = "block";
    document.getElementById("btn-"+id).innerHTML = "Править";
  }
} 

function ajax_get(action, id_product, quantity, callback) {
    var url = "http://shop/?action=" + action + "&id_product=" + id_product + "&quantity=" + quantity;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            console.log('responseText:' + xmlhttp.responseText);
            try {
                var data = JSON.parse(xmlhttp.responseText);
            } catch(err) {
                console.log(err.message + " in " + xmlhttp.responseText);
                return;
            }
            callback(data);
        }
    };
 
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}
 
function getResponse(data) {
    //document.getElementById("resp").innerHTML = data["resp"]['action'] + ' ' + data["resp"]['id'];
    console.log(data);
};
