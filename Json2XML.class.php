<?php
    /*  
        * CREATED BY Samuel Carrara 
        * 03.11.2021
    */
    class Json2XML {
        private function normalize_tag($string){
            $replace = array('Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
                                'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
                                'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
                                'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
                                'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y' );
            $string = strtr($string, $replace);
            $string = preg_replace('/\s+/', ' ', $string);
            $string = str_replace(' ', '_', $string);
            $string = preg_replace("/[^a-zA-Z0-9-_.]/", "", $string);
            return $string;
        }

        private function normalize_content($string){
            $string = htmlspecialchars_decode($string, ENT_XML1 | ENT_COMPAT);
            return htmlspecialchars($string, ENT_XML1 | ENT_COMPAT, 'UTF-8');
        }

        private function proccess($object, $parent = "root"){
            $xml = "";
            foreach($object as $key => $x){
                if(is_null($x) || empty($x)){
                    if(is_numeric($key)) $xml .= "<".$this->normalize_tag($parent)." />";
                    else $xml .= "<".$this->normalize_tag($key)." />";
                    unset($object->$key);
                    continue;
                }
                if(is_string($x)){
                    $xml .= "<".$this->normalize_tag($key).">";
                    $xml .= $this->normalize_content($x);
                    $xml .= "</".$this->normalize_tag($key).">";
                    unset($object->$key);
                    continue;
                }
                if(is_array($x)){
                    foreach($x as $x2){
                        if(is_object($x2)){
                            $xml .= "<".$this->normalize_tag($key).">";
                            $xml .= $this->proccess($x2, $key);
                            $xml .= "</".$this->normalize_tag($key).">";
                        } else {
                            $xml .= "<".$this->normalize_tag($key).">";
                            $xml .= $this->normalize_content($x2);
                            $xml .= "</".$this->normalize_tag($key).">";
                        }
                    }
                    unset($object->$key);
                    continue;
                }
                if(is_object($x)){
                    $xml2 = "";
                    foreach($x as $key2 => $x2){
                        if(!is_object($x2)){
                            $xml2 .= "<".$this->normalize_tag($key2).">";
                            $xml2 .= $this->normalize_content($x2);
                            $xml2 .= "</".$this->normalize_tag($key2).">";
                        }
                    }
                    if(!empty($xml2)){
                        $xml .= "<".$this->normalize_tag($key).">";
                        $xml .= $xml2;
                        $xml .= "</".$this->normalize_tag($key).">";
                    } else {
                        $xml .= "<".$this->normalize_tag($key).">";
                        $xml .= $this->proccess($x, $key);
                        $xml .= "</".$this->normalize_tag($key).">";
                    }
                    unset($object->$key);
                    continue;
                }
            }
            return $xml;
        }

        public function convert($json, $main){
            $object = @json_decode($json);
            if(!$object) return false;
            $xml = "";
            $xml .= "<".$this->normalize_tag($main).">";
            $xml .= $this->proccess($object);
            $xml .= "</".$this->normalize_tag($main).">";
            return $xml;
        }
    }
?>