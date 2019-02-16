<form id="orderform" action="/getorder" method="POST">

	<div class="input-group u-rounded-50 border u-of-hidden u-mb-20">
		<div class="input-group-addon bg-white border-0 pl-4 pr-0">
			<span class="icon icon-User text-primary"></span>
		</div>
		<input type="text" class="form-control border-0 p-3" name="name" placeholder="имя">
	</div>

	<div class="input-group u-rounded-50 border u-of-hidden u-mb-20">
		<div class="input-group-addon bg-white border-0 pl-4 pr-0">
			<span class="icon icon-Mail text-primary"></span>
		</div>
		<input type="email" class="form-control border-0 p-3" placeholder="емаил" name="login">
	</div>

	<div class="input-group u-rounded-50 border u-of-hidden u-mb-20">
		<div class="input-group-addon bg-white border-0 pl-4 pr-0">
			<span class="icon icon-Mail text-primary"></span>
		</div>
		<textarea class="form-control border-0 p-3" placeholder="Комментарий" name="comment"></textarea>
	</div>

	<button type="submit" name="getorder" class="btn btn-primary btn-rounded u-mt-20 u-w-170">
		Заказать
	</button>
</form>