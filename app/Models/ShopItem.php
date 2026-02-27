<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ShopItem extends Model
{
    protected $fillable = ['type', 'name', 'cost', 'amount', 'column_name', 'icon_color'];
}