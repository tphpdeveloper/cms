<?php
/**
 * @author    Igor <igorkutsan@ukr.net>
 * @copyright 2018
 * @license   https://opensource.org/licenses/MIT
 */

namespace Tphpdeveloper\Cms\App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{

    use Notifiable ;

    protected $fillable = ['name', 'email', 'password', 'remember_token'];

    /**
     * Send the password reset notification.
     *
     * @param  string $token
     * @return void
     */
//    public function sendPasswordResetNotification($token)
//    {
//        $this->notify(new ResetPassword($token));
//    }

}
