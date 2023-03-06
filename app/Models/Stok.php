<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumberTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stok extends Model
{
    use HasFactory;
    use AutoNumberTrait;
    protected $table = "datastok";
    protected $guarded = [
        'id'
    ];

    public function getAutoNumberOptions()
    {
        return [
            'code' => [
                'format' => 'KODE?', // Format kode yang akan digunakan.
                'length' => 3 // Jumlah digit yang akan digunakan sebagai nomor urut
            ]
        ];
    }
}
