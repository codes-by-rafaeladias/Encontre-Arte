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
        'image_url',
        'category_id',
        'technique_id',
        'status',
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

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }
    
    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }
    
    public function averageRating()
    {
        return $this->reviews()->avg('rating') ?? 0;
    }

    public function materials()
    {
        return $this->belongsToMany(Material::class, 'product_material');
    }
    
    public function technique()
    {
        return $this->belongsTo(Technique::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Gera slug automaticamente ao criar
     */
    protected static function boot()
{
    parent::boot();

    static::creating(function ($product) {

        if (empty($product->slug)) {

            $baseSlug = Str::slug($product->name);
            $slug = $baseSlug;
            $count = 1;

            while (self::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $count;
                $count++;
            }

            $product->slug = $slug;
        }

    });
}
}
