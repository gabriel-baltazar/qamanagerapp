<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title','description', 'user_id', 'responsible_id'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function _status()
    {
        $status = [
            0 => 'Em aberto',
            1 => 'Cancelada',
            2 => 'Finalizada'
        ];
        return $status[$this->status];
    }
}
