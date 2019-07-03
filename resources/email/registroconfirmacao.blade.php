<!DOCTYPE html>
<html>
<head>
	<title>Confirme seu email.</title>
</head>
<body>
	<h4>Seja bem vindo(a), {{$nome}}</h4>
	<p>Você acabou de acessar o sistema utilizando o email: {{$email}}</p>

	<p>Data e hora de acesso: {{$datahora}}</p>

	<p>Clique no link para confirmar seu cadastro:</p>
	<a href="{{$link}}">Clique Aqui Para Validar seu E-mail</a>
</body>
</html>