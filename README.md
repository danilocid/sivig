# Acerca del proyecto

SIVIG es un sistema de gestion de inventario, ventas y gastos para una pequeña empresa

# Que hace hasta hoy

## Administracion

-   crear y modificar usuarios
-   crear y modificar medios de pago

## Clientes

-   crear y modificar clientes

## Proveedores

-   crear y modificar proveedores

## Aticulos

-   crear y editar articulos
-   agregar recepciones de articulos
-   agregar ajustes de articulos

# Que esta en desarrollo:

-   modulo de ajustes de inventario

# Que hara en un futuro (fallas y/o funciones futuras):

- modulo de reportes

### Ventas

-   falta generacion de PDF tipo boleta


### Articulos

-   falta agregar margen de ganancias
-   falta alerta de stock critico
-   validar documento de recepcion (tipo y numero)
-   falta ID de articulo en publicaiones en mercado libre y prestashop

### Clientes

-   falta boton de exportacion a PDF
-   falta ver detalle de ventas de clientes

### Proveedores

-   falta boton de exportacion a PDF
-   falta ver detalle de compras de proveedores

### Gastos

-   falta logica completa
-   falta agregar cuentas bancarias

### Reportes

-   falta logica completa
-   falta reporte de impuestos mensuales
-   falta reporte resumen mensual

### administracion

-   falta agregar comisiones por tipo de medio de pago

### General

-   al recibir un pago con tarjeta, se debe validar la transferencia desde SUMUP
-   generar codigos de barra para los productos https://barcode.tec-it.com/es/
-   en pantalla de inicio faltan widget con datos resumen (ventas, saldo en cuentas bancarias, etc)
-   Falta integracion con API MercadoLibre
-   Falta integracion con API Prestashop
-   Falta integracion con API SimpleApi https://www.simpleapi.cl/

# Comandos utiles

-   `php artisan version:patch` : incrementa la version de la aplicacion, puede ser major, minor o patch (major.minor.patch)
-   `php artisan migrate --seed` : ejecuta las migraciones y los seeders
-   `php artisan make:model Todo -mcrs` : crea un modelo con el nombre Todo junto al controlador y el archivo de migracion y el seeder
