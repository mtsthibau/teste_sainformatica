<?php

$validateScript = false;

class UI_Comp_Formulario
{

    function UI_Comp_Formulario($validateScript = false)
    {
        $GLOBALS["validateScript"] = $validateScript == true ? "onsubmit='return validateForm()'" : null;
    }

    function renderer($param = false)
    {
        $data = "";
        $text = "";
        $textArea = "";

        if ($param != false || count($param) != 0) {
            $data = $param['Data'];
            $text = $param['Texto'];
            $textArea = $param['Texto Grande'];
        }

        $html = '<form action="server/UI_Comp_Formulario.php" method="POST" ' . $GLOBALS["validateScript"] . '>';
        $html .= "<div class='row'><label>Data: </label><input type='text' id='date' onkeyup='maskDate(this)' maxlength='10' name='date' value='" . $data . "'/></div>";
        $html .= "<div class='row'><label>Texto: </label><input type='text' id='text' name='text' value='" . $text . "'/></div>";
        $html .= "<div class='row'><label>Checkbox? </label><input type='checkbox' id='checkbox' name='checkbox' checked></div>";
        $html .= "<div class='row'><label>Texto grande: </label><textarea id='textarea' name='textarea' rows='8' cols='40'>" . $textArea . "</textarea></div>";
        $html .= '<div class="row"><label></label><input type="submit" value="Submit"></div></form>';

        echo $html;
    }

    function validate()
    {
        $date = $_POST['date'];
        $text = $_POST['text'];
        $textArea = $_POST['textarea'];

        if ($this->validateDate($date) == true && $this->validateText($text) == true && $this->validateTextArea($textArea) == true) {
            header('Location: http://localhost/teste_php_sainformatica/index.php?msg=1');
            return true;
        } else {
            header('Location: http://localhost/teste_php_sainformatica/index.php?msg=2');
            return false;
        }
    }


    function validateDate($date)
    {

        if (!$date) {
            return false;
        }

        $month = substr($date, 0, 2);
        $day = substr($date, 3, 2);
        $year = substr($date, -4);
        $dateComp = $month . "-" . $day . "-" . $year;

        if ($date == $dateComp) {
            return true;
        } else {
            return false;
        }
    }

    function validateText($text)
    {
        if (strlen($text) > 144) {
            return false;
        }

        for ($i = 0; $i < strlen($text); $i++) {

            $char = print_r($this->ascii_to_dec($text[$i]));

            if (($char >= 97 && $char <= 122) || $char == 32) {
                continue;
            } else {
                echo chr($char);
                return false;
            }
        }

        return true;
    }

    function validateTextArea($textArea)
    {

        if (strlen($textArea) > 255) {
            return false;
        }

        for ($i = 0; $i < strlen($textArea); $i++) {

            $char = print_r($this->ascii_to_dec($textArea[$i]));

            if (($char >= 48 && $char <= 57) || (($char >= 65 && $char <= 90)) || $char == 32) {
                continue;
            } else {
                return false;
            }
        }

        return true;
    }

    function ascii_to_dec($str)
    {
        for ($i = 0, $j = strlen($str); $i < $j; $i++) {
            $dec_array[] = ord($str[$i][0]);
        }
        return $dec_array;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $comp = new UI_Comp_Formulario;
    $comp->validate($_POST);
}
