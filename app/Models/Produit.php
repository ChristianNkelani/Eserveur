<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Produit extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;


    protected $fillable = ['nom','qte','actif','sous_menu_id'];

    public function menu(): BelongsTo{
        return $this->belongsTo(Menu::class);
    }

    public function sous_menus(): HasMany {
        return $this->hasMany(SousMenu::class);
    }
}
