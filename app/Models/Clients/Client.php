<?php

namespace App\Models\Clients;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'birthday'];

    /**
     * The numbers that belong to the Client
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function numbers()
    {
        return $this->belongsToMany(Number::class, 'client_has_numbers', 'client_id', 'number_id');
    }
}
