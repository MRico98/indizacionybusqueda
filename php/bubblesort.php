<?php
class BubbleSort{
    private $vector;
    private $tamaniovector;

    function __construct($vector,$tamaniovector){
        $this->vector = $vector;
        $this->tamaniovector = $tamaniovector;
    }

    public function sortingMethod(){
        for($i=1;$i<$this->tamaniovector;$i++){
            for($j=0;$j<$this->tamaniovector-$i;$j++){
                if(strcmp($this->vector[$j][0],$this->vector[$j+1][0]) > 0){
                    $auxiliar = $this->vector[$j+1];
                    $this->vector[$j+1] = $this->vector[$j];
                    $this->vector[$j] = $auxiliar;
                }
            }
        }
        return $this->vector;
    }
}
?>