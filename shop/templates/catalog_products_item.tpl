<div class="col-md-4 mt-5">
				<div class="bg-white rounded box-shadow-v2">
					<h4 class="m-0 py-4">
						<a href="/catalog/{{ID}}">
							{{NAME}}
						</a>
					</h4>
					<hr class="m-0">
					<div class="u-my-40">
						<a href="/catalog/{{ID}}">
							<img src="{{IMGSMALL}}" alt="{{NAME}}">
						</a>
					</div>
					<h4 class="text-red my-4">
						<i class="fas fa-ruble-sign" style="font-size:16px"></i> {{PRICE}}
					</h4>
					<button class="btn btn-outline-primary btn-rounded mb-5" onclick="ajax_get('add','{{ID}}','1',getResponse)">
						Добавить
					</button>
					<br>
					Просмотров: {{VIEWS}}
				</div>
			</div>
