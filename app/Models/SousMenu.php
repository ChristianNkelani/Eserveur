<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SousMenu extends Model
{
    use HasFactory;

    protected $fillable = ['nom','menu_id'];

    public function menu(): BelongsTo{
        return $this->belongsTo(Menu::class);
    }

    public function produits(): HasMany{
        return $this->hasMany(Produit::class);
    }
}
