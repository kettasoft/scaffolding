<?php

namespace App\Providers;

use App\Support\SettingJson;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function boot(): void
    {
        if (!app()->runningInConsole() && Schema::hasTable('settings')) {
            $this->configureTemplates();
            $this->configureMail();
            $this->configureBreadcrumbs();
        }
    }

    /**
     * Configure the dashboard & frontend templates.
     *
     * @return void
     * @throws BindingResolutionException
     */
    protected function configureTemplates(): void
    {
        $this->setConfigValue('dashboard_template', 'layouts.dashboard');

        $this->setConfigValue('frontend_template', 'layouts.frontend');
    }

    /**
     * Configure the application's mail driver.
     *
     * @return void
     * @throws BindingResolutionException
     */
    protected function configureMail(): void
    {
        $this->setConfigValue('mail_driver', 'mail.driver');
        $this->setConfigValue('mail_host', 'mail.host');
        $this->setConfigValue('mail_port', 'mail.port');
        $this->setConfigValue('mail_username', 'mail.username');
        $this->setConfigValue('mail_password', 'mail.password');
        $this->setConfigValue('mail_from_address', 'mail.from.address');
        $this->setConfigValue('mail_from_name', 'mail.from.name');
        $this->setConfigValue('mail_encryption', 'mail.encryption');
    }

    /**
     * Configure the application's Breadcrumbs view.
     *
     * @return void
     * @throws BindingResolutionException
     */
    protected function configureBreadcrumbs(): void
    {
        Config::set("breadcrumbs.view", layout('dashboard') . 'components.breadcrumbs');
    }

    /**
     * Override config value from settings.
     *
     * @param $settingKey
     * @param $config
     * @param bool $force
     * @param bool $bool
     * @throws BindingResolutionException
     */
    protected function setConfigValue($settingKey, $config, $force = false, $bool = false): void
    {
        if (($value = $this->app->make(SettingJson::class)->get($settingKey)) || $force) {
            config()->set([
                $config => $bool ? !!$value : $value,
            ]);
        }
    }
}
