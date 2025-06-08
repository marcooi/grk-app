<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PemakaianListrik extends Model
{
    use HasFactory, HasUuids, SoftDeletes;
    
    protected $fillable = [
        'whse',
        'workdate',
        'nama_gedung',
        'skema_pembayaran',
        'scope',
        'kwh',
        'created_by',
        'updated_by',
    ];    

    // protected $casts = [
    //     'data' => 'array', // Mengonversi kolom 'data' menjadi array
    // ];

    protected $dates = ['deleted_at'];

     /**
     * Mendefinisikan relasi belongsTo ke model TipeWarehouse.
     */
    public function tipeWarehouse()
    {
        return $this->belongsTo(TipeWarehouses::class, 'whse', 'name');
    }
}
