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
    al.noalertas,

    -- Faltas injustificadas
    (
        SELECT COUNT(*) FROM incidencias i 
        WHERE i.empleado = CONCAT_WS(' ', e.nombres, e.apellido_paterno, e.apellido_materno)
        AND i.tipo_incidencia = 'Falta Injustificada'
        AND (
            i.fecha_inicial BETWEEN '{fecha_inicio}' AND '{fecha_fin}' OR
            i.fecha_final BETWEEN '{fecha_inicio}' AND '{fecha_fin}'
        )
    ) AS faltas,

    -- Días de vacaciones a pagar
    (
        SELECT 
            SUM(
                1 + DATEDIFF(
                    LEAST(i.fecha_final, '{fecha_fin}'), 
                    GREATEST(i.fecha_inicial, '{fecha_inicio}')
                )
            )
        FROM incidencias i 
        WHERE i.empleado = CONCAT_WS(' ', e.nombres, e.apellido_paterno, e.apellido_materno)
        AND i.tipo_incidencia = 'Vacaciones'
        AND i.fecha_final >= '{fecha_inicio}' AND i.fecha_inicial <= '{fecha_fin}'
    ) AS dias_vacaciones_pagar,

    -- Prima vacacional
    IF (
        STR_TO_DATE(CONCAT(YEAR(CURDATE()), '-', MONTH(e.fecha_contrato), '-', DAY(e.fecha_contrato)), '%Y-%m-%d')
        BETWEEN '{fecha_inicio}' AND '{fecha_fin}',
        'SI',
        'NO'
    ) AS prima_vacacional,

    viajes.total_vueltas,
    IFNULL(viajes.sueldo_bruto_ruta + viajes.sueldo_bruto_empleado, 0) AS sueldo_bruto,

    -- Adeudos
    (SELECT a.descuento FROM adeudos a WHERE a.noempleado = e.noempleado) AS descuento,
    (SELECT a.cantidad FROM adeudos a WHERE a.noempleado = e.noempleado) AS cantidad,
    (SELECT a.total_abonado FROM adeudos a WHERE a.noempleado = e.noempleado) AS total_abonado,

    -- Fiscales
    fi.pago_fiscal,
    fi.deduccion_fiscal,
    fi.neto

FROM empleados e

-- Sueldos y vueltas semanales calculados por operador
LEFT JOIN (
    SELECT
        rv.operador,
        SUM(rv.valor_vuelta) AS total_vueltas,
        SUM(
            CASE 
                WHEN LOWER(rv.tipo_viaje) LIKE '%especial%' THEN rv.sueldo_vuelta * rv.valor_vuelta
                ELSE
                    CASE
                        WHEN LOWER(rv.unidad_ejecuta) LIKE '%camion%' AND IFNULL(r.sueldo_camion, 0) > 0 THEN r.sueldo_camion * rv.valor_vuelta
                        WHEN LOWER(rv.unidad_ejecuta) LIKE '%camioneta%' AND IFNULL(r.sueldo_camioneta, 0) > 0 THEN r.sueldo_camioneta * rv.valor_vuelta
                        ELSE 0
                    END
            END
        ) AS sueldo_bruto_ruta,
        SUM(
            CASE
                WHEN LOWER(rv.tipo_viaje) NOT LIKE '%especial%' THEN
                    CASE
                        WHEN LOWER(rv.unidad_ejecuta) REGEXP '\\bcamion\\b' THEN e2.sueldo_camion * rv.valor_vuelta
                        WHEN LOWER(rv.unidad_ejecuta) LIKE '%camioneta%' THEN e2.sueldo_camioneta * rv.valor_vuelta
                        WHEN LOWER(rv.unidad_ejecuta) LIKE '%sprinter%' THEN e2.sueldo_sprinter * rv.valor_vuelta
                        ELSE e2.sueldo_base * rv.valor_vuelta
                    END
                ELSE 0
            END
        ) AS sueldo_bruto_empleado
    FROM registro_viajes rv
    LEFT JOIN rutas r ON rv.cliente = r.cliente AND rv.ruta = r.ruta
    LEFT JOIN empleados e2 ON rv.operador = CONCAT_WS(' ', e2.nombres, e2.apellido_paterno, e2.apellido_materno)
    WHERE DATE(rv.fecha) BETWEEN '{fecha_inicio}' AND '{fecha_fin}'
      AND rv.valor_vuelta > 0
    GROUP BY rv.operador
) viajes ON viajes.operador = CONCAT_WS(' ', e.nombres, e.apellido_paterno, e.apellido_materno)

-- Alertas
LEFT JOIN alertas al 
    ON al.operador = CONCAT_WS(' ', e.nombres, e.apellido_paterno, e.apellido_materno) COLLATE utf8mb4_general_ci
    AND DATE(al.fecha) BETWEEN '{fecha_fin}' AND '{fecha_limite_alertas}'

-- Fiscales
LEFT JOIN importes_fiscales fi 
    ON fi.empleado = CONCAT_WS(' ', e.apellido_paterno, e.apellido_materno, e.nombres)

WHERE 
    (e.estatus = 1 OR DATEDIFF(e.fecha_baja, '{fecha_inicio}') >= 6)
    AND e.tipo_nomina = 'Semanal';
