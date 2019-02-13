<section id="about">  
  <div class="container">
   <div class="row align-items-center">
   <div class="col-lg-5">
	   <a href="{{IMG}}" target="_blank"><img src="{{IMG}}" alt="{{NAME}}" class="product-img"></a>
   </div>
		 <div class="col-lg-6 ml-auto">
			 <h2 class="h1">
				 {{NAME}}
			 </h2>
			 <div class="u-h-4 u-w-50 bg-primary rounded mt-4 mb-5"></div>
			 <p class="my-3">
				{{INTRO}}
			 </p>
			 <p class="my-3">
				Просмотров: {{VIEWS}}
			 </p>
			 <ul class="list-unstyled u-fw-600 u-lh-2 mt-4 mb-5">
				 <li><i class="fa fa-check text-primary mr-2"></i>Размер: {{SIZE}} </li>
				 <li><i class="fa fa-check text-primary mr-2"></i>Ткань: {{FABRIC}} </li>
				 <li><i class="fa fa-check text-primary mr-2"></i>Краска: {{PAINT}} </li>
			 </ul>
			 <button class="btn btn-rounded btn-primary" onclick="ajax_get('add','{{ID}}','1',getResponse)">
						Купить
					</button>
		 </div>  <!-- END col-lg-6-->
	 </div><!--END row-->
  </div> <!-- END container-->
</section>

<p class="my-3">
				{{DESCRIPTION}}
			 </p>
			  <h2 class="h2-prod">Оставить отзыв</h2>
				<form method="POST">
					<input type="hidden" name="productid" value="{{PRODUCTID}}">
					Ваше имя <input type="text" name="username" required><br>
					Заголовок <input type="text" name="header" required><br>
					Комментарий<br><textarea name="comment" cols="30" rows="5" required></textarea><br><br>
					<button type="submit" name="action" value="create">Отправить</button>
				</form>
				
				<h2 class="h2-prod">Отзывы</h2>
				<div class="catalog-row">{{FEEDBACK}}</div>
