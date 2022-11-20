<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title','description', 'user_id', 'responsible_id'];

    protected $dates = [
        'created_at',
        'updated_at',
        'closed_at'
    ];

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
    public function _responsavel()
    {
        if($this->responsible_id == 0){
            return 'Sem responsável';
        }else{
            $responsible = User::findOrFail($this->responsible_id)->name;
            return $responsible;
        }
    }
}
