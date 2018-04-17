# Media Validator

## Validator for Audio and Video files in laravel framework based projects

### Installation with Composer
```bash
curl -s http://getcomposer.org/installer | php
php composer.phar require makbari/media-validator

```
### Usage

In laravel based projects form validation could be checked by several methods; but all of them have the same structure and syntax

```php

public function rules()
{
    return [
        'video_input' => new \makbari\rules\validator\Video(),
        'audio_file' => new \makbari\rules\validator\Audio(),
        'image_file' => new \makbari\rules\validator\Image(),
        'document_file' => new \makbari\rules\validator\Document(),
    ];
}
```

Also you can pass your valid types to the validators:

```php

public function rules()
{
    return [
        'video_input' => new \makbari\rules\validator\Video(['mp4', 'mkv'])
    ];
}


```
### Available formats

`video`    -  mp4, 3gp, flv, mkv, avi, asf, asx, wmv, mpeg  
`audio`    -  mp3, wav, ogg, amr, wma, oga, m4a, m4b, ra, ram, mid, midi, aac  
`document` -  csv, doc, docx, pdf, ppt, xls, xlsx, txt, css, html, htm  
`image`    -  jpg, jpeg, gif, png, bmp, tif, tiff, ico  
