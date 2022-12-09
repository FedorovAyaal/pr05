<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class UpdateProfileController extends Controller
{
    public function info(Request $request)
    {
        $data = $request->validate([
            'name' => ['string', 'min:5', 'max:16'],
            'email' => ['string', 'email', 'max:255'],
            'first_name' => ['string', 'min:2'],
            'last_name' => ['string', 'min:2']
        ]);
        User::find(auth()->user()->id)->update($data);
        return back();
    }
    public function avatar(Request $request)
    {
        $data = $request->validate([
            'avatar' => ['required']
        ]);
        $data['slug'] = Str::slug('user_avatar_' . auth()->user()->id, '_');


        $unpreparedFilename = $data['avatar']->getClientOriginalName();
        $ext = pathinfo($unpreparedFilename, PATHINFO_EXTENSION);
        $filename = $data['slug'] . '.' . $ext;
        $data['avatar']->move(Storage::path('/public/images/avatar') . 'cropped/', $filename);

        $croppedAvatar = Image::make(Storage::path('/public/images/avatar') . 'cropped/' . $filename);
        $croppedAvatar->fit(500, 500);
        $croppedAvatar->save(Storage::path('/public/images/avatar/') . 'cropped/' . $filename);

        $data['avatar'] = $filename;

        User::whereId(auth()->user()->id)->update(['avatar' => $data['avatar']]);
        return back();
    }
    public function password(Request $request)
    {
        $data = Validator::make($request->all(), [
            'current_password' => ['required', 'string', 'min:8'],
            'new_password' => ['required', 'string', 'min:8'],
            'confirm_new_password' => ['required', 'string', 'min:8'],
        ]);

        if ($data->fails()) {

            //pass validator errors as errors object for ajax response

            return response()->json(['errors' => $data->errors()->first()]);
        }

        if ($request->input('new_password') == $request->input('confirm_new_password')) {
            if (Hash::check($request->input('current_password'), auth()->user()->password)) {

                if (Hash::check($request->input('new_password'), auth()->user()->password)) {
                    return json_encode(['response' => 'Нельзя менять на текущий пароль']);
                } else {
                    User::whereId(auth()->user()->id)->update(['password' => Hash::make($request->input('new_password'))]);
                    return json_encode(['response' => 'Пароль успешно изменен!']);
                }
            } else {
                return json_encode(['response' => 'Неверный пароль']);
            }
        } else {
            return json_encode(['response' => 'Пароли не совпадают']);
        }
    }
}
