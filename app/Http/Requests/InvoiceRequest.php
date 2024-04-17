<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'date' => 'required',
            // 'invoice_no' =>
            'item.*.type' => 'required',
            'item.*.cost' => 'required',
            'item.*.qty' => 'required',
            'item.*.price' => 'required|numeric',


            'address' => 'required|regex:/^.*(?=\D+).*$/',
            'city'=>'required|regex:/^.*(?=\D+).*$/',
//            'domain'=>'required',
            'support_type'=>'nullable|max:200',
            'domain.*'=>'required|regex:/^(?!:\/\/)(?=.{1,255}$)((.{1,63}\.){1,127}(?![0-9]*$)[a-z0-9-]+\.?)$/i',
            'extra_mails.*'=>'nullable|email',
            'prefix'=>'required|min:1|max:4',
            'state' => 'required|regex:/^.*(?=\D+).*$/',
            'logo' => 'nullable|mimes:jpeg,png,jpg,svg|max:2048',
            'quick_pass' => 'required|url',
            'zip_code' => 'required|digits_between:5,7',
            'business_phone_number'=>'required',
            'subscription_type_id' => 'required|exists:subscription_types,id',
            'owner_id' => 'nullable|exists:employees,id',
            'status'=>'required',
            'created_by'=>'nullable',
            'fiscal_start_date_month' => 'nullable',
            'fiscal_end_date_month' => 'nullable'
        ];

    }
}
