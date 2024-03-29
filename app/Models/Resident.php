<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    use HasFactory;

    protected $fillable = [ "name",
                            "last_name",
                            "age",
                            "street",
                            "house",
                            "city",
                            "state",
                            "zip",
                            "currency",
                            "housecolor",
                            "date"
                        ];
}
