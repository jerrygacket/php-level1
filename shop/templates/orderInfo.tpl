<h2>Заказ {{ORDERNUMBER}}</h2>
<p id="status_{{ID}}">Статус: {{STATUS}}</p>
<p><button class="btn btn-primary btn-rounded u-mt-20" onclick="ajax_post('add','{{ID}}','order')"><i class="fas fa-plus"></i></button>
<button class="btn btn-danger btn-rounded u-mt-20" onclick="ajax_post('del','{{ID}}','order')"><i class="fas fa-times"></i></button></p>
<table id="goods_list" cellspacing="2" border="1" cellpadding="5" width="100%" style="border: 1px solid black">
    <tr>
        <td></td>
        <td>Название</td>
        <td>Цена</td>
        <td>Количество</td>
        <td>Стоимость</td>
    </tr>
    {{GOODS}}
</table>
