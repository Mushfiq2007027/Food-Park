<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BannerSlider;
use App\Models\Category;
use App\Models\Chef;
use App\Models\Coupon;
use App\Models\DailyOffer;
use App\Models\Product;
use App\Models\Reservation;
use App\Models\SectionTitle;
use App\Models\Slider;
use App\Models\WhyChooseUs;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class FrontendController extends Controller
{
    function index(): View
    {
        $sectionTitles = $this->getSectionTitles();
        $sliders = Slider::where('status', 1)->get();
        $whyChooseUs = WhyChooseUs::where('status', 1)->get();
        $categories = Category::where(['show_at_home' => 1, 'status' => 1])->get();
        $dailyOffers = DailyOffer::with('product')->where('status', 1)->take(15)->get();
        $bannerSliders = BannerSlider::where('status', 1)->latest()->take(10)->get();
        $chefs = Chef::where(['show_at_home' => 1, 'status' => 1])->get();


        return view('frontend.home.index', compact('sliders', 'sectionTitles', 'whyChooseUs', 'categories', 'dailyOffers', 'bannerSliders', 'chefs'));
    }

    function getSectionTitles(): Collection
    {
        $keys = [
            'why_choose_top_title',
            'why_choose_main_title',
            'why_choose_sub_title',
            'daily_offer_top_title',
            'daily_offer_main_title',
            'daily_offer_sub_title',
            'chef_top_title',
            'chef_main_title',
            'chef_sub_title'
        ];
        return SectionTitle::whereIn('key', $keys)->pluck('value', 'key');
    }

    function chef() : View {
        $chefs = Chef::where(['status' => 1])->paginate(12);
        return view('frontend.pages.chefs', compact('chefs'));
    }

    function reservation(Request $request) {
        $request->validate([
             'name' => ['required', 'max:255'],
             'phone' => ['required', 'max:50'],
             'date' => ['required', 'date'],
             'time' => ['required'],
             'persons' => ['required', 'numeric']
        ]);

        if(!Auth::check())
        {
            throw ValidationException::withMessages(['Please Login to Request Reservation']);
        }

        $reservation = new Reservation();
        $reservation->reservation_id = rand(0, 500000);
        $reservation->user_id = auth()->user()->id;
        $reservation->name = $request->name;
        $reservation->phone = $request->phone;
        $reservation->date = $request->date;
        $reservation->time = $request->time;
        $reservation->persons = $request->persons;
        $reservation->status = 'pending';
        $reservation->save();

        return response(['status' => 'success', 'message' => 'Request Sent Successfully!']);

    }

    function showProduct(string $slug): View
    {
        $product = Product::with(['productImages', 'productSizes', 'productOptions'])->where(['slug' => $slug, 'status' => 1])->firstOrFail();
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)->take(8)->latest()->get();

        return view('frontend.pages.product-view', compact('product', 'relatedProducts'));
    }

    function loadProductModal($productId)
    {
        $product = Product::with(['productSizes', 'productOptions'])->findOrFail($productId);

        return view('frontend.layouts.ajax-files.product-popup-modal', compact('product'))->render();
    }

    function applyCoupon(Request $request)
    {

        $subtotal = $request->subtotal;
        $code = $request->code;
        $coupon = Coupon::where('code', $code)->first();

        if (!$coupon) {
            return response(['message' => 'Invalid Coupon Code!'], 422);
        }

        if ($coupon->quantity <= 0) {
            return response(['message' => 'Coupon has been fully redeemed'], 422);
        }
        if ($coupon->expire_date < now()) {
            return response(['message' => 'Coupon has expired!'], 422);
        }


        $discount = 0;
        if ($coupon->discount_type === 'percent') {
            $discount = $subtotal  * ($coupon->discount / 100);
        } else if ($coupon->discount_type === 'amount') {
            $discount = $coupon->discount;
        }


        $finalTotal = $subtotal - $discount;
        session()->put('coupon', ['code' => $code, 'discount' => $discount]);


        return response(['message' => 'Coupon Applied Successfully!', 'discount' => $discount, 'finalTotal' => $finalTotal, 'coupon_code' => $code]);
    }

    function destroyCoupon()
    {
        try {
            session()->forget('coupon');
            return response(['message' => 'Coupon Removed!', 'grand_cart_total' => grandCartTotal()]);
        } catch (\Exception $e) {
            logger($e);
            return response(['message' => 'Something Went Wrong !']);
        }
    }
}
