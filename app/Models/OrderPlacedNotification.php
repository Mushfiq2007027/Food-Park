<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPlacedNotification extends Model
{
    use HasFactory;

    protected $fillable = ['seen'];
    //below code from c4
    //protected $fillable = ['seen', 'message', 'order_id'];

    // Optionally, you can also specify the data types of each attribute using casts.
    // This is useful if you need to ensure data integrity or automatic type conversion.
    //protected $casts = [
        //'seen' => 'tinyint',
        //'order_id' => 'integer', // Ensure 'order_id' is treated as an integer
        // Add any necessary type casts for other attributes if needed
    //];
}
