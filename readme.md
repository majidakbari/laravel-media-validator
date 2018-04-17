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

`video` -  mp4, 3gp, flv, mkv  
`audio` -  mp3, wav, ogg, amr, wma
