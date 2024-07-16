<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['nom'];

    public function produits(): HasMany{
        return $this->hasMany(Produit::class);
    }

    public function sousMenus(): HasMany {
        return $this->hasMany(SousMenu::class);
    }
}
