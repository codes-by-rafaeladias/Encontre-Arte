<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    /**
     * Campos permitidos para preenchimento em massa
     */
    protected $fillable = [
        'artisan_id',
        'name',
        'slug',
        'description',
        'price',
        'category',
        'image_url',
    ];

    /**
     * Casts
     */
    protected $casts = [
        'price' => 'decimal:2',
    ];

    /**
     * Relacionamento: Produto pertence a um artesão (User)
     */
    public function artisan()
    {
        return $this->belongsTo(User::class, 'artisan_id');
    }

    /**
     * Gera slug automaticamente ao criar
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name) . '-' . uniqid();
            }
        });
    }
}
