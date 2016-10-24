<?php


namespace App\Serializers;


use League\Fractal\Serializer\ArraySerializer;

class ArticlesSerializer extends ArraySerializer
{

    public function collection($resourceKey, array $data)
    {
        return [$resourceKey ?: 'articles' => $data];
    }
}