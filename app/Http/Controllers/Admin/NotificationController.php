<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\models\Notification;
use App\models\Product;
use App\models\UserNotification;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NotificationController extends Controller
{
    public $types=['ticket', 'warningProduct'];
    //Buy Product
    //Less than required
    //Ticket
    public function  index($type,$id){
        $notifications = UserNotification::paginate(10);
        return view('admin.notifications',compact('notifications','id'));
    }
    public function all_notifications($action){
        if($action == 'add'){
            for ($i=0;$i<count($this->types);$i++ ){
                Notification::create([
                    'name'=>$this->types[$i]
                ]);
            }
        }else{
            $notifications  = Notification::get();
            foreach ($notifications as $type){
                $type->delete();
            }
        }

    }
    public function notify($user_id,$product_id){
      $curent_number =  Product::where('category_id ',$product_id)->where('state','available')->count();
        UserNotification::create([
            'user_id'=>$user_id,
            'product_id'=>$product_id,
            'notification_id'=>3,
            'read'=>0,
            'curent_number'=>$curent_number,
        ]);
    }
    public function updateNotify(Request  $request){
        $notification = UserNotification::find($request->notification);
        if($notification->read == 0){
            $res = 1;
        }else{
            $res = 0;
        }
        $notification->update([
            'read'=>$res
        ]);
    }
    public function updateNotifyGet($notification){
        $notification = UserNotification::find($notification);
        if($notification->read == 0){
            $res = 1;
        }else{
            $res = 0;
        }
        $notification->update([
            'read'=>$res
        ]);
        return redirect()->route('view.notifications',['type'=>'vendor','id'=>1]);
    }

    public function markAsRead(Request $request){

       $notifications = $request->list;
       if($notifications) {
           $all_notifications = UserNotification::get();
           foreach ($all_notifications as $notify) {
               if (in_array($notify->id, $notifications)) {
                   $notify->update([
                       'read' => 1
                   ]);
               }

           }
           return redirect()->back();

       }else{
           return redirect()->back();
       }

    }
    public function markAllAsRead(){
        $notifications = UserNotification::get();
        foreach ($notifications as $notify) {
            $notify->update([
                'read' => 1
            ]);

        }
        return redirect()->back();

    }

    public function  render($id)
    {
        $notifications = UserNotification::where('user_id', $id)->get();
        $html = '';
        foreach ($notifications as $notify) {
            if ($notify->read == 1) {
                $html .= "
                        <li class=\"unread\"> ";
            } else {
                $html .= "
                        <li>";
                    }
            $html .="
                    <div class=\"col-mail col-mail-1\">
                        <div class=\"checkbox-wrapper-mail\">
                            <input type=\"checkbox\" id=\"chk'.$notify->id.'\">
                            <label for=\"chk'.$notify->id.'\" class=\"toggle\"></label>
                        </div>
                        <a href=\"#\" class=\"title\">
                            '.$notify->user->name.'
                        </a>";
                if ($notify->star == 1) {
                    $html .= "
                            <span class=\"star-toggle far fa-star\"></span>";
                } else {
                    $html .= "
                        <span class=\"star-toggle fas fa-star\" ></span>";
                }
                $html .= "
                    </div>
                    <div class=\"col-mail col-mail-2\">
                        <a href=\"#\" class=\"subject\">Hello – <span class=\"teaser\">Trip home from Colombo has been arranged, then Jenna will come get me from Stockholm. :)</span>
                        </a>
                        <div class=\"date\">Mar 6</div>
                    </div>
                </li>
        ";

        }
        return $html;
    }
}
