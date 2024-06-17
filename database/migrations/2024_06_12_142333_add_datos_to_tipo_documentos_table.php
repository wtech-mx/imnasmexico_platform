<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tipo_documentos', function (Blueprint $table) {

            $table->text('qr_global')->nullable();

            $table->text('logo_imnas_stps')->nullable();
            $table->text('logo_otra_institucion_stps')->nullable();
            $table->text('nombre_instuto_stps')->nullable();
            $table->text('leyenda_stps')->nullable();
            $table->text('sello_secretaria_stps')->nullable();
            $table->text('imagen_rc_imnas_stps')->nullable();
            $table->text('firma_lic_stps')->nullable();
            $table->text('leyenda_footer_uno_stps')->nullable();
            $table->text('leyenda_footer_dos_stps')->nullable();
            $table->text('leyenda_footer_tres_stps')->nullable();
            $table->text('fondo_stps')->nullable();

            $table->text('logo_cp')->nullable();
            $table->text('logo_otra_institucion_cp')->nullable();
            $table->text('leyenda1_cp')->nullable();
            $table->text('fecha_expedicion_cp')->nullable();
            $table->text('leyenda2_cp')->nullable();
            $table->text('firma1_cp')->nullable();
            $table->text('firma2_cp')->nullable();
            $table->text('img_izq_cp')->nullable();
            $table->text('img_der_cp')->nullable();
            $table->text('tipo_vigencia_cp')->nullable();
            $table->text('tipo_vigencia_abrev_cp')->nullable();
            $table->text('aviso_privacidad_cp')->nullable();
            $table->text('leyenda_auth_qr_cp')->nullable();
            $table->text('qr_cp')->nullable();
            $table->text('fondo_cp')->nullable();

            $table->text('logo_registro_dip')->nullable();
            $table->text('logo_otra_institucion_dip')->nullable();
            $table->text('logo_imnas_dip')->nullable();
            $table->text('titulo_dip')->nullable();
            $table->text('subtitulo_dip')->nullable();
            $table->text('leyenda1_dip')->nullable();
            $table->text('otorga_dip')->nullable();
            $table->text('nombramiento_dip')->nullable();
            $table->text('leyenda2_dip')->nullable();
            $table->text('horas_dip')->nullable();
            $table->text('tipo_vigencia_dip')->nullable();
            $table->text('tipo_vigencia_abrev_dip')->nullable();
            $table->text('firma1_dip')->nullable();
            $table->text('firma2_dip')->nullable();
            $table->text('leyenda_footer1_dip')->nullable();
            $table->text('titulo_hoja2_dip')->nullable();
            $table->text('subtitulo_hoja2_dip')->nullable();
            $table->text('aviso_priv_hoja2_dip')->nullable();
            $table->text('leyenda3_hoja2_dip')->nullable();
            $table->text('sello_constancia_hoja2_dip')->nullable();
            $table->text('sello_reristro_hoja2_dip')->nullable();
            $table->text('tira_imagenes_hoja2_dip')->nullable();
            $table->text('leyenda_footer_uno_dip')->nullable();
            $table->text('leyenda_footer_dos_dip')->nullable();
            $table->text('fondo_dip')->nullable();

            $table->text('logo_registro_credencial')->nullable();
            $table->text('logo_otra_institucion_credencial')->nullable();
            $table->text('titulo1_credencial')->nullable();
            $table->text('folio_credencial')->nullable();
            $table->text('vigencia_credencial')->nullable();
            $table->text('tipo_credencial')->nullable();
            $table->text('nacionalidad_credencial')->nullable();
            $table->text('qr_credencial')->nullable();
            $table->text('leyenda_qr_credencial')->nullable();
            $table->text('leyenda1_hoja_credencial')->nullable();
            $table->text('leyenda2_hoja_credencial')->nullable();
            $table->text('leyenda3_hoja_credencial')->nullable();
            $table->text('leyenda4_hoja_credencial')->nullable();
            $table->text('firma_credencial')->nullable();
            $table->text('fonda_credencial')->nullable();

            $table->text('logo_registro_titulo')->nullable();
            $table->text('logo_otra_institucion_titulo')->nullable();
            $table->text('titulo_titulo')->nullable();
            $table->text('subtitulo_titulo')->nullable();
            $table->text('subsubtitulo_titulo')->nullable();
            $table->text('leyenda1_titulo')->nullable();
            $table->text('firma1_titulo')->nullable();
            $table->text('firma2_titulo')->nullable();
            $table->text('firma3_titulo')->nullable();
            $table->text('qr_credencial_titulo')->nullable();
            $table->text('leyenda_qr_titulo')->nullable();
            $table->text('sello_realimg_')->nullable();
            $table->text('tira_imagenes_hoja2_titulo')->nullable();
            $table->text('tipo_vigencia_abrev_titulo')->nullable();
            $table->text('leyenda1_hoja2_titulo')->nullable();
            $table->text('leyenda2_hoja2_titulo')->nullable();
            $table->text('leyenda3_hoja2_titulo')->nullable();
            $table->text('leyenda4_hoja2_titulo')->nullable();
            $table->text('leyenda5_hoja2_titulo')->nullable();
            $table->text('leyenda6_hoja2_titulo')->nullable();
            $table->text('firma1_hoja2_titulo')->nullable();

            $table->text('logo_tm')->nullable();
            $table->text('logo_otra_institucion_tm')->nullable();
            $table->text('titulo1_tm')->nullable();
            $table->text('leyenda1_tm')->nullable();
            $table->text('leyenda2_tm')->nullable();
            $table->text('leyenda3_tm')->nullable();
            $table->text('leyenda4_tm')->nullable();
            $table->text('leyenda5_tm')->nullable();
            $table->text('optativos_tm')->nullable();
            $table->text('totales_tm')->nullable();
            $table->text('materias_aprov_tm')->nullable();
            $table->text('promedio_tm')->nullable();
            $table->text('fecha_expedicion_tm')->nullable();
            $table->text('tira_materias_aparatologia_tm')->nullable();
            $table->text('tira_materias_alasiados_tm')->nullable();
            $table->text('tira_materias_cosmetologia_tm')->nullable();
            $table->text('tira_materias_cosmeatria_tm')->nullable();
            $table->text('tira_materias_auxiliar_tm')->nullable();
            $table->text('tira_materias_masoterapia_tm')->nullable();
            $table->text('tira_materias_cosmetologia_fc_tm')->nullable();

            $table->text('leyenda_footer_hoja1_tm')->nullable();
            $table->text('leyenda1_hoja2_tm')->nullable();
            $table->text('leyenda2_hoja2_tm')->nullable();
            $table->text('leyenda3_hoja2_tm')->nullable();
            $table->text('leyenda4_hoja2_tm')->nullable();
            $table->text('leyenda5_hoja2_tm')->nullable();
            $table->text('leyenda6_hoja2_tm')->nullable();
            $table->text('qr_credencial_tm')->nullable();
            $table->text('leyenda_qr_credencial_tm')->nullable();
            $table->text('tipo_vigencia_abrev_tm')->nullable();
            $table->text('firma1_hoja2_tm')->nullable();
            $table->text('firma2_hoja2_tm')->nullable();
            $table->text('firma3_hoja2_tm')->nullable();
            $table->text('img_izq_tm')->nullable();
            $table->text('img_der_tm')->nullable();
            $table->text('leyenda_footer_hoja2_tm')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tipo_documentos', function (Blueprint $table) {
            //
        });
    }
};
