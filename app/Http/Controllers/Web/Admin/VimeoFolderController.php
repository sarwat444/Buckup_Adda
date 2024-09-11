<?php
declare(strict_types=1);

namespace App\Http\Controllers\Web\Admin;

use App\Http\Requests\Web\Admin\Folder\UpdateFolderRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Repositories\VimeoFolderService;
use App\Http\Controllers\Controller;
use App\Events\VimeoFoldersFetched;
use App\Traits\ResponseJson;
use App\Models\VimeoFolder;

class VimeoFolderController extends Controller
{
    use ResponseJson;

    public function __construct(private readonly VimeoFolder $vimeoFolderModel){}

    public function index(): \Illuminate\View\View
    {
        return view('admins.vimeo-folders.index');
    }

    public function loadVimeoFolders(): \Illuminate\Http\JsonResponse
    {
        $apiFolders = VimeoFolderService::getFolders(request()->integer('page', 1));
        if ($apiFolders) {
            VimeoFoldersFetched::dispatch($this->vimeoFolderModel, $apiFolders);
        }
        return $this->responseJson($apiFolders, Response::HTTP_OK);
    }

    public function edit(int $folder_id): \Illuminate\Http\JsonResponse
    {
        $folder = $this->vimeoFolderModel->folder($folder_id)->first();
        return $this->responseJson(['data' => $folder], Response::HTTP_OK);
    }

    public function update(UpdateFolderRequest $updateFolderRequest, VimeoFolder $vimeoFolder): \Illuminate\Http\RedirectResponse
    {
        $folder = VimeoFolderService::updateFolder($vimeoFolder->getAttribute('folder_id'), $updateFolderRequest->validated('name'));
        if ($folder) {
            $this->vimeoFolderModel->update($updateFolderRequest->validated());
            return redirect()->back()->with('success', 'folder updated successfully');
        }
        return redirect()->back()->with('error', 'folder may not be exists on vimeo api');
    }

    public function destroy(int $folder_id): \Illuminate\Http\RedirectResponse
    {
        $deleteFolder = VimeoFolderService::deleteFolder($folder_id);
        if ($deleteFolder) {
            $this->vimeoFolderModel->folder($folder_id)->delete();
            return redirect()->back()->with('success', 'folder deleted successfully');
        }
        return redirect()->back()->with('error', 'folder may not be exists on vimeo api');
    }
}
