<?php

namespace makbari\validator\rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\UploadedFile;

/**
 * Class Document
 * @package makbari\validator\rules
 */
class Document implements Rule
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
                        '/text\/csv/',
                        '/application\/msword/',
                        '/application\/vnd.openxmlformats-officedocument.wordprocessingml.document/',
                        '/application\/pdf/',
                        '/application\/vnd.ms-powerpoint/',
                        '/application\/vnd.ms-excel/',
                        '/application\/vnd.openxmlformats-officedocument.spreadsheetml.sheet/',
                        '/text\/plain/',
                        '/text\/css/',
                        '/text\/html/',
                        '/text\/html/'
                    ],
                    [
                        'csv',
                        'doc',
                        'docx',
                        'pdf',
                        'ppt',
                        'xls',
                        'xlsx',
                        'txt',
                        'css',
                        'html',
                        'htm',

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
        return 'The attribute must be a document file by these formats : ' . implode(', ', $this->getTypes());

    }

    /**
     * @return array
     */
    private function getValidTypes()
    {
        return [
            'csv',
            'doc',
            'docx',
            'pdf',
            'ppt',
            'xls',
            'xlsx',
            'txt',
            'css',
            'html',
            'htm',
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
