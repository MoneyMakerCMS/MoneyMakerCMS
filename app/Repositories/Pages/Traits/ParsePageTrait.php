<?php

namespace App\Repositories\Pages\Traits;

trait ParsePageTrait
{
    protected function parse($string, array $args = [])
    {
        $generated = $this->blade->compileString($string);

        ob_start() and extract($args, EXTR_SKIP);

        try {
            eval('?>'.$generated);
        } catch (\Exception $e) {
            ob_get_clean();
            throw $e;
        }

        $content = ob_get_clean();

        return $content;
    }
}
