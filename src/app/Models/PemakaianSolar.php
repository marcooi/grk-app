<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PemakaianSolar extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'whse',
        'workdate',
        'section_id',
        'qty',
        'deleted_at',
        'created_by',
        'updated_by',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
//    protected $casts = [
//         'data' => 'array', // Mengonversi kolom 'data' menjadi array
//     ];

    protected $dates = ['deleted_at'];

     /* Mendefinisikan relasi belongsTo ke model TipeSection.
     */
    public function tipeSection()
    {
        return $this->belongsTo(TipeSections::class, 'section_id');
    }

      /**
     * Mendefinisikan relasi belongsTo ke model TipeWarehouse.
     */
    public function tipeWarehouse()
    {
        return $this->belongsTo(TipeWarehouses::class, 'whse', 'name');
    }
}
