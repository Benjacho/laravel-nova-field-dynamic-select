<?php

namespace EsferaMedica\DynamicSelect\Http\Controllers;

use EsferaMedica\DynamicSelect\DynamicSelect;
use Illuminate\Routing\Controller;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\Account;
use EsferaMedica\SharedCore\SharedCore;

class OptionsController extends Controller
{
    public function index(NovaRequest $request)
    {
        $attribute = $request->input('attribute');
        $dependValues = $request->input('depends');
/*         $model = app($request->attribute);
 */        /* $resource = $request->newResource();
        $fields = $resource->updateFields($request);
        $field = $fields->findFieldByAttribute($attribute);
        dd($field); */

        /** @var DynamicSelect $field */
        /* $options = $field->getOptions($dependValues); */
        $options =  \App\Account::where('company_id', $dependValues['company'])->where('business_center_id', $dependValues['business'])->active()->watchForFeatured()->get();
        $result = [];
        if($options){
            foreach ($options as $key => $option) {
                $result[] = [
                    'value' => $option->id,
                    'label' => $option->name,
                ];
            }
        }
        
        return [
            'options' => $result,
        ];
    }
}
