<?php
class Card implements JsonSerializable
{
    public $header;
    public $text;

    public function __construct($header, $text, $date)
    {
        $this->header = $header;
        $this->text = $text;
        $this->date = $date;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }



}
?>