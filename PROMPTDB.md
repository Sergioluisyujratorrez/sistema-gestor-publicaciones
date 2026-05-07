Estoy desarrolando un sistema mononilito en laravel llamado "Gestor de publicaciones y proyectos". 

Mi base de datos se llama: eventos.

IMPORTANTE: 
El sistema ya tiene las tablas por defecto de laravel: 
- users
- migrations
- cache
- cache_locks
- jobs
- job_batches
- failed_jobs
- sessions
- password_reset_tokens

NO modificar ni eliminar las tablas internas de laravel. 
NO ejecutar php artisan migrate todavia.
Solo generar migraciones, modelos Eloquent y relaciones. 

El sistema sera monolitico en laravel.
Usare Blade, PHP, JAVASCRIPT, HTML, CSS.
No usare React, vue, ni frameworks de frontend.
Mas adelante se crearan los controladores, rutas y vistas.

Antes de modificar archivos, explicame que vas a crear y espera mi confirmacion.



========================================
OBJETIVO DEL SISTEMA
========================================

Crear una base de datos para un sistema pequeño pero escalable de gestión de publicaciones y proyectos.

El administrador podrá:
- subir publicaciones con imágenes
- subir publicaciones con PDFs
- registrar otros archivos
- crear proyectos con imagen, descripción y enlace externo
- clasificar publicaciones y proyectos por categorías
- asociar tecnologías
- activar o desactivar contenido
- contar vistas
- mostrar todo en una galería pública

========================================
TABLAS A CREAR
========================================

Crear estas tablas nuevas:

1. categorias
2. tecnologias
3. publicaciones
4. proyectos
5. publicacion_tecnologia
6. proyecto_tecnologia

========================================
TABLA categorias
========================================

Campos:
- id
- nombre string
- slug string unique
- tipo enum nullable: publicacion, proyecto, ambos
- descripcion text nullable
- estado boolean default true
- timestamps
- softDeletes

Relaciones:
- una categoría tiene muchas publicaciones
- una categoría tiene muchos proyectos

========================================
TABLA tecnologias
========================================

Campos:
- id
- nombre string
- slug string unique
- icono string nullable
- color string nullable
- estado boolean default true
- timestamps
- softDeletes

Relaciones:
- una tecnología puede pertenecer a muchas publicaciones
- una tecnología puede pertenecer a muchos proyectos

========================================
TABLA publicaciones
========================================

Campos:
- id
- user_id foreign key nullable relacionado con users
- categoria_id foreign key nullable relacionado con categorias
- titulo string
- slug string unique
- descripcion text nullable
- tipo enum: imagen, pdf, otro
- archivo string
- imagen_portada string nullable
- estado boolean default true
- vistas unsignedBigInteger default 0
- publicado_en timestamp nullable
- timestamps
- softDeletes

Relaciones:
- una publicación pertenece a un usuario
- una publicación pertenece a una categoría
- una publicación puede tener muchas tecnologías

Si el usuario se elimina, usar nullOnDelete en user_id.
Si la categoría se elimina, usar nullOnDelete en categoria_id.

========================================
TABLA proyectos
========================================

Campos:
- id
- user_id foreign key nullable relacionado con users
- categoria_id foreign key nullable relacionado con categorias
- titulo string
- slug string unique
- descripcion text nullable
- tipo enum: sitio_web, aplicacion, dashboard, tienda_online, otro
- imagen string nullable
- enlace string
- estado boolean default true
- vistas unsignedBigInteger default 0
- publicado_en timestamp nullable
- timestamps
- softDeletes

Relaciones:
- un proyecto pertenece a un usuario
- un proyecto pertenece a una categoría
- un proyecto puede tener muchas tecnologías

Si el usuario se elimina, usar nullOnDelete en user_id.
Si la categoría se elimina, usar nullOnDelete en categoria_id.

========================================
TABLA publicacion_tecnologia
========================================

Campos:
- id
- publicacion_id foreign key relacionado con publicaciones
- tecnologia_id foreign key relacionado con tecnologias
- timestamps

Reglas:
- usar cascadeOnDelete
- evitar duplicados con unique publicacion_id + tecnologia_id

========================================
TABLA proyecto_tecnologia
========================================

Campos:
- id
- proyecto_id foreign key relacionado con proyectos
- tecnologia_id foreign key relacionado con tecnologias
- timestamps

Reglas:
- usar cascadeOnDelete
- evitar duplicados con unique proyecto_id + tecnologia_id

========================================
MODELOS A CREAR O ACTUALIZAR
========================================

Crear modelos:
- Categoria
- Tecnologia
- Publicacion
- Proyecto

Actualizar modelo User para agregar relaciones:
- publicaciones()
- proyectos()

Relaciones esperadas:

User:
- hasMany Publicacion
- hasMany Proyecto

Categoria:
- hasMany Publicacion
- hasMany Proyecto

Tecnologia:
- belongsToMany Publicacion
- belongsToMany Proyecto

Publicacion:
- belongsTo User
- belongsTo Categoria
- belongsToMany Tecnologia

Proyecto:
- belongsTo User
- belongsTo Categoria
- belongsToMany Tecnologia

========================================
REQUISITOS TÉCNICOS
========================================

Usar:
- migraciones Laravel
- modelos Eloquent
- fillable en los modelos
- casts para estado, vistas y publicado_en
- SoftDeletes en modelos que correspondan
- foreignId()->nullable()->constrained()->nullOnDelete()
- cascadeOnDelete en tablas pivote
- nombres correctos en español
- buenas prácticas Laravel

========================================
COMANDOS ARTISAN SUGERIDOS
========================================

Generar comandos necesarios como:

php artisan make:model Categoria -m
php artisan make:model Tecnologia -m
php artisan make:model Publicacion -m
php artisan make:model Proyecto -m

Para las tablas pivote crear migraciones separadas.

========================================
IMPORTANTE FINAL
========================================

No ejecutar php artisan migrate.
No borrar tablas existentes.
No modificar estructura interna de Laravel.
No crear controladores todavía.
No crear vistas Blade todavía.
No crear rutas todavía.
No instalar paquetes adicionales.
No usar React, Vue, Etc.

Primero explícame los archivos que vas a crear o modificar y espera mi confirmación.