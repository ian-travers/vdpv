<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $username
 * @property string $role
 * @property bool $is_admin
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Wagon[] $wagons
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUsername($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable;

    public const ROLE_USER = 'user';
    public const ROLE_LOCAL_WAGONS_MANAGER = 'local-manager';
    public const ROLE_WAGONS_MANAGER = 'manager';
    public const ROLE_STATION_ADMIN = 'station-administrator';

    protected $fillable = [
        'name', 'username', 'email', 'password', 'is_admin', 'role'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean'
    ];

    public static function rolesList(): array
    {
        return [
            self::ROLE_USER => 'Пользователь',
            self::ROLE_LOCAL_WAGONS_MANAGER => 'Управление местными вагонами',
            self::ROLE_WAGONS_MANAGER => 'Управление вагонами',
            self::ROLE_STATION_ADMIN => 'Администратор станции',
        ];
    }

    public function getRole()
    {
        return self::rolesList()[$this->role];
    }

    public function changeRole($role): void
    {
        if (!array_key_exists($role, self::rolesList())) {
            throw new \InvalidArgumentException('Неизвестная роль "' . $role . '"');
        }

        if ($this->role === $role) {
            throw new \DomainException('Эта роль уже назначена');
        }
        $this->update(['role' => $role]);
    }

    public function isForceCanBeChanged(): bool
    {
        if ($this->id == auth()->id()) return true;

        return $this->id != config('app.protected_user_id');
    }

    public function isLocalWagonsManager(): bool
    {
        return $this->role == self::ROLE_LOCAL_WAGONS_MANAGER;
    }

    public function isWagonsManager(): bool
    {
        return $this->role == self::ROLE_WAGONS_MANAGER;
    }

    public function isStationAdmin(): bool
    {
        return $this->role == self::ROLE_STATION_ADMIN;
    }

    public function wagons()
    {
        return $this->hasMany(Wagon::class, 'creator_id');
    }

    public function isAdmin(): bool
    {
        return $this->is_admin;
    }

    public function setAdminRights()
    {
        $this->update(['is_admin' => true]);
    }

    public function setPassword(string $password): void
    {
        if (strlen($password)) $this->password = bcrypt($password);
    }
}
