<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NotifyUser;
use Illuminate\Support\Facades\Mail;

class SendNotificationJob implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	protected $requestData;
	protected $userIds;

	/**
	 * Create a new job instance.
	 *
	 * @return void
	 */
	public function __construct($requestData, $userIds)
	{
		$this->requestData = $requestData;
		$this->userIds = $userIds;
	}

	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle()
	{
		if ($this->requestData['notify'] == 'notify') {
			$clients = ($this->userIds == 'all') ? User::latest()->get() : User::whereIn('id', $this->userIds)->get();
			Notification::send($clients, new NotifyUser($this->requestData));
		} else {
			$emails = ($this->userIds == 'all') ? User::where('email', '!=', null)->pluck('email')->toArray() : User::whereIn('id', $this->userIds)->pluck('email')->toArray();
			//Mail::to($emails)->send(new SendMail(['title' => 'اشعار اداري', 'message' => $this->requestData['message']]));
		}
	}
}
