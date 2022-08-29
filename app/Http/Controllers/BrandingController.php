<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Rules\Domain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class BrandingController extends Controller
{
    public function index(Request $request)
    {
        $account = Auth::user()->account;
        $subscribed = Auth::user()->subscribed();

        return view('branding',compact('account', 'subscribed'));
    }

    public function setBrandingData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'account_id' => ['required', 'exists:accounts,id'],
            'brand_custom_domain' => ['nullable', 'string', new Domain],
            'brand_embed_url' => ['nullable', 'url', Rule::unique('accounts','brand_embed_url')->ignore($request->account_id)],
            'brand_custom_code' => ['nullable'],
            'brand_primary_color' => ['nullable'],
            'brand_secondary_color' => ['nullable'],
            'brand_logo' => ['nullable', 'file'],
            'brand_popular_by' => ['nullable'],
            'brand_popular_by.*' => ["in:".implode(',',Account::BRAND_POPULAR)],
        ], [], [
            'brand_custom_domain' => 'Custom domain',
            'brand_embed_url' => 'Embed url',
            'brand_custom_code' => 'Custom code',
            'brand_primary_color' => 'Primary color',
            'brand_secondary_color' => 'Secondary color',
            'brand_logo' => 'Logo',
            'brand_popular_by' => 'Most popular',
        ]);

        if ($validator->fails()) {
            return response()->json(['msg' => $validator->errors()->first(), 'status' => false], 400);
        }

        $account = Auth::user()->account;
        $account->brand_popular_by = array_unique(array_filter(explode(',',$request->brand_popular_by)));
        $account->update($request->only(['brand_custom_domain', 'brand_embed_url', 'brand_custom_code', 'brand_primary_color', 'brand_secondary_color', 'brand_cname_records']));

        if ($request->hasFile('brand_logo')) {
            $uploadedFile = $request->file('brand_logo');
            $filename = time() . $uploadedFile->getClientOriginalName();

            $path = Storage::disk('public')->putFileAs(
                Account::BRAND_LOGO_PATH,
                $uploadedFile,
                $filename
	    );
            if ($path) {
                //if ($account->brand_logo && Storage::disk('public')->exists($account->brand_logo)){
                //    Storage::disk('public')->delete($account->brand_logo);
                //}
                $account->brand_logo = $path;
		$account->save();

		dd($account->refresh()->toArray());
	    }
	}

        return response()->json([
            'status' => true,
            'message' => 'Saved successfully!'
        ]);
    }

}
