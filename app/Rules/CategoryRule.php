<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Category;

class CategoryRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($mainCategoryType = null)
    {
        //
        $this->mainCategoryType = $mainCategoryType;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $checkCategory = Category::where('id',$value);
        if($this->mainCategoryType){
            $checkCategory = $checkCategory->where('main_category_type',$this->mainCategoryType);
        }
        return $checkCategory->count();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.invalid_value');
    }
}
