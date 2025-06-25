<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinanceseModel extends Model
{
    public $updated_at = false;

    protected $table = 'financesTable';

    protected $fillable = [
        'user_id',
        'description',
        'type',
        'priceTotal',
    ];

    public function finance()
    {
        return $this->belongsTo(User::class);
    }
}
