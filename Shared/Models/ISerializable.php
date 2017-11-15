<?php

interface ISerializable {
    public function Deserialize($input);
    public function Serialize();
}

?>