<?php
namespace App\Helpers;
use App\User;
use App\Helpers\GravatarHelper;
class ImageHelper
{
	public static function getUserImage($id)
	{
		$user=User::find($id);
		$avatar_url="";
		if(!is_null($user)){
			if($user->avatar==null){
				if(GravatarHelper::validate_gravatar($user->email)){
					$avatar_url=GravatarHelper::gravatar_image($user->email,100);
				}else{
					$avatar_url=url('images/defaults/user.png');
				}
			}
			else{
				$avatar_url=url('images/user/'.$user->avatar);
			}
		}
		else{
			
		}
		return $avatar_url;
	}
}