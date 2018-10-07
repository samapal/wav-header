# wav-header
wav heaser class php
Usage
$newwavheader = new WavHeader(1, // audio format 1: PCM, 2: Microsoft ADPCM, 6: ITU G.711 a-law, 7 ITU G.711 µ-law....  
                              1, // number channels
                              8000, // samplerate bit per second
                              8, // bit per sample
                              16000 // size wav raw data 
                              );
$wavh = $newwavheader->createHeader();
$newwavheader->subchunk2size = 1604560;
$wavh = $newwavheader->createHeader();
