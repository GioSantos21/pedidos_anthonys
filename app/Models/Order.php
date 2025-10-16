<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // Permite asignación masiva de estos campos
    protected $fillable = ['correlatives', 'cod_sucursal', 'user_id', 'status', 'order_date','total_amount','notes'];

    // Relación de uno a muchos: Un pedido tiene muchos ítems
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Relación de muchos a uno: Un pedido pertenece a una sucursal
    public function branch()
    {
        return $this->belongsTo(Sucursales::class);
    }

    // Relación de muchos a uno: Un pedido fue creado por un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
