<?php

namespace makbari\validator\rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\UploadedFile;

/**
 * Class Audio
 * @package makbari\validator\rules
 */
class Audio implements Rule
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
                        '/audio\/mpeg/',
                        '/audio\/mpeg/',
                        '/audio\/mpeg/',
                        '/audio\/x-realaudio/',
                        '/audio\/x-realaudio/',
                        '/audio\/x-wav/',
                        '/application\/ogg/',
                        '/application\/ogg/',
                        '/audio\/midi/',
                        '/audio\/midi/',
                        '/audio\/x-ms-wma/',
                        '/application\/octet-stream/',
                        '/audio\/aac/'
                    ],
                    [
                        'mp3',
                        'm4a',
                        'm4b',
                        'ra',
                        'ram',
                        'wav',
                        'ogg',
                        'oga',
                        'mid',
                        'midi',
                        'wma',
                        'amr',
                        'aac'
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
        return 'The attribute must be an audio file by these formats : ' . implode(', ', $this->getTypes());

    }

    /**
     * @return array
     */
    private function getValidTypes()
    {
        return [
            'mp3',
            'm4a',
            'm4b',
            'ra',
            'ram',
            'wav',
            'ogg',
            'oga',
            'mid',
            'midi',
            'wma',
            'amr',
            'aac'
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
