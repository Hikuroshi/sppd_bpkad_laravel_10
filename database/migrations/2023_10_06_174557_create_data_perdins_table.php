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
        Schema::create('data_perdins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug')->unique();
            $table->string('surat_dari')->nullable();
            $table->string('nomor_surat')->nullable();
            $table->date('tgl_surat')->nullable();
            $table->text('perihal')->nullable();
            $table->string('no_spt')->nullable();
            $table->unsignedBigInteger('tanda_tangan_id')->nullable();
            $table->unsignedBigInteger('pptk_id')->nullable();
            $table->unsignedBigInteger('pa_kpa_id')->nullable();
            $table->text('maksud');
            $table->unsignedBigInteger('lama_id')->nullable();
            $table->date('tgl_berangkat');
            $table->date('tgl_kembali');
            $table->unsignedBigInteger('alat_angkut_id')->nullable();
            $table->string('kedudukan')->default('Kota Serang');
            $table->unsignedBigInteger('jenis_perdin_id')->nullable();
            $table->unsignedBigInteger('tujuan_id')->nullable();
            $table->unsignedBigInteger('tujuan_lain_id')->nullable();
            $table->unsignedBigInteger('kabupaten_id')->nullable();
            $table->unsignedBigInteger('kabupaten_lain_id')->nullable();
            $table->text('lokasi');
            $table->unsignedBigInteger('pegawai_diperintah_id')->nullable();
            $table->string('jumlah_pegawai');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->unsignedBigInteger('laporan_perdin_id')->nullable();
            $table->unsignedBigInteger('kwitansi_perdin_id')->nullable();
            $table->unsignedBigInteger('author_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_perdins', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
