email = 'lean251290@gmail.com.ar'
signo = ['.', '_', '-']
numeros = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9']
domnios = ['gmail', 'hotmail', 'msn', 'outlook', 'yahoo', 'live']
minusculas = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z']
mayusculas = []
extensiones = ['com', 'com.ar', 'ar']
problema = ""
#busco si tengo un arroba en la variable
if email.find('@') != -1:
	#separo el email en un array
	nuevo_email = email.split('@')
	#asigno el nombre de la posicion 0
	nombre = nuevo_email[0]
	#asigno el dominio de la posicion 1
	dominio = nuevo_email[1]
	print(f"el nombre es: {nombre}")
	print(f"el dominio es: {dominio}")
	#separo el dominio en un array
	partedeldominio = dominio.split('.')
	longitud = len(partedeldominio)
	print(f"la longitud es: {longitud}")
	if longitud == 2 :
		parte1 = partedeldominio[0]
		parte2 = partedeldominio[1]
		print(f"la primera parte del dominio es: {parte1}")
		print(f"la segunda parte del dominio es: {parte2}")
	else:
		parte1 = partedeldominio[0]
		parte2 = partedeldominio[1]
		parte3 = partedeldominio[2]
		print(f"la primera parte del dominio es: {parte1}")
		print(f"la segunda parte del dominio es: {parte2}")
		print(f"la tercera parte del dominio es: {parte3}")
else:
	problema +="el mail no tiene un arroba"
	print(problema)