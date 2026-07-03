# Examen Práctico Unidad II - Aplicaciones Web

Este repositorio contiene la resolución de la parte práctica del examen de la Unidad II de la asignatura Aplicaciones Web.

## 1. Datos del estudiante
- **Apellidos:** CRUZ PEREZ
- **Nombres:** JUSTYN KEITH
- **Cédula:** 1207910165
- **Paralelo:** A
- **Fecha del examen:** 03 de Julio de 2026

## 2. Pila tecnológica
- **Lenguaje:** PHP 8.3
- **Base de Datos:** PostgreSQL 15
- **Infraestructura:** Docker y Docker Compose

## 3. Requisitos previos
- Docker Desktop 4.x (o equivalente local) instalado y en ejecución.
- Git.

## 4. Instrucciones de arranque en un solo comando
Para levantar la aplicación, la base de datos, aplicar migraciones e insertar los datos iniciales, ejecuta desde la raíz del proyecto:
```bash
docker compose up -d --build
```

## 5. Credenciales del usuario semilla
Se advierte que estas credenciales se usan solo para la evaluación en este entorno controlado.
- **Usuario:** `admin`
- **Contraseña:** `Admin*2026`

## 6. URL local del sistema
Una vez levantado el entorno con Docker, el sistema estará disponible en:
[http://localhost:8080/login](http://localhost:8080/login)

## 7. Cómo probar el CRUD
Puede probar la aplicación ingresando con las credenciales dadas en la URL proporcionada. El sistema permite:
1. Listar materias.
2. Crear nuevas materias (con validación de rangos 1-6 para créditos y 1-10 para semestre).
3. Editar materias existentes.
4. Eliminar materias (eliminación lógica).

## 8. Cómo verificar las defensas de seguridad activadas
Puede verificar las cabeceras de seguridad HTTP mediante comandos como `curl`:
```bash
curl -I http://localhost:8080/login
```
Se espera observar las cabeceras `Strict-Transport-Security`, `X-Frame-Options`, `X-Content-Type-Options` y `Content-Security-Policy`.
