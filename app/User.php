<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendResetPasswordLink;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'provider','provider_id', 'avatar', 'verified', 'company_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function verifyUser()
    {
        return $this->hasOne('App\VerifyUser');
    }

    public function company()
    {
        return $this->hasOne('App\Company');
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }

    public function notifications() {
        return $this->hasMany(Notification::class);
    }

    public function cultureImages() {
        return $this->hasMany(CultureImage::class);
    }

    public function jobs() {
        return $this->hasMany(Job::class);
    }

    public function shoutouts() {
        return $this->hasMany(Shoutout::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function sendPasswordResetNotification($token)
    {
        $url = url(config('app.url').route('password.reset', $token, false));

        Mail::to($this->email)->send(new SendResetPasswordLink($this, $url));
    }
}
