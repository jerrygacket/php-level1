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

function ajax_post(action, id, element) {
    console.log(action + id + element);
    $.post(
        "/index.php",
        {
            action: action,
            id: id,
            element: element
        },
        onAjaxSuccess
    );

    function onAjaxSuccess(data)
    {
        // Здесь мы получаем данные, отправленные сервером и выводим их на экран.
        var arr = JSON.parse(data);
        alert(arr.message);
        document.getElementById('status_'+arr.id).innerHTML = 'Статус: ' + arr.newstatus;
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
    //console.log(data);
    var table = document.getElementById("goods_list");
    switch (data['action']) {
        case 'del':
            var r = document.getElementById("good_" + data['id']);
            var i = r.rowIndex;
            table.deleteRow(i);
            var sum = 0;
            for (var i = 1, row; row = table.rows[i]; i++) {
                sum = sum + parseFloat(row.cells[4].innerText);
            }
            document.getElementById('total').innerHTML = "Итого: " + sum;
            if (sum == 0) {
                document.getElementById('orderform').remove();
            }
            break;
        case 'clr':
            //сделал просто релоад. удалить все кроме заголовка не получилось
            //всегда остается одна строка с товаром
            location.reload();
            break;
    }
};
