<?php
namespace es\ucm\fdi\aw;
include 'ImageManipulator.php';

    class SubidaImagen_Controller{
        private $imagen_tmp;
        private $imagen_name;
        private $nickname;
        private $urlFoto;

        function __Construct($tmp, $nombre, $nickname, $urlFoto){
            $this->imagen_tmp = $tmp;
            $this->nickname = $nickname;
            $this->urlFoto = $urlFoto;
            $this->imagen_name = $nombre;
        }
        
        public function guardaImagen(){
            $img = '../public/img/saved/'.$this->nickname.'-'.$this->urlFoto;

            $manipulator = new ImageManipulator($this->imagen_tmp);
            $width  = $manipulator->getWidth();
            $height = $manipulator->getHeight();
            $centreX = round($width / 2);

            $x1 = $centreX - ($height/2); // 200 / 2
            $x2 = $centreX + ($height/2); // 200 / 2
            $y1 =0; // 200 / 2
            $y2 = $width; // 200 / 2
    
            // center cropping to 200x130
            $newImage = $manipulator->crop($x1, $y1 , $x2, $y2);
            // saving file to uploads folder
            $manipulator->save($img);
        }
    
    }
?>