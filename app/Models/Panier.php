<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Panier extends Model
{
    use HasFactory;

    protected $fillable = ['order_id','table'];

    // public function commande():HasOne{
    //     return $this->hasOne(Commande::class,);
    // }

    public function propas(): HasMany{
        return $this->hasMany(ProduitPanier::class);
    }
}
