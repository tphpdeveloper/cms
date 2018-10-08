<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    use \Themsaid\Multilingual\Translatable;

    protected $fillable = ['name'];
    public $translatable = ['name'];
    protected $casts = [
        'name' => 'array',
    ];

    /**
     * link with settings table
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function settings()
    {
        return $this->hasMany(Setting::class);
    }

}
