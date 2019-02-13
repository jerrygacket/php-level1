<div class="feedback-item">
	<button id="btn-{{ID}}" onclick="myFunction({{ID}})">Править</button>
	<div id="feedback-{{ID}}" style="display:block">
		<h3>{{HEADER}}</h3>
		<small>{{USERNAME}}, создан: {{DATE}}, редактирован: {{UPDATED}}</small>
		<p>{{COMMENT}}</p>
	</div>
	<form method="POST">
		<div id="editForm-{{ID}}" style="display:none">
			<input type="hidden" name="feedbackid" value="{{ID}}">
			Ваше имя {{USERNAME}}<br>
			Заголовок <input type="text" name="header" value="{{HEADER}}" required><br>
			Комментарий<br><textarea name="comment" cols="30" rows="5" required>{{COMMENT}}</textarea><br><br>
			<button type="submit" name="action" value="update">Сохранить</button>
			<button type="submit" name="action" value="delete">Удалить</button>
		</div>
	</form>
</div>
<hr>
