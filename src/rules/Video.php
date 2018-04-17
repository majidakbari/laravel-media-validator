<?php

namespace makbari\rules\validator;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\UploadedFile;

/**
 * Class Video
 * @package makbari\rules\validator
 */
class Video implements Rule
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
                        '/video\/mp4/',
                        '/application\/octet-stream/',
                        '/video\/x-flv/',
                        '/video\/x-matroska/',
                    ],
                    [
                        'mp4',
                        '3gp',
                        'flv',
                        'mkv'
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
        return 'The attribute must be a video file by these formats : ' . implode(', ', $this->getTypes());
    }

    /**
     * @return array
     */
    private function getValidTypes()
    {
        return [
            'mp4', '3gp', 'flv', 'mkv'
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
