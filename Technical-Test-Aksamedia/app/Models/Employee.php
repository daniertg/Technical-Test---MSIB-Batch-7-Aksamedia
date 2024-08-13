<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Employee extends Model
{
    use HasUuids; // Tambahkan trait HasUuids

    public $incrementing = false; // Tidak auto increment
    protected $keyType = 'uuid'; // Set key type sebagai UUID

    protected $fillable = [
        'name',
        'phone',
        'image',
        'position',
        'division_id',
    ];

    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class, 'division_id');
    }
}
