<?php
class WordStandardization{
    public static function toLowerCase($filecontent){
        return strtolower($filecontent);
    }

    public static function deletePunctuationSign($filecontent){
        $standarization = new WordStandardization();
        $palabras = explode(" ",$filecontent);
        $numpalabras = count($palabras);
        for($i=0;$i<$numpalabras;$i++){
            if($standarization->lastDigit($palabras[$i]) == '.' || $standarization->lastDigit($palabras[$i]) == ','){
                $palabras[$i] = $standarization->deleteLastDigit($palabras[$i]);
            }
        }
        $palabras = $standarization->toSentence($palabras,$standarization);
        return $palabras;
    }

    public function lastDigit($palabra){
        return substr($palabra,-1);
    }

    public function deleteLastDigit($palabra){
        return substr($palabra,0,-1);
    }

    public function toSentence($palabras,$standarization){
        $sentence = "";
        foreach($palabras as $palabra){
            $sentence .= $palabra." ";
        }
        $sentence = $standarization->deleteLastDigit($sentence);
        return $sentence;
    }
}
?>