<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\View\Component;

class Translations extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        if (app()->isProduction())  {
            $translations = Cache::rememberForever('translations_' . app()->getLocale(), function () {
                return $this->mergeTranslations();
            });
        } else {
            $translations = $this->mergeTranslations();
        }

        return view('components.translations', [
            'translations' => $translations,
        ]);
    }

    /**
     * @return array
     */
    private function mergeTranslations(): array
    {
        $locale = app()->getLocale();
        $phpTranslations = [];
        $jsonTranslations = [];

        if (File::exists(lang_path($locale))) {
            $phpTranslations = collect(File::allFiles(lang_path($locale)))
                ->filter(function ($file) {
                    return $file->getExtension() === 'php';
                })->flatMap(function ($file) {
                    return Arr::dot(File::getRequire($file->getRealPath()));
                })->toArray();
        }

        if (File::exists(lang_path($locale) . '.json')) {
            $jsonTranslations = json_decode(
                File::get(lang_path($locale) . '.json'),
                true
            );
        }

        return array_merge($phpTranslations, $jsonTranslations);
    }
}
