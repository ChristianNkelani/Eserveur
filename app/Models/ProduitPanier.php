<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProduitPanier extends Model
{
    use HasFactory;

    protected $fillable = ['product_id','qte','panier_id'];   

    public function produit():BelongsTo{
            return $this->belongsTo(Produit::class,'product_id','id');
    }
}
