<?php

namespace RatingCaptain\SynonymizedTextGenerator;

use Illuminate\Support\Facades\File;

class SynonymizedTextGenerator
{
    /**
     * @var string
     */
    private string $regex = '/\{[^\{}]+}/';

    /**
     * @param int $seed
     * @return void
     */
    public function addSeed(int $seed)
    {
        srand($seed);
    }

    /**
     * @param string $path
     * @param array $search
     * @param array $replaces
     * @return string
     */
    public function generateFromFile(string $path, array $search = [], array $replaces = []): string
    {
        return $this->generate(File::get($path), $search, $replaces);
    }

    /**
     * @param string $content
     * @param array $search
     * @param array $replaces
     * @return string
     */
    public function generate(string $content, array $search, array $replaces): string
    {
        preg_match_all($this->regex, $content, $matches);
        $number = crc32(implode('', $replaces));

        $synonymized = collect($matches[0])->map(function ($match) use ($number) {
            $data = explode('|', trim($match, '{}'));

            return [
                'search' => $match,
                'value'  => collect($data)->at($number % count($data))
            ];
        });

        $synonymized->each(function ($item, $key) use (&$content) {
            $search = '/'.preg_quote($item['search'], '/').'/';
            $content = preg_replace($search, $item['value'], $content, 1);
        });

        if (empty($search) || empty($replaces)) {
            return $content;
        }

        return str_replace($search, $replaces, $content);
    }
}
