# Ecommercefull
![ecommercefull](https://github.com/user-attachments/assets/bc5736e3-4c11-463d-b6e1-b23c11ba2ab1)

Ecommercefull - Prueba Tecnica

# Descripción de la tarea

Utilizando PHP debes realizar un pequeño desarrollo con su API.

-Deberás crear acorde a la documentación dos usuarios de test, uno para utilizar como
vendedor y otro para utilizar como comprador.

-Luego debes publicar algunos productos con el usuario vendedor.
-Con el usuario comprador, realizarás algunas compras de esos productos.

El desarrollo deberá cumplir los siguientes items:
- Listado de productos del usuario vendedor.
Deberás listar los productos que el usuario tiene a la venta, con su estado, precio y la
información extra que decidas mostrar.

- Listado de órdenes o pedidos.
Deberás listar los pedidos que tiene el usuario vendedor que fueran realizados
anteriormente con el usuario comprador. Los datos a mostrar los dejamos a tu criterio.
Será tomado como un plus que la información que obtengas de Mercado Libre la guardes en
una base de datos, y que hagas un listado de esa información de la base de datos. El diseño
de la vista no es tan importante.

Proceso:
1. Levantar proyecto con PHP (en este caso Laravel) en un hosting, para obtener una URL con https
2. Enviar a URL, datos de aplicación de ML

![image](https://github.com/user-attachments/assets/8262cef6-fdd0-4559-9c08-ebaba1e7c425)


URL:

```php
//ejemplpo
//solictud:
https://auth.mercadolibre.com.uy/authorization?response_type=code&client_id=4758386807404546&redirect_uri=https://ecommercefull.jar-test.online/
//pegar en browser
//respuesta:
https://ecommercefull.jar-test.online/?code=TG-6694bd4b99a4a5000133a57e-632351224
```

> Importante tener actualizado el “TG” (cambia cada 6hs)
> 
1. Teniendo esta respuesta, hacemos solicitud de token, con POST

```php
//ejemplo de solicitud
curl -X POST \
-H 'accept: application/json' \
-H 'content-type: application/x-www-form-urlencoded' \
'https://api.mercadolibre.com/oauth/token' \
-d 'grant_type=authorization_code' \
-d 'client_id=4758386807404546' \
-d 'client_secret=5ok0GphAlzteXOAIO07L5lShXngDE0eY' \
-d 'code=TG-6694bd4b99a4a5000133a57e-632351224' \
-d 'redirect_uri=https://ecommercefull.jar-test.online/' \ 
```

> Se puede importar en Postman
> 

```php
//ejemplo obtiene en respuesta json
{
    "access_token": "APP_USR-4758386807404546-071502-8e455c5edae8e9fcede86ad971a4a06e-632351224",
    "token_type": "Bearer",
    "expires_in": 21600,
    "scope": "offline_access read write",
    "user_id": 632351224,
    "refresh_token": "TG-6694bd91866e7200018e2955-632351224"
}
```

1. Obtenemos los datos de nuestra conexión

```php
//solicitud de ejemplo
$ curl -X GET -H 'Authorization: Bearer $ACCESS_TOKEN'  https://api.mercadolibre.com/users/me
```
