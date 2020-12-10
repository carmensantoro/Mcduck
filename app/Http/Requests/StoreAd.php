<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAd extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'title'=>'required|max:20',
            'body'=>'required|max:500|min:20',
            'price'=>'required|numeric|min:0.01',
            'category_id'=>'required',
        ];
    }

    public function messages(){
        return [
            'title.required'=>'Il titolo è richiesto',
            'title.max'=>'Troppi caratteri nel titolo',
            'body.required'=>'La descrizione è richiesta',
            'body.max'=>'Troppi caratteri nella descrizione',
            'body.min'=>'Scrivi di più',
            'price.required'=>'Devi mettere un prezzo',
            'price.numeric'=>'Devi mettere un numero',
            'price.min'=>'Il prezzo minimo è 0,01',
            'category_id.required'=>'Devi selezionare una categoria',
        ];
    }
}
