# API Control de Gastos

## Objetivos Generales:

Esta aplicación tiene como objetivo mostrar el funcionamiento completo de una api.

## Objetivos Específicos

- Construcción de un backend completo
- Integrar Bases de Datos
- Implementar transacciones a través de HTTP
- Manejar rutas a través de un router
- Utilizar librerías de terceros

## Tecnologías a utilizar

- PHP como lenguaje de programación de servidor
- MySQL como lenguaje de bases de datos
- Librerías de terceros [phprouter](https://github.com/miladrahimi/phprouter)

# interfaz

## Rutas de categorías

| Verbo HTTP | endpoint    | Obs |
| ---------- | ----------- | --- |
| GET        | /categorias |     |

## Rutas de Gastos

| Verbo HTTP | endpoint              | Obs                                 |
| ---------- | --------------------- | ----------------------------------- |
| GET        | /gastos               |                                     |
| GET        | /gastos/{categoria}   | /gastos/1                           |
| GET        | /gastos/fecha/{fecha} | /gastos/fecha/2025-10-01_2025-10-10 |
| POST       | /gastos               | Enviar un JSON en el Body           |
| PUT        | /gastos/{id}          | /gastos/1 & un JSON en el Body      |
| DELETE     | /gastos/{id}          | /gastos/1                           |
