<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produit extends Model
{
    use HasFactory;
    protected $fillable=[
        'reference',
        'designation',
        'prix_unitaire',
        'image',
        'etat',
        'categorie_id',
    ];
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
}
