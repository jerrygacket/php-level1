<section class="pt-0">
	<div class="container">
		<div class="row align-items-center">			
			<div class="col-lg-12 mt-5">
					<table cellspacing="2" border="1" cellpadding="5" width="100%" style="border: 1px solid black">
						<tr>
						<td></td>
						<td>Название</td>
						<td>Цена</td>
						<td>Количество</td>
						<td>Стоимость</td>
						<td></td>
						</tr>
						{{GOODS}}
					</table>
					<p>Итого: {{ORDERCOST}}</p>
					<button class="btn btn-danger btn-rounded u-mt-20 " onclick="ajax_get('clr','','',getResponse)">Очистить корзину</button>
<!--
					<pre id="resp"></pre>
-->
			</div> <!-- END col-lg-6-->
		</div> <!-- END row-->
	</div> <!-- END container-->
</section>

