<?php

class UrlValidator extends CValidator {

    private $pattern = "/^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/";

    /**
     * Validates the attribute of the object.
     * If there is any error, the error message is added to the object.
     * @param CModel $object the object being validated
     * @param string $attribute the attribute being validated
     */
    protected function validateAttribute($object, $attribute) {
        // extract the attribute value from it's model object
        $value = $object->$attribute;
        if (!preg_match($this->pattern, $value)) {
            $this->addError($object, $attribute, 'Url del video inválida');
        }
    }

    /**
     * Returns the JavaScript needed for performing client-side validation.
     * @param CModel $object the data object being validated
     * @param string $attribute the name of the attribute to be validated.
     * @return string the client-side validation script.
     * @see CActiveForm::enableClientValidation
     */
    public function clientValidateAttribute($object, $attribute) {

        // check the strength parameter used in the validation rule of our model
        $condition = "!value.match({$this->pattern})";
        return "
            if(" . $condition . ") {
                messages.push(" . CJSON::encode('Url del video inválida') . ");
            }
            ";
    }

}
