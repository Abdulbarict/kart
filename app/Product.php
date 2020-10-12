<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $casts = [
        'use_type' => 'boolean',
        'types' => 'array'
    ];
 public function setTypesAttribute($value)
{
    $types = [];
if  (!is_null($value) )
{
    foreach ($value as $array_item) {
        if (!is_null($array_item['name']) && !is_null($array_item['price']) && !is_null($array_item['disc']) ) {
            $types[] = $array_item;
        }
    }

    $this->attributes['types'] = json_encode($types);
}
}
}
