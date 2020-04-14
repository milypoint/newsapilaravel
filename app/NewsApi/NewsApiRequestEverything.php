<?php


namespace App\NewsApi;


class NewsApiRequestEverything extends NewsApiRequest
{
    protected static $_endpoint = '/v2/everything';

    protected static $_query_parameters = [
        'q',
        'qInTitle',
        'sources',
        'domains',
        'from',
        'to',
        'language',
        'sortBy',
        'pageSize',
        'page'
    ];

    public static $_languages = ['ar', 'de', 'en', 'es', 'fr', 'he', 'it', 'nl', 'no', 'pt', 'ru', 'se', 'ud', 'zh'];

    protected function validate($key)
    {
        switch ($key) {
            case 'language':
                return function ($value) {
                    if (!in_array($value, self::$_languages)) {
                        return false;
                    }
                    return true;
                };
            case 'q':
                return function ($value) {
                    if (!preg_match('~.*[A-Za-z0-9]+.*~', $value)) {
                        $this->errors['q'] = 'bad value';
                        return false;
                    }
                    return true;
                };
        }
        return null;
    }
}
