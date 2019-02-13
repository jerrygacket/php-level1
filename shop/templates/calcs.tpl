	<div class="container">
        <h1>{{PAGETITLE}}</h1>
        <div class="catalog-row row">
			<h2>Калькулятор 1</h2>
			<form method="POST">
				<input type="hidden" name="calcForm" value="1">
				<input type="text" name="var1" value="">
				<select name="action">
					<option value="+"> + </option>
					<option value="-"> - </option>
					<option value="*"> * </option>
					<option value="/"> / </option>
				</select>
				<input type="text" name="var2" value="">
				<button type="submit">Сохранить</button>
			</form>
			<br>
			{{RESULT1}}
			<hr>
		</div>
		<div class="catalog-row row">
			<h2>Калькулятор 2</h2>
			<form method="POST">
				<input type="hidden" name="calcForm" value="2">
				<input type="text" name="var1" value="">
				<input type="text" name="var2" value="">
				<button type="submit" name="action" value="+"> + </button>
				<button type="submit" name="action" value="-"> - </button>
				<button type="submit" name="action" value="*"> * </button>
				<button type="submit" name="action" value="/"> / </button>
			</form>
			<br>
			{{RESULT2}}
			<hr>
		</div>
    </div>
