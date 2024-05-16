<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;

if (!function_exists('validate_base64')) {
    /**
     * Validate a base64 content.
     *
     * @param string $base64data
     * @param array $allowedMime example ['png', 'jpg', 'jpeg']
     * @return bool
     */
    function validate_base64($base64data, array $allowedMime)
    {
        // strip out data uri scheme information (see RFC 2397)
        if (strpos($base64data, ';base64') !== false) {
            [, $base64data] = explode(';', $base64data);
            [, $base64data] = explode(',', $base64data);
        }

        // strict mode filters for non-base64 alphabet characters
        if (base64_decode($base64data, true) === false) {
            return false;
        }

        // decoding and then reeconding should not change the data
        if (base64_encode(base64_decode($base64data)) !== $base64data) {
            return false;
        }

        $binaryData = base64_decode($base64data);

        // temporarily store the decoded data on the filesystem to be able to pass it to the fileAdder
        $tmpFile = tempnam(sys_get_temp_dir(), 'medialibrary');
        file_put_contents($tmpFile, $binaryData);

        // guard Against Invalid MimeType
        $allowedMime = Arr::flatten($allowedMime);

        // no allowedMimeTypes, then any type would be ok
        if (empty($allowedMime)) {
            return true;
        }

        // Check the MimeTypes
        $validation = Illuminate\Support\Facades\Validator::make(
            ['file' => new Illuminate\Http\File($tmpFile)],
            ['file' => 'mimes:' . implode(',', $allowedMime)]
        );

        return !$validation->fails();
    }
}

if (!function_exists('random_or_create')) {
    /**
     * Get random instance for the given model class or create new.
     *
     * @param string $model
     * @param int $count
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Support\Collection
     */
    function random_or_create($model, $count = null, $attributes = [])
    {
        $instance = new $model;

        if (!$instance->count()) {
            return $model::factory($count)->create($attributes);
        }

        if (count($attributes)) {
            foreach ($attributes as $key => $value) {
                $instance = $instance->where($key, $value);
            }
        }

        return $instance->get()->random();
    }

    /**
     * Get random instance for the given model class or create new.
     *
     * @param $size
     * @param string $unit
     * @return string
     */
    function humanFileSize($size, string $unit = ""): string
    {
        if ((!$unit && $size >= 1 << 30) || $unit === "GB")
            return number_format($size / (1 << 30), 2) . "GB";
        if ((!$unit && $size >= 1 << 20) || $unit === "MB")
            return number_format($size / (1 << 20), 2) . "MB";
        if ((!$unit && $size >= 1 << 10) || $unit === "KB")
            return number_format($size / (1 << 10), 2) . "KB";
        return number_format($size) . " bytes";
    }
}

if (!function_exists('app_name')) {
    /**
     * Get the application name.
     *
     * @return string
     */
    function app_name()
    {
        if (!file_exists(storage_path('installed'))) {
            return config('app.name', 'Laravel');
        }
        return Settings::locale()
            ->get('name', config('app.name', 'Laravel'))
            ?: config('app.name', 'Laravel');
    }
}

if (!function_exists('app_logo')) {
    /**
     * Get the application logo url.
     *
     * @return string
     */
    function app_logo()
    {
        if (!file_exists(storage_path('installed'))) {
            return 'https://ui-avatars.com/api/?name=' . rawurldecode(config('app.name')) . '&bold=true';
        }

        if (($model = Settings::instance('logo')) && $file = $model->getFirstMediaUrl('logo')) {
            return $file;
        }

        return 'https://ui-avatars.com/api/?name=' . rawurldecode(config('app.name')) . '&bold=true';
    }
}

if (!function_exists('app_favicon')) {
    /**
     * Get the application favicon url.
     *
     * @return string
     */
    function app_favicon()
    {
        if (!file_exists(storage_path('installed'))) {
            return 'https://ui-avatars.com/api/?name=' . rawurldecode(config('app.name')) . '&bold=true';
        }
        if (($model = Settings::instance('favicon')) && $file = $model->getFirstMediaUrl('favicon')) {
            return $file;
        }

        return '/favicon.ico';
    }
}

if (!function_exists('app_login_logo')) {
    /**
     * Get the application login logo url.
     *
     * @return string
     */
    function app_login_logo()
    {
        if (!file_exists(storage_path('installed'))) {
            return 'https://ui-avatars.com/api/?name=' . rawurldecode(config('app.name')) . '&bold=true';
        }
        if (($model = Settings::instance('loginLogo')) && $file = $model->getFirstMediaUrl('loginLogo')) {
            return $file;
        }

        return 'https://ui-avatars.com/api/?name=' . rawurldecode(config('app.name')) . '&bold=true';
    }
}

if (!function_exists('app_login_background')) {
    /**
     * Get the application login background url.
     *
     * @return string
     */
    function app_login_background()
    {
        if (!file_exists(storage_path('installed'))) {
            return 'https://ui-avatars.com/api/?name=' . rawurldecode(config('app.name')) . '&bold=true';
        }
        if (($model = Settings::instance('loginBackground')) && $file = $model->getFirstMediaUrl('loginBackground')) {
            return $file;
        }

        return 'https://ui-avatars.com/api/?name=' . rawurldecode(config('app.name')) . '&bold=true';
    }
}

if (!function_exists('isActive')) {
    /**
     * Set the active class to the current opened menu.
     *
     * @param string|array $route
     * @param string $className
     * @return string
     */
    function isActive($route, $className = 'active')
    {
        if (is_array($route)) {
            return in_array(Route::currentRouteName(), $route) ? $className : '';
        }
        if (Route::currentRouteName() == $route) {
            return $className;
        }
        if (strpos(URL::current(), $route)) {
            return $className;
        }
    }
}

if (!function_exists('getSubdirectory')) {
    /**
     * Set the active class to the current opened menu.
     *
     * @param bool $keep_trailing_slash
     * @param bool $keep_front_slash
     * @return string
     */
    function getSubdirectory($keep_trailing_slash = false, $keep_front_slash = false)
    {
        $subdirectory = '';

        $app_url = config('app.url');

        // Check host to ignore default values.
        $app_host = parse_url($app_url, PHP_URL_HOST);

        if ($app_url && !in_array($app_host, ['localhost', 'example.com'])) {
            $subdirectory = parse_url($app_url, PHP_URL_PATH);
        } else {
            // Before app is installed
            $subdirectory = $_SERVER['PHP_SELF'];

            $filename = basename($_SERVER['SCRIPT_FILENAME']);

            if (basename($_SERVER['SCRIPT_NAME']) === $filename) {
                $subdirectory = $_SERVER['SCRIPT_NAME'];
            } elseif (basename($_SERVER['PHP_SELF']) === $filename) {
                $subdirectory = $_SERVER['PHP_SELF'];
            } elseif (array_key_exists('ORIG_SCRIPT_NAME', $_SERVER) && basename($_SERVER['ORIG_SCRIPT_NAME']) === $filename) {
                $subdirectory = $_SERVER['ORIG_SCRIPT_NAME']; // 1and1 shared hosting compatibility
            } else {
                // Backtrack up the script_filename to find the portion matching
                // php_self
                $path = $_SERVER['PHP_SELF'];
                $file = $_SERVER['SCRIPT_FILENAME'];
                $segs = explode('/', trim($file, '/'));
                $segs = array_reverse($segs);
                $index = 0;
                $last = \count($segs);
                $subdirectory = '';
                do {
                    $seg = $segs[$index];
                    $subdirectory = '/' . $seg . $subdirectory;
                    ++$index;
                } while ($last > $index && (false !== $pos = strpos($path, $subdirectory)) && 0 != $pos);
            }
        }

        if ($subdirectory === null) {
            $subdirectory = '';
        }

        $subdirectory = str_replace('public/index.php', '', $subdirectory);
        $subdirectory = str_replace('index.php', '', $subdirectory);

        $subdirectory = trim($subdirectory, '/');
        if ($keep_trailing_slash) {
            $subdirectory .= '/';
        }

        if ($keep_front_slash && $subdirectory != '/') {
            $subdirectory = '/' . $subdirectory;
        }

        return $subdirectory;
    }
}

if (!function_exists('layout')) {
    /**
     * Retrieve the view layout name.
     *
     * @param string $type
     * @return string
     */
    function layout($type)
    {
        $field = $type == 'dashboard' ? 'dashboard_template' : 'template';

        if ($type = 'dashboard') {
            if ($value = Config::get('layouts.dashboard')) {
                return "dashboard::.{$value}.";
            }
        }

        return 'dashboard::';
    }
}


