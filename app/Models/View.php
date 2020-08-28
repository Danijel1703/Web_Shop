<?php

namespace Models;


class View{

    public function render(string $template, array $data = [])
    {
        $file='Views/' . $template . '.php';
        if(!file_exists($file))
        {
            echo '404';
        }
        ob_start();
        extract($data, EXTR_SKIP);
        include $file;
        $output = ob_get_clean();
        return $output;

    }

}

?>