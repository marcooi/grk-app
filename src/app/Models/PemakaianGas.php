<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class PemakaianGas extends Model
{
    use HasFactory, HasUuids,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'whse',
        'workdate',
        'section_id',
        'item_id',
        'qty',
        'kgs',
        'created_by',
        'updated_by',
    ];

    // protected $casts = [
    //     'data' => 'array', // Mengonversi kolom 'data' menjadi array
    // ];

    protected $dates = ['deleted_at'];

    public static function query(): Builder
    {
        return parent::query()->with('tipeSection');
    }

    /* Mendefinisikan relasi belongsTo ke model TipeSection.
     */
    public function tipeSection()
    {
        return $this->belongsTo(TipeSections::class, 'section_id');
    }

    public function tipeItem()
    {
        return $this->belongsTo(TipeGases::class, 'item_id');
    }

    /**
     * Mendefinisikan relasi belongsTo ke model TipeWarehouse.
     */
    public function tipeWarehouse()
    {
        return $this->belongsTo(TipeWarehouses::class, 'whse', 'name');
    }

    public function getCreatedByAttribute($value)
    {
        return $value ? $value : 'System';
    }

    public function getUpdatedByAttribute($value)
    {
        return $value ? $value : 'System';
    }
}
