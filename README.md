# Proyecto mesa de ayuda

Este proyecto se desarrolló como una tesis de grado, enfocado en la creación de una mesa de ayuda para una universidad. Dicha mesa de ayuda tiene como principal función gestionar solicitudes relacionadas con requerimientos o incidencias de índole tecnológico dentro de la organización. Esta mesa de ayuda, a diferencia de muchas disponibles en la web, es administrada por el departamento de tecnología de la misma organización. Ofrece a los usuarios un rol específico para realizar sus solicitudes y proporciona un espacio organizado donde pueden consultar sus solicitudes, los comentarios o seguimientos realizados, el estado, la fecha del caso, y un historial de soporte. El objetivo es superar el uso convencional del correo electrónico y establecer un sitio dedicado para atender estas incidencias.

Este proyecto es dinámico y opera mediante una base de datos que almacena la información de los usuarios, casos y sus respectivos seguimientos.

## Tecnologías y Herramientas Utilizadas

- PHP v8
- HTML
- CSS
- Bootstrap v5
- Javascript
- Base de datos MySQL

## Características y Funcionalidades

### Roles de Usuario

Se definen tres roles de usuario, cada uno con responsabilidades y privilegios específicos:

- **Administrador**: Responsable de la gestión integral de los casos recibidos. Posee acceso total a todas las funcionalidades del sistema. Las acciones permitidas para este rol se detallan en el caso de uso correspondiente.
 
 <p align="center">
 <img src="/img_readme/casos de uso super administrador.png" width="500">
</p>

- **Administrativo TIC**: Su principal función es atender los casos que el Administrador le asigna. Las acciones específicas de este rol se describen en el caso de uso pertinente.
  
<p align="center">
 <img src="/img_readme/casos de uso administrativo.png" width="500">
</p>

- **Usuario Administrativo**: Estos usuarios son los que generan las solicitudes y crean los casos.

 <p align="center">
 <img src="/img_readme/casos de uso Usuario tic.png" width="500">
</p>

### Inicio de Sesión

Esta sección facilita el acceso al sistema según el rol del usuario, incluye opciones para el registro de usuarios administrativos y para el restablecimiento de contraseña, el cual se efectúa mediante un token enviado por correo electrónico.

### Sistema de Restablecimiento de Contraseña

El proceso de restablecimiento de contraseña utiliza un token enviado al correo electrónico del usuario para garantizar la seguridad.

### Sección de Inicio

- **Crear Caso**: Permite la creación de casos a través de un formulario, donde se especifica el asunto, mensaje y se adjuntan documentos si es necesario.
- **Mis Casos Generados**: Exhibe el estado actual de los casos que el usuario ha creado.
- **Mis Casos en Proceso**: Muestra los casos que el usuario está gestionando.

### Sección de Usuarios

- **Agregar Nuevo Usuario**: Habilita la incorporación de nuevos usuarios al sistema, asignándoles el rol correspondiente.
- **Editar Usuario**: Permite modificar la información de los usuarios existentes.

### Sección de Asignaciones

- **Casos Nuevos**: Presenta los casos recientemente creados.
- **Casos en Curso**: Exhibe los casos actualmente abiertos.

### Historial

- **Historial General**: Muestra todos los casos que han sido cerrados.
- **Historial Personal (Casos Solicitados)**: Detalla los casos que un usuario ha solicitado.
- **Historial Personal (Casos Atendidos)**: Exhibe los casos que un usuario ha gestionado.

## Proceso de Gestión de Casos en la Mesa de Ayuda

 <p align="center">
 <img src="/img_readme/diagram.png" width="500">
</p>

## Base de datos

### Diagrama entidad relación

 <p align="center">
 <img src="/img_readme/diagrama entidad relacion ma.png" width="500">
</p>

# Esquema de Base de Datos `BASEUNO`

## Tablas y Descripciones

### `USUARIOS_REG`
Almacena el registro de todos los usuarios de la plataforma web, incluyendo detalles como nombres, apellidos, rol, token (para restablecimiento de contraseñas), correo electrónico, ubicación, dependencia, cargo, y contraseña (almacenada de forma encriptada).

### `CASOS`
Registra todos los casos generados por los usuarios, incluyendo ID, el ID de la persona que lo solicita, título, descripción, y fechas de creación y finalización.

### `ROL`
Define los roles dentro de la plataforma, que son: Administrador, Funcionario TIC, y Funcionario.

### `SEGUIMIENTO`
Contiene todos los seguimientos realizados en cada caso, incluyendo detalles del seguimiento, fechas, y el ID de imagen para gestionar las imágenes asociadas.

### `IMAGEN_ADJ`
Registra los nombres de las imágenes adjuntas a los casos, utilizando nombres aleatorios para evitar conflictos de nombres.

### `ENCUESTA`
Almacena las encuestas realizadas por los usuarios en relación a los casos.

### `CASOS_TEC`
Lleva un registro de los técnicos encargados de atender cada caso asignado, facilitando el seguimiento y gestión de recursos humanos.

## Relaciones entre Tablas

- **`USUARIOS_REG` y `ROL`**: Relacionadas mediante la columna `COD_ROL_USUARIO` en `USUARIOS_REG`, que hace referencia a `COD_ROL` en `ROL`.
- **`CASOS` y `USUARIOS_REG`**: `COD_USUARIO_SOLICITA` en `CASOS` se relaciona con `COD_USUARIO` en `USUARIOS_REG`.
- **`CASOS_TEC`, `CASOS` y `USUARIOS_REG`**: `COD_CASO_ATEN` en `CASOS_TEC` se relaciona con `COD_CASO` en `CASOS`, y `COD_USUARIO_TECNICO` en `CASOS_TEC` con `COD_USUARIO` en `USUARIOS_REG`.
- **`ENCUESTA` y `CASOS`**: `COD_CASO_ENCUESTA` en `ENCUESTA` se relaciona con `COD_CASO` en `CASOS`.
- **`SEGUIMIENTO`, `CASOS` y `USUARIOS_REG`**: `COD_CASO_SEGUI` en `SEGUIMIENTO` se relaciona con `COD_CASO` en `CASOS`, y `COD_USUARIO_SEGUI` en `SEGUIMIENTO` con `COD_USUARIO` en `USUARIOS_REG`.
- **`SEGUIMIENTO` e `IMAGEN_ADJ`**: `COD_IMAGEN` en `SEGUIMIENTO` se relaciona con `COD_IMAGEN` en `IMAGEN_ADJ`.
- **`IMAGEN_ADJ` y `CASOS`**: `COD_CASO_IMA` en `IMAGEN_ADJ` se relaciona con `COD_CASO` en `CASOS`.

## Estructura de la Base de Datos

//imagen de la estructura.