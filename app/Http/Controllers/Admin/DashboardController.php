<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;

use App\Mail\Contact;

use App\Property;
use App\Post;
use App\Comment;

use App\Setting;
use App\Message;
use App\User;
use Toastr;
use Auth;
use Hash;

class DashboardController extends Controller
{
    public function index()
    {
        $propertycount = Property::count();
        $postcount     = Post::count();
        $commentcount  = Comment::count();
        $usercount     = User::count();

        $properties    = Property::latest()->with('user')->take(5)->get();
        $posts         = Post::latest()->withCount('comments')->take(5)->get();
        $users         = User::with('role')->get();
        $comments      = Comment::with('users')->take(5)->get();

        return view('admin.dashboard', compact(
            'propertycount', 'postcount', 'commentcount', 'usercount',
            'properties',    'posts',     'users',        'comments'
        ));
    }


    public function settings()
    {
        $settings = Setting::first();

        return view('admin.settings.setting',compact('settings'));
    }

    public function settingStore(Request $request)
    {

        $this->validate($request, [
            'name'      => 'required',
            'email'     => 'required',
            'phone'     => 'required',
            'address'   => 'required',
            'footer'    => 'required',
            'aboutus'   => 'required',
            'facebook'  => 'required|url',
            'twitter'   => 'required|url',
            'linkedin'  => 'required|url',
        ]);

        Setting::updateOrCreate(
            [ 'id'       => 1 ],
            [
              'name'     => $request->name,
              'email'    => $request->email,
              'phone'    => $request->phone,
              'address'  => $request->address,
              'footer'   => $request->footer,
              'aboutus'  => $request->aboutus,
              'facebook' => $request->facebook,
              'twitter'  => $request->twitter,
              'linkedin' => $request->linkedin
            ]
        );

        $settings = Setting::first();

        Toastr::success('message', 'Updated successfully.');
        return back();
    }


    public function changePassword()
    {
        return view('admin.settings.changepassword');

    }

    public function changePasswordUpdate(Request $request)
    {
        if (!(Hash::check($request->get('currentpassword'), Auth::user()->password))) {

            Toastr::error('message', 'Your current password does not matches with the password you provided! Please try again.');
            return redirect()->back();
        }
        if(strcmp($request->get('currentpassword'), $request->get('newpassword')) == 0){

            Toastr::error('message', 'New Password cannot be same as your current password! Please choose a different password.');
            return redirect()->back();
        }

        $this->validate($request, [
            'currentpassword' => 'required',
            'newpassword' => 'required|string|min:6|confirmed',
        ]);

        $user = Auth::user();
        $user->password = bcrypt($request->get('newpassword'));
        $user->save();

        Toastr::success('message', 'Password changed successfully.');
        return redirect()->back();
    }


    public function profile()
    {
        $profile = Auth::user();

        return view('admin.settings.profile',compact('profile'));
    }

    public function profileUpdate(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'username'  => 'required',
            'email'     => 'required|email',
            'image'     => 'image|mimes:jpeg,jpg,png',
            'about'     => 'max:250'
        ]);

        $user = User::find(Auth::id());

        $image = $request->file('image');
        $slug  = str_slug($request->name);

        if(isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-admin-'.Auth::id().'-'.$currentDate.'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('users')){
                Storage::disk('public')->makeDirectory('users');
            }
            if(Storage::disk('public')->exists('users/'.$user->image) && $user->image != 'default.png' ){
                Storage::disk('public')->delete('users/'.$user->image);
            }
            $userimage = Image::make($image)->stream();
            Storage::disk('public')->put('users/'.$imagename, $userimage);
            
        }else{
            $imagename = $user->image;
        }

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->image = $imagename;
        $user->about = $request->about;

        $user->save();

        return back();
    }


    // MESSAGE
    public function message()
    {
        $messages = Message::latest()->where('agent_id', Auth::id())->get();

        return view('admin.settings.messages.index',compact('messages'));
    }

    public function messageRead($id)
    {
        $message = Message::findOrFail($id);

        return view('admin.settings.messages.readmessage',compact('message'));
    }

    public function messageReplay($id)
    {
        $message = Message::findOrFail($id);

        return view('admin.settings.messages.replaymessage',compact('message'));
    }

    public function messageSend(Request $request)
    {
        $request->validate([
            'agent_id'  => 'required',
            'user_id'   => 'required',
            'name'      => 'required',
            'email'     => 'required',
            'phone'     => 'required',
            'message'   => 'required'
        ]);

        Message::create($request->all());

        Toastr::success('message', 'Message send successfully.');
        return back();

    }

    public function messageReadUnread(Request $request)
    {
        $status = $request->status;
        $msgid  = $request->messageid;

        if($status){
            $status = 0;
        }else{
            $status = 1;
        }

        $message = Message::findOrFail($msgid);
        $message->status = $status;
        $message->save();

        return redirect()->route('admin.message');
    }

    public function messageDelete($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();

        Toastr::success('message', 'Message deleted successfully.');
        return back();
    }

    public function contactMail(Request $request)
    {
        $message  = $request->message;
        $name     = $request->name;
        $mailfrom = $request->mailfrom;

        Mail::to($request->email)->send(new Contact($message,$name,$mailfrom));

        Toastr::success('message', 'Mail send successfully.');
        return back();
    }
}
