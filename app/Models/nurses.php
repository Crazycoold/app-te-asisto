<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class nurses extends Model
{
    public $incrementing = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = "nurses";
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i',
        'updated_at' => 'datetime:Y-m-d H:i',
    ];

    public function scopeSearch($query, $data)
    {
        return $query->where('dni', 'like', '%' . $data . '%')->orWhere('first_name', 'like', '%' . $data . '%')->orWhere('last_name', 'like', '%' . $data . '%')->orWhere('first_surname', 'like', '%' . $data . '%')->orWhere('last_surname', 'like', '%' . $data . '%');
    }
}
