<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public $timestamps = false;

    protected $table = "country_lang"; //Название таблицы в бд, если бы совпадало с названием модели, то можно было не писать

    protected $fillable = [    ///Все поля из таблицы в БД
        'id',
        'alias',
        'name',
        'name_en'
    ];

    use HasFactory;
}
