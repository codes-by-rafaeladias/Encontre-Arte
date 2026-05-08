<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\CustomResetPassword;
use Illuminate\Support\Str;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'business_name',
        'type',
        'bio',
        'profile_image',
        'is_active',
        'slug',
        'city',
        'state',
        'whatsapp',
        'instagram',
    ];

    protected $hidden = [
        'password'
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
        'password' => 'hashed', 
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Notifications\CustomResetPassword($token));
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'artisan_id');
    }

    public function favoriteProducts()
    {
        return $this->belongsToMany(Product::class, 'favorites', 'customer_id', 'product_id');
    }

    public function productReviews()
    {
        return $this->hasMany(\App\Models\ProductReview::class, 'customer_id');
    }

    public function receivedProductReviews()
    {
        return ProductReview::whereHas('product', function ($query) {
            $query->where('artisan_id', $this->id);
        });
    }

    public function averageRating()
    {
        return $this->receivedProductReviews()->avg('rating');
    }

    public function totalReviews()
    {
        return $this->receivedProductReviews()->count();
    }

    public function bestRatedProduct()
    {
        return $this->products()
        ->withAvg('reviews', 'rating')
        ->withCount('reviews')
        ->having('reviews_count', '>=', 10)
        ->orderByDesc('reviews_avg_rating')
        ->first();
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'customer_id', 'artisan_id');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'artisan_id', 'customer_id');
    }

    public function totalProducts()
    {
        return $this->products()->count();
    }
    
    public function totalFollowers()
    {
        return $this->followers()->count();
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            // só gera slug se for artesão
            if ($user->type === 'artisan' && empty($user->slug)) {
                $baseSlug = Str::slug($user->business_name ?? $user->name);
                $slug = $baseSlug;
                $count = 1;
                
                while (self::where('slug', $slug)->exists()) {
                    $slug = $baseSlug . '-' . $count;
                    $count++;
                    }
                    
                $user->slug = $slug;
            }
        });
    }

}