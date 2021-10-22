<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class basic extends Model
{
    public function generateId($string)
    {
        $id = '1069742916';
        $data = openssl_random_pseudo_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

        return $string . '' . $id . '' . str_replace("-", "", vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4)));
    }
}
