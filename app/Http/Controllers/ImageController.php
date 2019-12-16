<?php
  
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use App\Http\Requests;
use Image;
use App\UserImage;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{
  
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function resizeImage()
    {
        return view('resizeImage');
    }
  
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function resizeImagePost(Request $request)
    {
    	if(isset($request['image'])){
    		$this->validate($request, [
	            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
	        ]);
	  
	        $image = $request->file('image');
	        $input['imagename'] = Auth::User()->id.'_'.time().'.'.$image->extension();
	     
	        $destinationPath = public_path('/images');
	        $img = Image::make($image->path());
	        $img->resize(160, 160, function ($constraint) {
	            $constraint->aspectRatio();
	        })->save($destinationPath.'/'.$input['imagename']);
            if(empty(Utils::getUserAvatar())){
                $data = UserImage::create(array (
                    'user_id'          => Auth::User()->id,
                    'file_name'    => $input['imagename'],
                    'type'        => self::IMG_AVATAR
                ));
            } else {
                unlink($destinationPath.'/'.Utils::getUserAvatar());
                $data = UserImage::updateAvatar(array (
                    'user_id'          => Auth::User()->id,
                    'file_name'    => $input['imagename']
                ));
            }
    	}
        
    }
   
}