<?php

namespace App\Http\Controllers;

use App\Mail\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use stdClass;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class NotificationController extends Controller
{

    public function failure($data)
    {

        $name = 'Admin Central Windx';
        $email = getenv('MAIL_ADMIN_APP');

        try {

//            SendMail::send('emails.notification', [$data], function($message) use ($name, $email) {
//                $message->to($email, $name)
//                    ->subject('Erro - Central Windx');
//                $message->from($email,'$data->error');
//            });

                $notification = new stdClass();
                $notification->status = $data->status;
                $notification->error = $data->error;

                return new Notification($notification);

//            return response()->json([
//                'status' => 'success',
//                'message' => 'E-mail enviado com sucesso!',
//            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'error' => $e,
            ], 200);
        }

    }

    public function index()
    {
        $myArray = [
            ['id'=>1, 'title'=>'Laravel CRUD'],
            ['id'=>2, 'title'=>'Laravel Ajax CRUD'],
            ['id'=>3, 'title'=>'Laravel CORS Middleware'],
            ['id'=>4, 'title'=>'Laravel Autocomplete'],
            ['id'=>5, 'title'=>'Laravel Image Upload'],
            ['id'=>6, 'title'=>'Laravel Ajax Request'],
            ['id'=>7, 'title'=>'Laravel Multiple Image Upload'],
            ['id'=>8, 'title'=>'Laravel Ckeditor'],
            ['id'=>9, 'title'=>'Laravel Rest API'],
            ['id'=>10, 'title'=>'Laravel Pagination'],
        ];

        $data = $this->paginate($myArray);

//        $data->setBaseUrl('custom/url');

        return view('paginate', compact('data'));
    }

    public function paginate($items, $perPage = 3, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
