<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HTMLComponent
 *
 * @author CNTIP021
 */
class HTMLComponent {

    private static $component;

    public static function GenerateTable($data) {
        $param = false;
        $textLink = false;
        try {

            self::$component = "<table border='1'>";
            self::$component .= "<tr>";
            foreach ($data[0] as $indice => $valor) {
                $campos[] = $indice;
                self::$component .= "<td>" . StringUtil::Capitalize($indice) . "</td>";
            }
            self::$component .= "</tr>";
            
            if (!empty($_GET['link']) && !is_null($_GET['link']) && $_GET['link'] != "null" && $_GET['link'] != "undefined") {
                $stringLink = explode(',', str_replace(":", "=", $_GET['link']));
                $text = array();

                foreach ($stringLink as $link) {

                    $linkText = strpos($link, "->") != "" ? explode("->", trim($link)) : explode(".php", trim($link));

                    $textLink[] = $linkText[0];

                    if (strpos("?", $link) >= 0) {
                        $url = explode('?', $link);
                        if (strpos($url[1], ";") >= 0) {
                            $varParam = explode(';', $url[1]);
                            foreach ($varParam as $var) {
                                $var = explode("=", $var);
                                $param[preg_replace("#(\w+)\-\>#", "", trim($url[0] . "?"))][$var[0]] = $var[1];
                            }
                        }
                    }
                }
            }


            self::GenerateData($data, $param, $textLink);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public static function GenerateData($record, $links = false, $linksText = false) {
        foreach ($record as $indice => $valor) {
            self::$component .= '<tr>';
            foreach ($record[$indice] as $chave => $valor) {
                self::$component .= '<td>' . $valor . '</td>';
            }

            if ($links) {
                $x = 0;
                foreach ($links as $link => $param) {
                    $finaLink = $link;
                    foreach ($param as $var => $value) {
                        $finaLink .= $var . "=" . $record[$indice]->$value . "&";
                    }

                    self::$component .= '<td><a href="' . substr($finaLink, 0, strlen($finaLink) - 1) . '">' . $linksText[$x] . '</a></td>';
                    $x++;
                }
            }
            self::$component .= '</tr>';
        }
        self::$component .= "</table>";
        echo self::$component;
    }

    public static function populateForm($data) {
        $dados = "";
        foreach ($data[0] as $field => $value) {
            $dados .= $field . "=" . $value . "-&-";
        }
        echo $dados;
    }

    public static function populateDiv($data) {

        $value = $_GET['value'];
        $title = $_GET['title'] != "null" && $_GET['title'] != "" && $_GET['title'] != "undefined" ? $_GET['title'] : null;
        $source = $_GET['src'] != "null" && $_GET['src'] != "" && $_GET['src'] != "undefined" ? $_GET['src'] : null;

        if (isset($_GET['link']) && $_GET['link'] != "null") {
            $stringLink = explode(',', str_replace(":", "=", $_GET['link']));
            $text = array();

            foreach ($stringLink as $link) {

                $linkText = strpos($link, "->") != "" ? explode("->", trim($link)) : explode(".php", trim($link));

                $textLink[] = $linkText[0];

                if (strpos("?", $link) >= 0) {
                    $url = explode('?', $link);
                    if (strpos($url[1], ";") >= 0) {
                        $varParam = explode(';', $url[1]);
                        foreach ($varParam as $var) {
                            $var = explode("=", $var);
                            $param[preg_replace("#(\w+)\-\>#", "", trim($url[0] . "?"))][$var[0]] = $var[1];
                        }
                    }
                }
            }

            $newParam = array();
            foreach ($param as $chave => $par) {
                $link = $chave;
                $param = $par;
            }
        }
        
        $textos = "";
        foreach ($data as $texto) {
            if (isset($link)) {
                $linkActual = $link;
                foreach ($param as $chave => $valor) {
                    $linkActual .= $chave . "=" . $texto->$valor . "&";
                }
                $conteudo = "<a href='" . substr($linkActual, 0, strlen($linkActual) - 1) . "'>" . $texto->$value . "</a>";
            }else{
                $conteudo = $texto->$value;
            }


            $textos .= '<div>';
            if(!is_null($title))
                    $textos .= "<div class='title'>".$texto->$title."</div>";
            $textos .= $conteudo."<br/>";
            if(!is_null($source))
                    $textos .= "<div class='source'>".$texto->$source."</div>";
            $textos .= '<hr/></div>';
            
            $linkActual = "";
        }
        echo $textos;
    }

}

?>
