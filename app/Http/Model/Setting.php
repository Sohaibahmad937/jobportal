<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
	protected $table = 'settings';
    protected $fillable = [
        'mail_driver',
        'mail_host',
        'mail_port',
        'mail_from_address',
        'mail_from_name',
        'mail_encryption',
        'mail_username',
        'mail_password',
        'mail_recipient',
        'mail_recipientname',
        'zipcode',
        'address',
    ];
}
