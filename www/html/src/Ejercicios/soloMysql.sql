-- Cantidad de hombres(1) y mujeres(2)
SELECT CASE
           WHEN gender = 1 THEN 'hombres'
           WHEN gender = 2 THEN 'mujeres' END AS Genero,
       COUNT(id)                              AS cantidad
FROM usuarios
GROUP BY gender;

-- Total de acciones compradas
SELECT COUNT(id)
from acciones;

-- Cantidad total pagado por las acciones de la categoría “Cryptos”
SELECT SUM(acciones.cantidad * acciones.valor_compra)
from acciones
         INNER JOIN categorias on acciones.categoria_id = categorias.id
WHERE categorias.nombre = 'Cryptos';

-- Cantidad de usuarios que usan Gmail - Query entrega la cantidad de usuarios por cada dominio de email, no solo gmail
SELECT SUBSTRING(
               email,
               CHARINDEX('@', email) + 1,
               LEN(email) - CHARINDEX('@', email)
           )        as dominios_email,
       COUNT(email) as Cantidad
FROM usuarios
GROUP BY SUBSTRING(
                 email,
                 CHARINDEX('@', email) + 1,
                 LEN(email) - CHARINDEX('@', email)
             );

-- Nemo que tiene la mayor cantidad de usuarios
SELECT COUNT(id) as cantidad, nemo
FROM acciones
GROUP BY nemo
ORDER BY cantidad DESC LIMIT 1;