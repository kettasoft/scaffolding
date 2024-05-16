<?php

namespace Modules\Backups\Http\Controllers\Dashboard;

use Artisan;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Log;
use Symfony\Component\HttpFoundation\StreamedResponse;

class BackupController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Display a listing of the resource.
     * @return Factory|View
     */
    public function index()
    {
        $disk = Storage::disk(config('laravel-backup.backup.destination.disks'));
        $files = $disk->files('/Eve-Wasel/');
        $backups = [];
        foreach ($files as $k => $f) {
            if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                $backups[] = [
                    'file_path' => $f,
                    'file_name' => str_replace(config('laravel-backup.backup.name') . 'Eve-Wasel/', '', $f),
                    'file_size' => $disk->size($f),
                    'last_modified' => $disk->lastModified($f),
                ];
            }
        }
        $backups = array_reverse($backups);
        return view('backups::backups.index', compact('backups'));
    }

    /**
     * Show the form for creating a new resource.
     * @return RedirectResponse
     */
    public function create(Request $request)
    {
        try {
            switch ($request->input('backup_type')) {
                case 'full_backup':
                    /* all backup */
                    Artisan::call('backup:run');
                    break;

                case 'files_backup':
                    Artisan::call('backup:run --only-files');
                    break;

                case 'db_backup':
                    /* only database backup*/
                    Artisan::call('backup:run --only-db');
                    break;
            }
            $output = Artisan::output();
            Log::info("Backpack\BackupManager -- new backup started \r\n" . $output);
            flash(trans('backups::backups.messages.created'))->success();
            return redirect()->route('dashboard.backups.index');
        } catch (\Exception $e) {
            session()->flash('danger', $e->getMessage());
            flash($e->getMessage());
            return redirect()->route('dashboard.backups.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return StreamedResponse
     */
    public function download($file_name)
    {
        $file = config('laravel-backup.backup.name') . '/Eve-Wasel/' . $file_name;
        $disk = Storage::disk(config('laravel-backup.backup.destination.disks'));

        if ($disk->exists($file)) {
            $fs = Storage::disk(config('laravel-backup.backup.destination.disks'))->getDriver();
            $stream = $fs->readStream($file);

            return \Response::stream(function () use ($stream) {
                fpassthru($stream);
            }, 200, [
                "Content-Type" => $fs->getMimetype($file),
                "Content-Length" => $fs->getSize($file),
                "Content-disposition" => "attachment; filename=\"" . basename($file) . "\"",
            ]);
        }

        abort(404, "Backup file doesn't exist.");
    }

    /**
     * Remove the specified resource from storage.
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy($file_name)
    {
        $disk = Storage::disk(config('laravel-backup.backup.destination.disks'));
        if ($disk->exists(config('laravel-backup.backup.name') . '/Eve-Wasel/' . $file_name)) {
            $disk->delete(config('laravel-backup.backup.name') . '/Eve-Wasel/' . $file_name);
            flash(trans('backups::backups.messages.deleted'))->error();
            return redirect()->route('dashboard.backups.index');
        }

        abort(404, "Backup file doesn't exist.");
    }
}
