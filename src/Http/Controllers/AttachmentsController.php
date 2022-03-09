<?php

namespace ExclusiveDev\FileLeech\Http\Controllers;

use Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use ExclusiveDev\FileLeech\Contracts\Attachment;
use ExclusiveDev\FileLeech\Http\Requests\GetRequest;
use ExclusiveDev\FileLeech\Http\Requests\SaveRequest;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class AttachmentsController extends Controller
{
	use AuthorizesRequests;

	protected $policyPrefix;

	/**
	 * CommentsController constructor.
	 * @param VoteService $voteService
	 */
	public function __construct()
	{
		// $this->middleware([request()->hasHeader('authorization') ? 'auth:api' : 'web','cors']);
		$this->policyPrefix = config('attachments.policy_prefix');
	}

	/**
	 * Creates new attachments for given model.
	 * @param SaveRequest $request
	 * @return array|\Illuminate\Http\RedirectResponse
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
	public function store(SaveRequest $request)
	{
		$this->authorize($this->policyPrefix . '.store');
		$attachable = $request->attachable();		
		$attachments = [];
		foreach ($request->file('file') as $file) {			
			$path = $file->store(config('attachments.storage.path'), config('attachments.storage.disk'));
			$attachments[] = ['type' => $file->getClientMimeType(), 'size' => $file->getSize(), 'label' => $file->getClientOriginalName(), 'attacher_id' => $request->user()->id, 'path' => $path];			
		}

		$attachable->attachments()->createMany($attachments);

		return $request->ajax()
			? ['message' => __('The attachments were successfully stored.')]
			: redirect()->to(url()->previous());// . '#attachment-' . $attachment->id);
	}

	/**
	 * @param GetRequest $request
	 * @return array
	 */
	public function index(GetRequest $request)
	{
		$attachable = $request->attachable();		
		return $attachable->attachments()
					->orderBy($request->order_by, $request->order_direction ?? 'desc')
					->get();
	}
	
	/**
	 * Deletes an attachment.
	 * @param Request $request
	 * @param Comment $comment
	 * @return array|\Illuminate\Http\RedirectResponse
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
	public function destroy($id)
	{
		$attachment = config('attachments.models.attachment')::findOrFail($id);
		
		$this->authorize($this->policyPrefix . '.delete', $attachment);

		$attachment->delete();

		return request()->ajax()
			? ['message' => __('The attachment was successfully deleted.')]
			: redirect()->back();		
	}

	public function show($id) {
		$attachment = config('attachments.models.attachment')::findOrFail($id);
		
		$headers = [
            'Content-Type'        => 'Content-Type: '. $attachment->type,
            // 'Content-Disposition' => 'attachment; filename="'. $attachment->label .'"',
        ];
		if (request()->has('download'))
			$headers += ['Content-Disposition' => 'attachment; filename="'. $attachment->label .'"'];

        return Response::make(Storage::disk(config('attachments.storage.disk'))->get($attachment->path), \Symfony\Component\HttpFoundation\Response::HTTP_OK, $headers);
	}

}
