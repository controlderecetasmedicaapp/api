use db_app;

set global event_scheduler = on;

drop event if exists eliminar_receta;
create event if not exists eliminar_receta on schedule every 1 day starts date_add(curdate(), interval 1455 minute) ON COMPLETION PRESERVE do
    begin
        drop temporary table if exists tbl_total_receta;
        create temporary table if not exists tbl_total_receta as (select * from tbl_prescripciones);

        drop temporary table if exists tbl_receta_venciada;
        create temporary table if not exists tbl_receta_venciada as (select prescripcion_code
                                                                     from tbl_prescripciones
                                                                     where date_format(date_add(created_at, interval 30 day), '%d-%m-%y') =
                                                                           date_format(curdate(), '%d-%m-%y'));

        delete
        from tbl_prescripciones
        where if((select count(*) from tbl_total_receta group by prescripcion_code having count(*) > 1) = 2,
                 date_format(date_add(created_at, interval duracion_tratamiento day), '%d-%m-%y') =
                 date_format(curdate(), '%d-%m-%y'), prescripcion_code = (select * from tbl_receta_venciada));

        drop temporary table if exists tbl_total_receta;
        drop temporary table if exists tbl_receta_venciada;
    end;

DELIMITER ;


# eliminar evento
# drop event eliminar_receta;

# deshabilitar evento
# ALTER EVENT eliminar_receta DISABLE;

# habilitar evento
# ALTER EVENT eliminar_receta ENABLE;

# detener todos los eventos
# SET GLOBAL event_scheduler = OFF;

# mostrar evento en ejecución
# SHOW events;

