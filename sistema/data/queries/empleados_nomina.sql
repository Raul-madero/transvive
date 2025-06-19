-- Plantilla SQL optimizada para consultar empleados en cálculo de nómina semanal
-- Reemplazar dinámicamente las variables {fecha_inicio}, {fecha_fin}, {fecha_limite_alertas} en el backend

SELECT
    e.id,
    e.noempleado,
    e.sueldo_base,
    CONCAT_WS(' ', e.nombres, e.apellido_paterno, e.apellido_materno) AS operador,
    e.cargo,
    IF(e.imss = 'ASEGURADO', 1, 0) AS imss,
    e.estatus,
    e.bono_categoria,
    e.bono_supervisor,
    e.bono_semanal,
    e.fecha_contrato,
    e.caja_ahorro,
    e.supervisor,
    e.apoyo_mes,
    e.salario_diario,
    e.fecha_reingreso,
    (
        SELECT COALESCE(SUM(valor), 0)
        FROM incidencias 
        WHERE empleado = CONCAT_WS(' ', e.nombres, e.apellido_paterno, e.apellido_materno)
        AND (
            (fecha_inicial BETWEEN '{fecha_inicio}' AND '{fecha_fin}') 
            OR (fecha_final BETWEEN '{fecha_inicio}' AND '{fecha_fin}')
        )
    ) AS faltas,
    -- COUNT(DISTINCT CASE WHEN inc.tipo_incidencia = 'Falta Injustificada' THEN inc.id END) AS faltas,

    (
        SELECT COALESCE(SUM(
            CASE
                WHEN tipo_incidencia = 'Vacaciones' 
                    AND fecha_inicial <= '{fecha_fin}' 
                    AND fecha_final >= '{fecha_inicio}' THEN
                    1 + DATEDIFF(LEAST(fecha_final, '{fecha_fin}'), GREATEST(fecha_inicial, '{fecha_inicio}'))
                ELSE 0
            END
        ), 0)
        FROM incidencias
        WHERE empleado = CONCAT_WS(' ', e.nombres, e.apellido_paterno, e.apellido_materno)
    ) AS dias_vacaciones_pagar,

    IF (
        STR_TO_DATE(CONCAT(
            YEAR(CURDATE()), '-', 
            MONTH(CASE 
                    WHEN e.fecha_reingreso IS NOT NULL AND e.fecha_reingreso > '1900-01-01' 
                    THEN e.fecha_reingreso 
                    ELSE e.fecha_contrato 
                END), 
            '-', 
            DAY(CASE 
                    WHEN e.fecha_reingreso IS NOT NULL AND e.fecha_reingreso > '1900-01-01' 
                    THEN e.fecha_reingreso 
                    ELSE e.fecha_contrato 
                END)
        ), '%Y-%m-%d') 
        BETWEEN '{fecha_inicio}' AND '{fecha_fin}', 
        'SI', 
        'NO'
    ) AS prima_vacacional,

    COALESCE(SUM(rv.valor_vuelta), 0) AS total_vueltas,

    COALESCE(
        SUM(
            CASE 
                WHEN LOWER(rv.tipo_viaje) LIKE '%especial%' THEN rv.sueldo_vuelta * rv.valor_vuelta

                WHEN LOWER(rv.tipo_viaje) LIKE '%semidomiciliadas%' THEN
                CASE 
                    WHEN LOWER(rv.unidad_ejecuta) REGEXP 'sprinter' 
                        AND IFNULL(r.sueldo_sprinter, 0) > 0 
                    THEN GREATEST(r.sueldo_sprinter, e.sueldo_sprinter) * rv.valor_vuelta
                    WHEN IFNULL(r.sueldo_semid, 0) > 0 
                    THEN r.sueldo_semid * rv.valor_vuelta
                    ELSE e.sueldo_base * rv.valor_vuelta
                END

                ELSE
                    CASE
                        WHEN LOWER(rv.unidad_ejecuta) REGEXP '\\bcamion\\b' AND IFNULL(r.sueldo_camion, 0) > 0 THEN GREATEST(r.sueldo_camion, e.sueldo_camion) * rv.valor_vuelta
                        WHEN LOWER(rv.unidad_ejecuta) REGEXP '\\bcamioneta\\b' AND IFNULL(r.sueldo_camioneta, 0) > 0 THEN GREATEST(r.sueldo_camioneta, e.sueldo_camioneta) * rv.valor_vuelta
                        WHEN LOWER(rv.unidad_ejecuta) REGEXP '\\bsprinter\\b' AND IFNULL(r.sueldo_sprinter, 0) > 0 THEN GREATEST(r.sueldo_sprinter, e.sueldo_sprinter) * rv.valor_vuelta
                        WHEN LOWER(rv.unidad_ejecuta) REGEXP '\\bcamion\\b' THEN e.sueldo_camion * rv.valor_vuelta
                        WHEN LOWER(rv.unidad_ejecuta) LIKE '%camioneta%' THEN e.sueldo_camioneta * rv.valor_vuelta
                        WHEN LOWER(rv.unidad_ejecuta) LIKE '%sprinter%' THEN e.sueldo_sprinter * rv.valor_vuelta
                        ELSE e.sueldo_base * rv.valor_vuelta
                    END
            END
        )
    ) AS sueldo_bruto,

    COALESCE(
        SUM(
            CASE 
                WHEN LOWER(rv.tipo_viaje) LIKE '%especial%' THEN rv.sueldo_vuelta * rv.valor_vuelta

                WHEN LOWER(rv.tipo_viaje) LIKE '%semidomiciliadas%' 
                    AND LOWER(rv.unidad_ejecuta) REGEXP 'sprinter'
                    AND IFNULL(r.sueldo_sprinter, 0) > 0
                THEN GREATEST(r.sueldo_sprinter, e.sueldo_sprinter) * rv.valor_vuelta

                WHEN LOWER(rv.tipo_viaje) LIKE '%semidomiciliadas%' 
                    AND IFNULL(r.sueldo_semid, 0) > 0 
                THEN r.sueldo_semid * rv.valor_vuelta

                ELSE
                    CASE
                        WHEN LOWER(rv.unidad_ejecuta) REGEXP '\\bcamion\\b' AND IFNULL(r.sueldo_camion, 0) > 0 THEN GREATEST(r.sueldo_camion, e.sueldo_camion) * rv.valor_vuelta
                        WHEN LOWER(rv.unidad_ejecuta) REGEXP '\\bcamioneta\\b' AND IFNULL(r.sueldo_camioneta, 0) > 0 THEN GREATEST(r.sueldo_camioneta, e.sueldo_camioneta) * rv.valor_vuelta
                        WHEN LOWER(rv.unidad_ejecuta) REGEXP '\\bsprinter\\b' AND IFNULL(r.sueldo_sprinter, 0) > 0 THEN GREATEST(r.sueldo_sprinter, e.sueldo_sprinter) * rv.valor_vuelta
                        WHEN LOWER(rv.unidad_ejecuta) REGEXP '\\bcamion\\b' THEN e.sueldo_camion * rv.valor_vuelta
                        WHEN LOWER(rv.unidad_ejecuta) LIKE '%camioneta%' THEN e.sueldo_camioneta * rv.valor_vuelta
                        WHEN LOWER(rv.unidad_ejecuta) LIKE '%sprinter%' THEN e.sueldo_sprinter * rv.valor_vuelta
                        ELSE e.sueldo_base * rv.valor_vuelta
                    END
            END
        )
    ) AS sueldo_vueltas,

    (SELECT a.descuento FROM adeudos a WHERE a.noempleado = e.noempleado) AS descuento,
    (SELECT a.cantidad FROM adeudos a WHERE a.noempleado = e.noempleado) AS cantidad,
    (SELECT a.total_abonado FROM adeudos a WHERE a.noempleado = e.noempleado) AS total_abonado,
    (
        SELECT SUM(al.noalertas) AS noalertas 
        FROM alertas al
        WHERE operador = CONCAT_WS(' ', e.nombres, e.apellido_paterno, e.apellido_materno) 
        AND DATE(al.fecha) BETWEEN '{fecha_fin}' AND '{fecha_limite_alertas}'
    ) AS noalertas,

    fi.pago_fiscal,
    fi.deduccion_fiscal,
    fi.neto

FROM empleados e
-- LEFT JOIN alertas al 
--     ON al.operador = CONCAT_WS(' ', e.nombres, e.apellido_paterno, e.apellido_materno) COLLATE utf8mb4_general_ci
--     AND DATE(al.fecha) BETWEEN '{fecha_fin}' AND '{fecha_limite_alertas}'

-- LEFT JOIN incidencias inc 
--     ON inc.empleado = CONCAT_WS(' ', e.nombres, e.apellido_paterno, e.apellido_materno)
--     AND (
--         (inc.fecha_inicial BETWEEN '{fecha_inicio}' AND '{fecha_fin}') 
--         OR (inc.fecha_final BETWEEN '{fecha_inicio}' AND '{fecha_fin}')
--     )

LEFT JOIN registro_viajes rv 
    ON rv.operador = CONCAT_WS(' ', e.nombres, e.apellido_paterno, e.apellido_materno)
    AND DATE(rv.fecha) BETWEEN '{fecha_inicio}' AND '{fecha_fin}'
    AND rv.valor_vuelta > 0

LEFT JOIN rutas r 
    ON rv.cliente = r.cliente AND rv.ruta = r.ruta

LEFT JOIN importes_fiscales fi 
    ON fi.empleado = CONCAT_WS(' ', e.apellido_paterno, e.apellido_materno, e.nombres)

WHERE 
    (e.estatus = 1 OR DATEDIFF(e.fecha_baja, '{fecha_inicio}') >= 6)
    AND e.tipo_nomina = 'Semanal'

GROUP BY 
    e.noempleado, e.id, operador, e.sueldo_base, e.cargo, imss, e.estatus, 
    e.bono_categoria, e.bono_supervisor, e.bono_semanal, e.caja_ahorro, 
    e.supervisor, e.apoyo_mes, fi.pago_fiscal, fi.deduccion_fiscal, fi.neto;
