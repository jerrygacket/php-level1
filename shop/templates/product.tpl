    <div class="container">
        <h1>{{NAME}}</h1>
        <div class="product-card">
            <h2 class="h2-prod">Описание</h2>
            <a href="{{IMG}}" target="_blank"><img src="{{IMGBIG}}" alt="{{NAME}}" style="max-width: 100px;" class="product-img"></a>
            <p class="product-intro">{{INTRO}}</p>
            <p>Просмотров: {{VIEWS}}</p>
            <button class="form-item product-button">Купить</button>
        </div>
        <h2 class="h2-prod">Технические характеристики</h2>
        <table class="product-options">
			<tr>
				<td>Размер</td>
				<td>{{SIZE}}</td>
			</tr>
			<tr>
				<td>Ткань</td>
				<td>{{FABRIC}}</td>
			</tr>
			<tr>
				<td>Краска</td>
				<td>{{PAINT}}</td>
			</tr>
		</table>
        <br>
        <h2 class="h2-prod">Подробное описание</h2>
        <p class="description">{{DESCRIPTION}}</p>
        
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
    </div>
