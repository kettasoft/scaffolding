<?php

namespace Modules\Accounts\Entities;

use Parental\HasChildren;
use App\Http\Filters\Filterable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Cog\Laravel\Ban\Traits\Bannable;
use Laratrust\Contracts\LaratrustUser;
use Illuminate\Notifications\Notifiable;
use Laracasts\Presenter\PresentableTrait;
use Lab404\Impersonate\Models\Impersonate;
use Spatie\MediaLibrary\InteractsWithMedia;
use Laratrust\Traits\HasRolesAndPermissions;
use Modules\Chats\Entities\Concerns\HasChats;
use Modules\Accounts\Entities\Helpers\UserHelpers;
use Cog\Contracts\Ban\Bannable as BannableContract;
use Modules\Accounts\Transformers\CustomerResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\Accounts\Entities\Presenters\UserPresenter;
use Illuminate\Contracts\Translation\HasLocalePreference;
use Modules\Accounts\Notifications\EmailVerificationNotification;
use AhmedAliraqi\LaravelMediaUploader\Entities\Concerns\HasUploader;

class User extends Authenticatable implements HasMedia, HasLocalePreference, LaratrustUser, BannableContract
{
    use Notifiable,
        UserHelpers,
        HasChildren,
        HasApiTokens,
        PresentableTrait,
        InteractsWithMedia,
        HasUploader,
        Filterable,
        HasRolesAndPermissions,
        HasFactory,
        Impersonate,
        Bannable;

    /**
     * Get the user's preferred locale.
     *
     * @return string
     */
    public function preferredLocale(): string
    {
        return $this->preferred_locale ?? app()->getLocale();
    }

    /**
     * The code of admin type.
     *
     * @var string
     */
    public const ADMIN_TYPE = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'remember_token',
        'blocked_at',
        'last_login_at',
        'device_token',
        'preferred_locale',
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['media'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @var array
     */
    protected array $childTypes = [
        self::ADMIN_TYPE => Admin::class
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @var string[]
     */
    protected $dates = [
        'blocked_at',
        'last_login_at',
    ];

    /**
     * The presenter class name.
     *
     * @var string
     */
    protected string $presenter = UserPresenter::class;

    /**
     * Get the number of models to return per page.
     *
     * @return int
     */
    public function getPerPage(): int
    {
        return request('perPage', parent::getPerPage());
    }

    /**
     * Define the media collections.
     *
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('avatars')
            ->useFallbackUrl('https://www.gravatar.com/avatar/' . md5($this->email) . '?d=mm')
            ->singleFile()
            ->registerMediaConversions(function () {
                $this->addMediaConversion('thumb')
                    ->width(50)
                    ->format('png');

                $this->addMediaConversion('small')
                    ->width(120)
                    ->format('png');

                $this->addMediaConversion('medium')
                    ->width(160)
                    ->format('png');

                $this->addMediaConversion('large')
                    ->width(320)
                    ->format('png');
            });
    }

    /**
     * Get the resource for customer type.
     *
     * @return CustomerResource
     */
    public function getResource()
    {
        return new CustomerResource($this);
    }

    /**
     * Get the access token currently associated with the user. Create a new.
     *
     * @param string|null $device
     * @return string
     */
    public function createTokenForDevice($device = null): string
    {
        $device = $device ?: 'Unknown Device';

        if ($this->currentAccessToken()) {
            return $this->currentAccessToken()->token;
        }

        $this->tokens()->where('name', $device)->delete();

        return $this->createToken($device)->plainTextToken;
    }

    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new EmailVerificationNotification($this->verify->code));
    }

    public function routeNotificationForOneSignal()
    {
        return $this->device_token;
    }

    /**
     * Get the dashboard profile link.
     *
     * @return string
     */
    public function dashboardProfile(): string
    {
        return '#';
    }

    /**
     * Determine whither the user can impersonate another user.
     *
     * @return bool
     */
    public function canImpersonate()
    {
        return $this->isAdmin();
    }

    /**
     * Determine whither the user can be impersonated by the admin.
     *
     * @return bool
     */
    public function canBeImpersonated()
    {
        return '';
    }
}
