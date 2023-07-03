<?php

namespace App\Http\Controllers\Banner;

use App\Http\Controllers\Controller;
use App\Models\HomeBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    public function viewBanners(){
        $all_banners = HomeBanner::where('status', 1)->get();
        return view('content.home-banners.banners')->with(['all_banners' =>  $all_banners]);
    }

    public function addNewBanner(Request $request){
        if($request->isMethod('get')){
            return view('content.home-banners.add-new-banner');
        }else{
            $validator = Validator::make($request->all(), [
                'bannerImage' => 'required|image|mimes:jpg,png,jpeg|max:1048'
            ]);
            if($validator->fails()){
                return response()->json(['message' => $validator->errors()->first(), 'status' => 0]);
            }else{
                try{
                    $imageName = null;
                    if ($request->hasFile('bannerImage')) {
                        $image = time() . '.' . $request->bannerImage->extension();
                        $request->bannerImage->move(public_path('Banner/Image/'), $image);
                        $imageName = 'Banner/Image/' . $image;
                    }

                    HomeBanner::create([
                        'image' => $imageName
                    ]);

                    return response()->json(['message' => 'Great! Banner Created Successfully', 'status' => 1]);

                }catch(\Exception $e){
                    return response()->json(['message' => 'Oops! Something Went Wrong.', 'status' => 0]);
                }
                
            }
        }
    }
}
