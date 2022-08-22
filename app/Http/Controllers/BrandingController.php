<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Rules\Domain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BrandingController extends Controller
{
    public function index()
    {
        $account = Account::find(1);
        return view('branding',compact('account'));
    }

    public function setBrandingData(Request $request)
    {
        dd($request->all());
        $validator = Validator::make($request->all(), [
            'account_id' => ['required', 'exists:accounts,id'],
            'brand_custom_domain' => ['nullable', 'string', new Domain],
            'brand_embed_url' => ['nullable', 'url'],
            'brand_custom_code' => ['nullable'],
            'brand_primary_color' => ['nullable'],
            'brand_secondary_color' => ['nullable'],
            'brand_logo' => ['nullable', 'file'],
            'brand_popular_by' => ['nullable', 'in:comments,reactions,replies'],
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

        $account = Account::find($request->account_id);
        $account->update($request->only(['brand_custom_domain', 'brand_embed_url', 'brand_custom_code', 'brand_primary_color', 'brand_secondary_color', 'brand_popular_by']));

        if ($request->hasFile('brand_logo')) {
            $uploadedFile = $request->file('brand_logo');
            $filename = time() . $uploadedFile->getClientOriginalName();

            $path = Storage::putFileAs(
                Account::BRAND_LOGO_PATH,
                $uploadedFile,
                $filename
            );
            if ($path) {
                if (Storage::exists($account->brand_logo)){
                    Storage::delete($account->brand_logo);
                }
                $account->brand_logo = $path;
                $account->save();
            }
        }

        return response()->json(['msg' => 'Success!', 'status' => true]);
    }

}
