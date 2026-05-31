<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BalanceRequest extends Model
{
    // Hatanın çözümü tam olarak burası: İzin verilen kolonları tanımlıyoruz.
    protected $fillable = ['user_id', 'amount', 'status'];

    /**
     * Talebin kime ait olduğunu belirtir.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}