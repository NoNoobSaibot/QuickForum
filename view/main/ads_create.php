{{title: "Создание темы"}}
{{logout: "<a href="/auth">войти</a>"}}
{{login: "Гость"}}
<div>
	<h3>Создание темы</h3>
	<div>
		<form method='post' action='/save/topic'>
			<label>тема:</label> <br>
			<input name='topic'></input><br>
			<label>описание:</label><br>
			<textarea placeholder='Напишите описание' type='text' name='description' cols=" 30" rows="5"></textarea><br>
			<button type='submit'>опубликовать</button>
		</form>
	</div>
</div>
<a href='/'>Вернуться на главную страницу</a>