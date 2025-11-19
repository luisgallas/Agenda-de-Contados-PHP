# 📱 AgendaPlus - Sistema de Gestión de Contactos

**Alumno:** Pedro Luis Ferreira Gallas  
**Carrera:** Ingeniería en Informática  
**Materia:** Sistemas Distribuidos (SPD)  
**Año:** 2025

## 📋 Descripción
Aplicación web moderna de Agenda de Contactos desarrollada en PHP aplicando el patrón **MVC (Modelo-Vista-Controlador)**. Permite gestionar contactos de manera eficiente con funcionalidades completas de CRUD, búsqueda avanzada, favoritos y tema oscuro/claro.

##  Características Principales
-  **CRUD Completo**: Crear, Leer, Actualizar y Eliminar contactos
-  **Búsqueda en tiempo real**: Buscar por nombre, teléfono o email
-  **Sistema de Favoritos**: Marcar contactos importantes
-  **Selección múltiple**: Eliminar varios contactos a la vez
-  **Vaciar lista completa**: Limpiar toda la agenda
-  **Tema Oscuro/Claro**: Cambio dinámico de tema con persistencia en localStorage
-  **Diseño Responsive**: Adaptado a dispositivos móviles
-  **Validación de datos**: En cliente (JavaScript) y servidor (PHP)
-  **Validación de teléfonos paraguayos**: Formato específico para números de Paraguay
-  **Interfaz moderna**: Diseño atractivo con animaciones y transiciones CSS
-  **Footer dinámico**: Año actualizado automáticamente con JavaScript

##  Tecnologías Utilizadas
- **PHP 7.4+** (sin framework) - Patrón MVC
- **MySQL 5.7+** (Base de datos relacional)
- **PDO** (PHP Data Objects para conexión segura)
- **JavaScript ES6+** (Validaciones, tema dinámico y año dinámico)
- **CSS3** (Diseño moderno con variables CSS y tema oscuro/claro)
- **Font Awesome 6.4** (CDN - Iconografía)
- **Google Fonts** (CDN - Tipografía Poppins)

## 📦 Contenido del Proyecto
```
agendas_contactos/
├── bd.php                          # Configuración y conexión a BD
├── database.sql                    # Script SQL de inicialización
├── README.md                       # Documentación del proyecto
├── controladores/
│   └── ContactosController.php     # Lógica de negocio y control
├── modelos/
│   └── ContactoModel.php           # Acceso a datos y consultas
├── vistas/
│   ├── header.php                  # Encabezado y estilos
│   ├── footer.php                  # Pie de página y scripts
│   ├── inicio/
│   │   └── index.php               # Vista principal y enrutador
│   ├── contactos/
│   │   ├── listar.php              # Lista de contactos
│   │   ├── crear.php               # Formulario de creación
│   │   └── editar.php              # Formulario de edición
│   └── errores/
│       └── 404.php                 # Página de error
└── img/
    └── profile.jpg                 # Imagen de perfil del usuario
```

##  Instalación y Configuración

### Requisitos Previos
- WAMP Server 3.0+ (Windows) o XAMPP
- PHP 7.4 o superior
- MySQL 5.7 o superior
- Navegador web moderno (Chrome, Firefox, Edge)

### Pasos de Instalación

1. **Clonar o descargar el proyecto**
   ```bash
   # Colocar en la carpeta www de WAMP
   C:\wamp64\www\agendas_contactos\
   ```

2. **Importar la base de datos**
   - Abrir HeidiSQL o phpMyAdmin
   - Crear una nueva sesión/conexión
   - Importar el archivo `database.sql`
   - Esto creará automáticamente:
     - Base de datos: `agenda_contactos`
     - Tabla: `contactos`
     - Datos de ejemplo

3. **Configurar credenciales (opcional)**
   - Abrir `bd.php`
   - Ajustar si es necesario:
     ```php
     $host = 'localhost';
     $port = 3306;
     $dbname = 'agenda_contactos';
     $user = 'root';
     $pass = '';
     ```

4. **Iniciar servicios**
   - Iniciar Apache
   - Iniciar MySQL
   - Verificar que estén en verde en WAMP

5. **Acceder a la aplicación**
   ```
   http://localhost/agendas_contactos/vistas/inicio/index.php
   ```

## 📖 Guía de Uso

### Listar Contactos
- Vista principal que muestra todos los contactos
- Los favoritos aparecen primero con ⭐
- Ordenamiento alfabético por nombre

### Buscar Contactos
- Usar la barra de búsqueda superior
- Busca en nombre, teléfono y email simultáneamente
- Resultados en tiempo real

### Crear Contacto
1. Hacer clic en "Nuevo Contacto"
2. Llenar el formulario (nombre es obligatorio)
3. Click en "Guardar Contacto"

### Editar Contacto
1. Click en el botón de editar (lápiz) en la lista
2. Modificar los campos deseados
3. Marcar como favorito si se desea
4. Guardar cambios

### Eliminar Contactos
- **Individual**: Click en el botón de eliminar (basura)
- **Multiple**: Seleccionar checkboxes y click en "Eliminar Seleccionados"
- **Todos**: Click en "Eliminar Todo" (requiere confirmación)

### Marcar Favoritos
- Click en la estrella (☆) para marcar como favorito
- Se vuelve dorada (⭐) cuando está activo
- Los favoritos aparecen al principio de la lista

### Cambiar Tema
- Click en el icono de luna/sol en la esquina superior derecha
- El tema se guarda en localStorage
- Persiste entre sesiones

##  Arquitectura MVC

### Modelo (`ContactoModel.php`)
- Gestiona la lógica de acceso a datos
- Métodos: `obtenerTodos()`, `obtenerPorId()`, `crear()`, `actualizar()`, `eliminar()`, `toggleFavorito()`, `vaciarTabla()`
- Uso de consultas preparadas (PDO) para seguridad

### Vista (carpeta `vistas/`)
- Presenta la información al usuario
- HTML con PHP embebido
- Estilos CSS modernos con variables
- JavaScript para interactividad

### Controlador (`ContactosController.php`)
- Intermediario entre Modelo y Vista
- Maneja peticiones HTTP (GET/POST)
- Validación de datos del servidor
- Redirección y mensajes de éxito/error

##  Seguridad Implementada

-  Uso de **PDO con consultas preparadas** (previene SQL Injection)
-  **Validación de datos** en cliente y servidor
-  **Validación de unicidad**: Emails y teléfonos únicos (sin duplicados)
-  **Escapado de HTML** con `htmlspecialchars()`
-  **Filtrado de emails** con `filter_var()`
-  **Validación de patrones** con expresiones regulares
-  **Restricciones UNIQUE** en base de datos para email y teléfono
-  **Modo de error** configurado para desarrollo

##  Base de Datos

### Tabla: `contactos`
| Campo     | Tipo         | Descripción                    |
|-----------|--------------|--------------------------------|
| id        | INT(11)      | Primary Key, Auto-increment    |
| nombre    | VARCHAR(100) | Nombre del contacto (required) |
| telefono  | VARCHAR(20)  | Número telefónico (formato paraguayo, **UNIQUE**) |
| email     | VARCHAR(100) | Correo electrónico (**UNIQUE**) |
| favorito  | TINYINT(1)   | 0 = Normal, 1 = Favorito      |
| creado_at | TIMESTAMP    | Fecha de creación automática  |

**Restricciones:**
- `email` y `telefono` tienen restricción **UNIQUE** para evitar duplicados
- Índices creados en `email` y `telefono` para mejorar el rendimiento

### 📱 Formato de Teléfonos Paraguayos

El sistema valida números de teléfono con formato paraguayo tanto en el cliente (JavaScript) como en el servidor (PHP).

#### Formatos Aceptados:
- **Con guiones**: `0981-123-456` o `021-123-456`
- **Sin guiones**: `0981123456` o `021123456`
- **Internacional**: `+595981123456` o `+59521123456`

#### Códigos de Área Válidos:

**Teléfonos Móviles** (9 dígitos):
- `096x` - Personal
- `097x` - Tigo
- `098x` - Claro
- `099x` - Otros operadores

**Teléfonos Fijos** (7-8 dígitos por ciudad):
- `021` - Asunción
- `024` - San Pedro
- `025` - Concepción
- `028` - Misiones
- `031` - Cordillera
- `041` - Caaguazú
- `047` - Itapúa
- `048` - Alto Paraná
- Entre otros códigos válidos: `22-48`

#### Validación:
```regex
Patrón: ^(\+595|0)(9[6-9][1-9]|2[1-9]|3[1-9]|4[1-8])\d{6,7}$
```

**Ejemplos válidos:**
- ✅ `0981-234-567`
- ✅ `0981234567`
- ✅ `+595981234567`
- ✅ `021-456-789`
- ✅ `+59521456789`

**Ejemplos inválidos:**
- ❌ `981234567` (falta el 0 o +595)
- ❌ `0901234567` (código 90x no existe en Paraguay)
- ❌ `123456789` (no sigue el formato)
- ❌ `+595 981 234 567` (espacios no permitidos)

##  Características de Diseño

- **Variables CSS**: Fácil personalización de colores
- **Animaciones suaves**: Transiciones y efectos hover
- **Iconos**: Font Awesome para mejor UX
- **Tipografía**: Google Fonts (Poppins)
- **Box Shadow**: Profundidad visual moderna
- **Border Radius**: Esquinas redondeadas
- **Responsive**: Media queries para móviles

##  Solución de Problemas

### Error de conexión a BD
- Verificar que MySQL esté iniciado en WAMP
- Comprobar credenciales en `bd.php`
- Verificar que la BD `agenda_contactos` exista

### Página en blanco
- Activar `display_errors` en `php.ini`
- Verificar logs de Apache: `C:\wamp64\logs\apache_error.log`

### Estilos no cargan
- Verificar ruta en el navegador
- Limpiar caché del navegador (Ctrl + F5)

### Validación de teléfono no funciona
- Asegúrese de usar el formato paraguayo correcto
- El teléfono debe empezar con `0` o `+595`
- Verifique que el código de área sea válido (móvil: 96x-99x, fijo: 21-48)
- Puede usar guiones opcionales: `0981-123-456` o `0981123456`

### Error: "Este email ya está registrado" o "Este número de teléfono ya está registrado"
- Cada contacto debe tener un email único
- Cada contacto debe tener un número de teléfono único
- Al editar, puede mantener el mismo email/teléfono del contacto actual
- Verifique que no exista otro contacto con los mismos datos

##  Mejoras Futuras

-  Sistema de autenticación de usuarios
-  Exportar contactos a CSV/Excel
-  Importar contactos desde archivo
-  Categorías o etiquetas para contactos
-  Historial de cambios
-  Respaldo automático de BD
-  API REST para integración móvil
-  ~~Validación más robusta (números internacionales)~~ ✅ **Implementado: Validación de números paraguayos**
-  Paginación para grandes cantidades de contactos
-  Foto de perfil para cada contacto
-  Soporte para números de otros países
-  Formateo automático de números al escribir

##  Autor

**Pedro Luis Ferreira Gallas**  
Email: [luisgallas.com@gmail.com]  
Ingeniería en Informática - SPD 2025

##  Licencia

Este proyecto fue desarrollado con fines educativos para la materia de Sistemas Distribuidos.

**Fecha de última actualización:** 19 de noviembre de 2025  
**Versión:** 2.0.0

---

## 📋 Cumplimiento de Requisitos del Proyecto

### ✅ Requisitos Técnicos Obligatorios

#### 1. Patrón MVC
- ✅ **Modelos**: `ContactoModel.php` - Acceso a datos y consultas SQL
- ✅ **Controladores**: `ContactosController.php` - Lógica y procesamiento de peticiones
- ✅ **Vistas**: Carpeta `vistas/` con archivos separados por funcionalidad
- ✅ **Enrutamiento**: `index.php` como archivo central de enrutamiento

#### 2. CRUD Completo
- ✅ **Crear**: Formulario de creación de contactos con validación
- ✅ **Listar**: Vista de tabla con todos los contactos y búsqueda
- ✅ **Editar**: Formulario de edición con datos precargados
- ✅ **Eliminar**: Individual, múltiple y total con confirmación

#### 3. Base de Datos MySQL
- ✅ Base de datos: `agenda_contactos`
- ✅ Tabla: `contactos` con campos id, nombre, telefono, email, favorito
- ✅ Conexión mediante PDO con consultas preparadas
- ✅ Script `database.sql` incluido

#### 4. Uso de CDN's
- ✅ **Font Awesome 6.4.0**: Para iconografía
  ```html
  https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css
  ```
- ✅ **Google Fonts - Poppins**: Para tipografía
  ```html
  https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap
  ```

### ✅ Requisitos de Personalización

#### Navbar (Header)
- ✅ **Nombre de marca original**: "📱 Agenda de Contactos" (AgendaPlus)
- ✅ **Foto del alumno**: Imagen de perfil en esquina superior derecha
- ✅ **Nombre del alumno**: "Luis Ferreira" visible junto a la foto
- ✅ **Extra**: Botón de cambio de tema (oscuro/claro)

#### Footer
- ✅ **Carrera**: "Ingeniería en Informática"
- ✅ **Materia**: "SPD"
- ✅ **Año dinámico**: Generado mediante JavaScript con `new Date().getFullYear()`
- ✅ **Formato requerido**: "Ingeniería en Informática – SPD – © 2025"
- ✅ **Extra**: Actualización automática cada minuto

### ✅ Entregables Finales

#### 1. Proyecto completo en .zip
- ✅ Estructura de carpetas completa
- ✅ Todos los archivos PHP, CSS, JavaScript
- ✅ Imágenes y recursos

#### 2. Script SQL (database.sql)
- ✅ Creación de base de datos
- ✅ Creación de tabla contactos
- ✅ Datos de ejemplo incluidos

#### 3. Archivo README.md
- ✅ **Nombre del proyecto**: AgendaPlus
- ✅ **Descripción**: Detallada y completa
- ✅ **Tecnologías utilizadas**: Listadas con versiones
- ✅ **Instrucciones de instalación**: Paso a paso
- ✅ **Guía de uso**: Completa con capturas
- ✅ **Arquitectura MVC**: Explicada
- ✅ **Extra**: Seguridad, solución de problemas, mejoras futuras

---

## 🎯 Funcionalidades Adicionales Implementadas

Además de los requisitos obligatorios, el proyecto incluye:

1. **Sistema de Temas**: Modo oscuro/claro con persistencia
2. **Validación Avanzada**: Teléfonos paraguayos con regex específico
3. **Búsqueda Inteligente**: Filtrado en múltiples campos
4. **Sistema de Favoritos**: Con ordenamiento prioritario
5. **Selección Múltiple**: Para operaciones en lote
6. **Interfaz Moderna**: Con animaciones y transiciones CSS3
7. **Diseño Responsive**: Adaptado a móviles y tablets
8. **Seguridad**: PDO, consultas preparadas, validación servidor/cliente
