Elaborado por Walter Carvajal 


Los seeders crean un usuario ADMIN -> adminuno@gmail.com password->12345678
Admin es el único que puede crear usuarios.

Rutas no protegidas

POST http://localhost:8000/api/login  -> Ingreso al sistema.
GET http://localhost:8000/api/posts  -> Muestra todos los posts.
GET http://localhost:8000/api/categories  -> Muestra todas las categorías.

Rutas protegidas

POST http://localhost:8000/api/register  -> Crea un usuario. Debe estar logeado como ADMIN.

{
    "name": "lectoruno",
    "email": "lectoruno@gmail.com",
    "password": "12345678",
    "password_confirmation": "12345678",
    "role": "ROLE_READER"
}

GET  http://localhost:8000/api/users  -> Muestra todos los usuarios. Solo Admin.

GET http://localhost:8000/api/users/{id}  -> Muestra un usuario específico. Solo ADMIN.

GET http://localhost:8000/api/user -> Muestra información del usuario logueado.





GET http://localhost:8000/api/posts/{id}  -> Muestra un post específico por el id  -> Solo ADMIN - AUTHOR.

POST http://localhost:8000/api/posts  -> Crea un post -> ADMIN - AUTHOR
 {
        "title": "Post tres",
        "description": "tercer post",
        "status": "Published",
        "content": "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.",
        "user_id": "2",
        "category_id": "3"
    }

PUT http://localhost:8000/api/posts/{id}  -> Edita un post. Solo los propios del usuario logueado.

DELETE http://localhost:8000/api/posts/{id}   -> Elimina un post. Solo los propios del usuario logueado.



GET http://localhost:8000/api/categories  -> Ver todas las categorías. Todos los usuarios.

GET http://localhost:8000/api/categories/{id}  -> Ver una categoría específica. Todos los usuarios.

POST http://localhost:8000/api/categories  -> Crea una categoría. Solo ADMIN

PUT http://localhost:8000/api/categories/{id}  -> Edita una categoría. Solo ADMIN

DELETE http://localhost:8000/api/categories/{id}  -> Elimina una categoría. Solo ADMIN.
