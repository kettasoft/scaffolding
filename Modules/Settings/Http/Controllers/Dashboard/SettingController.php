<?php

namespace Modules\Settings\Http\Controllers\Dashboard;

use App\Support\SettingJson;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Laraeast\LaravelSettings\Facades\Settings;
use Modules\Settings\Http\Requests\SettingRequest;

class SettingController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * The list of the files keys.
     *
     * @var array
     */
    protected $files = [
        'logo',
        'favicon',
        'loginLogo',
        'loginBackground',
    ];

    /**
     * SettingController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:read_settings')->only(['index']);
        $this->middleware('permission:create_settings')->only(['create', 'store']);
        $this->middleware('permission:update_settings')->only(['edit', 'update']);
        $this->middleware('permission:delete_settings')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     * @return Factory|View
     */
    public function index()
    {
        if (!$tab = request('tab')) {
            return redirect()->route('dashboard.settings.index', ['tab' => 'main']);
        }

        if (!view()->exists($view = "settings::settings.tabs.$tab")) {
            abort(404);
        }

        return view($view);
    }

    /**
     * Update the specified resource in storage.
     * @param SettingRequest $request
     * @return RedirectResponse
     */
    public function update(SettingRequest $request)
    {
        foreach (
            $request->except(
                array_merge(['_token', '_method',], $this->files)
            )
            as $key => $value
        ) {
            Settings::set($key, $value);
        }

        foreach ($this->files as $file) {
            Settings::set($file)->addAllMediaFromTokens($request->$file ?? [], $file);
        }

        app(SettingJson::class)->update();

        flash(trans('settings::settings.messages.updated'))->success();

        return redirect()->back();
    }
}
