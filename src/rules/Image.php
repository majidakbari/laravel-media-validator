<?php

namespace makbari\validator\rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\UploadedFile;

/**
 * Class Image
 * @package makbari\validator\rules
 */
class Image implements Rule
{

    /**
     * @var array
     */
    protected $types;

    /**
     * Create a new rule instance.
     *
     * @param $validTypes
     */
    public function __construct($validTypes = [])
    {
        $this->types = !empty($validTypes) && is_array($validTypes) ? $validTypes : $this->getValidTypes();
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (($value instanceof UploadedFile)) {
            return in_array(
                preg_replace(
                    [
                        '/image\/jpeg/',
                        '/image\/jpeg/',
                        '/image\/jpeg/',
                        '/image\/gif/',
                        '/image\/png/',
                        '/image\/bmp/',
                        '/image\/tiff/',
                        '/image\/tiff/',
                        '/image\/x-icon/'
                    ],
                    [
                        'jpg',
                        'jpeg',
                        'jpe',
                        'gif',
                        'png',
                        'bmp',
                        'tif',
                        'tiff',
                        'ico'
                    ],
                    $value->getMimeType()
                ),
                $this->getTypes()
            );
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The attribute must be an image file by these formats : ' . implode(', ', $this->getTypes());

    }

    /**
     * @return array
     */
    private function getValidTypes()
    {
        return [
            'jpg',
            'jpeg',
            'jpe',
            'gif',
            'png',
            'bmp',
            'tif',
            'tiff',
            'ico'
        ];
    }

    /**
     * @return array
     */
    public function getTypes()
    {
        return $this->types;
    }

}
