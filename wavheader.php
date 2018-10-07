<?php
//
//  Author Faddeev Dmitry 2018
//

class WavHeader {
private static $chunkid=0x46464952; //RIFF
private $chunksize;
private static $format = 0x45564157,  //WAV
               $subchunk1id=0x20746d66, //fmt
               $subchunk1size=16;
public  $audioformat,
        $numchannels,
        $samplerate;
private $byterate,
        $blockalign;
public  $bitpersample;
private static $subchunk2id=0x61746164; //data
public  $subchunk2size;
public $wavheader;

function __construct($audio_format, // audio format 1: PCM, 2: Microsoft ADPCM, 6: ITU G.711 a-law, 7 ITU G.711 µ-law....  
                     $num_channels, // number channels
                     $sample_rate,  // samplerate bit per second
                     $bit_persample, // bit per sample 
                     $sub_chunk2size// size wav raw data 
                    ){
   $this->audioformat = $audio_format;
   $this->numchannels = $num_channels;
   $this->samplerate = $sample_rate;
   $this->bitpersample = $bit_persample;
   $this->subchunk2size = $sub_chunk2size;
   
}

public function createHeader(){
   if((isset($this->audioformat))
       &&(isset($this->numchannels))
       &&(isset($this->samplerate))
       &&(isset($this->bitpersample))
       &&(isset($this->subchunk2size))) {
       $this->chunksize = $this->subchunk2size+38;
       $this->byterate = $this->samplerate*($this->bitpersample/8);
       $this->blockalign = $this->bitpersample/8;
       
       $this->wavheader = pack("VVVVVvvVVvvVV",
                              self::$chunkid,
                              $this->chunksize,
                              self::$format,
                              self::$subchunk1id,
                              self::$subchunk1size,
                              $this->audioformat,
                              $this->numchannels,
                              $this->samplerate,
                              $this->byterate,
                              $this->blockalign,
                              $this->bitpersample,
                              self::$subchunk2id,
                              $this->subchunk2size
                              );                        
       return $this->wavheader;
       
       }   else return "no data audio header";
}
       
}


?>
