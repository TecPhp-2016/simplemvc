<?php 

?>

<form action="/mvc/user/save" method="POST">
	<div><label for="name">Nombre</label></div>
	<div><input type="text" name="name"  /></div>
	<div><label for="password">Password</label></div>
	<div><input type="password" name="password" /></div>
	<div><label for="age">Edad</label></div>
	<div><input type="text" name="age" /></div>

	<input type="submit" name='enviar' value="Guardar">
</form>