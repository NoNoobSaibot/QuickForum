{{title: "Страница авторизации"}}
<div>
	<h3>Войти</h3>
	<form method='post' action='/login'>
		<label>Логин</label>
		<input id ='login' name='login'></input>
		<br>
		<label>Пароль</label>
		<input id ='password' name='password'></input>
		<button type='submit'>Войти</button>
	</form>
	<a href='/email'>Забыли пароль?</a> <br> <a href='/registration'>Регистрация</a>
</div>