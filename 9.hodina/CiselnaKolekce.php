<?php
$array = [1,2,3,4,5,6,7,8,9,"66"];
/*
foreach($array as $item){
    echo$item . " ";
}
*/


class IntCollectionBase{
    private $values = [];

    public function addValue (int $val,$key = null): void
    {
        if($key==null){
           // $this->values[]=$val;
            array_push($this->values,$val);
        }else{
            $this->values[$key]=$val;
        }
    }

    public function get($key):int{
        return $this->values[$key];
    }

}


class IntCollection implements \Countable, \Iterator, \ArrayAccess
{

    private $values = [];
    private $position = 0;

    public function __construct(array $values=[]){
        foreach($values as $value){
            $this->offsetSet("",$value);
        }
    }

    public function count(){
        return count($this->values);
    }

    public function rewind() {
        $this->position = 0;
    }

    public function key(){
        return $this->position;
    }

    public function current(){
        return $this->values[$this->position];
    }

    public function next(){
        return $this->position++;
    }

    public function valid() {
        return isset($this->values[$this->position]);
    }

    public function offsetExists($offset)
    {
        return isset($this->values[$offset]);
    }

    public function offsetGet($offset){
        return $this->values[$offset];
    }

    public function offsetSet($offset,$value){
        if(!is_int($value)){
            throw new \InvalidArgumentException('Musí být číslo');
        }
        if(empty($offset)){
            array_push($this->values,$value);
        }
        else{
            $this->values[$offset] = $value;
        }
    }

    public function offsetUnset($offset)
    {
        unset($this->values[$offset]);
    }


}
/*
$col= new IntCollectionBase();
$col->addValue(45,0);
$col->addValue(102,1);
$col->addValue(115);
echo $col->get(0);
*/
$array = [1,2,3,4,5,5,7];

$col2=new IntCollection($array);
foreach($col2 as $item){
    echo $item . " ";
}

?>