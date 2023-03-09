<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\AttributeTranslation;

class UniqueAttributeName implements Rule
{
    private $attributeId;
    private $attributeName;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($attributeName, $attributeId)
    {
        $this->attributeName = $attributeName;
        $this->$attributeId = $attributeId;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // $value ==> name of input in form

        if ($this->attributeId)  // edit attribute
            $attribute = AttributeTranslation::where('attribute_id', '!=', $this->attributeId)->where('name', $value)->first();
        else   // create attribute
            $attribute = AttributeTranslation::where('name', $value)->first();

        if ($attribute)
            return false;
        else
            return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('admin/attributes/attribute.is_existed');
    }
}
