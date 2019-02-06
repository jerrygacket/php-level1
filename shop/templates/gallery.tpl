	<div class="container">
        <h1>{{PAGETITLE}}</h1>
        <div class="catalog-row row">
			<h2>Добавить картинку</h2>
			<form enctype="multipart/form-data" method="POST">
				<input type="hidden" name="newfile" value="1">
				<input type="hidden" name="MAX_FILE_SIZE" value="300000" />
				Название<br><input type="text" name="name" required><br>
				Описание<br><textarea name="description" cols="30" rows="5" required></textarea><br><br>
				Файл <input type="file" name="userfile" required><br><br>
				<button type="submit">Сохранить</button>
			</form>
		</div>
        <div class="catalog-row row">
			{{GALLERY}}
        </div>
    </div>
