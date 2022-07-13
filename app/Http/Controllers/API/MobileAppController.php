<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\Slider as ResourcesSlider;
use App\Models\Contact;
use App\Models\FcmToken;
use App\Models\Order;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MobileAppController extends BaseController
{

    public function SaveToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' =>  ['required', 'unique:fcm_tokens,fcm_token'],
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Please validate error']);
        }
        FcmToken::create([
            'fcm_token' =>  $request->token,
        ]);

        return response()->json(['success' => 'Successfully Store Token']);
    }

    public function Packages()
    {
        $data = [
            ["image" => "uploads/packages/ic_golden.png", "title" => "الباقة الفضية", "sub_title" => "الحسابات التي سنديرها", "subtype" => "اشتراك عضوية شهري", "content" => ["إعداد المحتوى الإبداعي", "إعداد 15 تصميم شهرياً", "جدولة نشر المحتوى حسب أوقات الذروة", "إدارة تعليقات العملاء ومراقبتها باستمرار", "تصميم قالب موحد بألوان و خط هويتكم البصرية", "إنشاء جروب واتساب مخصص لمتابعة سير العمل"], "price" => "2250 ريال"],
            ["image" => "uploads/packages/ic_golden.png", "title" => "الباقة الذهبية", "sub_title" => "الحسابات التي سنديرها", "subtype" => "اشتراك عضوية شهري", "content" => ["إعداد المحتوى الإبداعي", "إعداد 30 تصميم شهرياً", "جدولة نشر المحتوى حسب أوقات الذروة", "إعداد خطة استراتيجية تسويقية لمشروعك", "إدارة تعليقات العملاء ومراقبتها باستمرار", "تسليم خطة المحتوى كل أسبوعين", "حل مشاكل حسابات التواصل الاجتماعي", "القيام بالحملات الإعلانية ومتابعتها بشكل كامل بعد استلام ميزانيتها", "تصميم قالب موحد بألوان و خط هويتكم البصرية", "إنشاء جروب واتساب مخصص لمتابعة سير العمل"], "price" => "3150 ريال"],
            ["image" => "uploads/packages/ic_golden.png", "title" => "الباقة الماسية", "sub_title" => "الحسابات التي سنديرها", "subtype" => "اشتراك عضوية شهري", "content" => ["إعداد المحتوى الإبداعي", "إعداد 45 تصميم شهرياً", "جدولة نشر المحتوى حسب أوقات", "إعداد خطة استراتيجية تسويقية لمشروعك", "إدارة تعليقات العملاء ومراقبتها باستمرار", "تسليم خطة المحتوى كل أسبوعين", "حل مشاكل حسابات التواصل الاجتماعي", "إعداد تقرير نمو وأداء الحسابات كل شهر", "القيام بالحملات الإعلانية ومتابعتها بشكل كامل بعد استلام ميزانيتها", "تصميم قالب موحد بألوان و خط هويتكم البصرية", "إنشاء جروب واتساب مخصص لمتابعة سير العمل"], "price" => "4500 ريال"],
        ];
        return $this->sendResponse(
            $data,
            'All Packages sent'
        );
    }

    public function sliders()
    {
        $sliders = Slider::orderBy('created_at', 'DESC')->get();
        return $this->sendResponse(
            ResourcesSlider::collection($sliders),
            'All Sliders sent'
        );
    }

    public function orderStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' =>  'required',
            'order' =>  'required',
            'phone_number' =>  'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Please validate error']);
        }
        Order::create([
            'name' =>  $request->name,
            'order' =>  $request->order,
            'package' =>  $request->package,
            'email' =>  $request->email,
            'phone_number' =>  $request->phone_number,
            'company' =>  $request->company,
            'details' =>  $request->details,
        ]);

        return response()->json(['success' => 'Successfully Store']);
    }

    public function contactStore(Request $request)
    {

        Validator::make($request->all(), [
            'name' =>  'required',
            'email' =>  'required',
            'message' =>  'required',
        ]);
        Contact::create([
            'name' =>  $request->name,
            'email' =>   $request->email,
            'message' =>   $request->message,
        ]);

        return response()->json(['success' => 'Successfully Store']);
    }
}
