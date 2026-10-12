<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['nie', 'name', 'email', 'password', 'role_id'];
    protected $hidden   = ['password', 'remember_token'];
    protected $casts    = ['password' => 'hashed'];

    public function role()                { return $this->belongsTo(Role::class); }
    public function sales()               { return $this->hasMany(Sale::class); }
    public function purchaseRequests()    { return $this->hasMany(PurchaseRequest::class, 'chef_id'); }
    public function purchaseOrders()      { return $this->hasMany(PurchaseOrder::class, 'user_id'); }
    public function rawMaterialMovements(){ return $this->hasMany(RawMaterialMovement::class); }
    public function cashClosings()        { return $this->hasMany(CashRegisterClosing::class); }
    public function customerOrders()      { return $this->hasMany(Order::class); }
    public function studentPractices()    { return $this->hasMany(StudentPractice::class); }
    public function approvedEvents()      { return $this->hasMany(ExternalEvent::class, 'approved_by'); }
}