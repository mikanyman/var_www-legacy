<?php
/* func_gallery.php
Gallerian funktiot
*/
function image_information($original_file)
{
    // Ottaa tarkistettavan tiedoston nimen ja tarkistaa sen tiedostopaatteen valittamatta tiedostonimesta, toimii kuville
    $type = getimagesize($original_file);
    $filesize = filesize($original_file);
   
    // Tarkistetaan tiedoston tyyppi
    if($type[2] == 1) // GIF
    {
        $file_extension = "gif";
        }
    elseif($type[2] == 2) // JPEG
    {
        $file_extension = "jpeg";
        }
    elseif($type[2] == 3) // PNG
    {
        $file_extension = "png";
        }
    else // Tiedostomuoto ei ole tuettu, palauttaa FALSE
    {
        $file_extension = FALSE;
        }
    // Funktio palauttaa arvot, jos ok
    if($file_extension)
    {
        // palauttaa type,tiedostopaate,leveys,korkeus,tiedostokoko
        return array($type[2],$file_extension,$type[0],$type[1],$filesize);
        }
    else
    {
        // Tiedostotyyppi ei ole tuettu tai jotain hairioo
        return array(FALSE,FALSE,FALSE,FALSE);
        }
    }

function create_resized_image($original_file,$destination_file,$resized_width,$resized_height)
{
    // Ottaa syotteena vastaan (alkuperainen tiedosto), (uuden kuvan hakemisto/tiedosto ilman paatetta), (uusi leveys), (uusi korkeus)
   
    // Selvitetaan kuvan koko ja tyyppi
    list($original_width, $original_height, $type) = getimagesize($original_file);
   
    // Tarkistetaan tiedoston tyyppi
    if($type == 1) // GIF
    {
        $original_image = imagecreatefromgif($original_file);
            // Lapinakyvyys -> valkoinen
            $white = imagecolorallocate($original_image, 255, 255, 255);
            $transparent = imagecolortransparent($original_image, $white);
        }
    elseif($type == 2) // JPEG
    {
        $original_image = imagecreatefromjpeg($original_file);
        }
    elseif($type == 3) // PNG
    {
        $original_image = imagecreatefrompng($original_file);
        }
    else // Tiedostomuoto ei ole tuettu, palauttaa FALSE
    {
        $type = FALSE;
        }
    if($type)
    {
        // Lasketaan kuvalle uusi koko siten, etta kuvasuhde sailyy
        $new_w = $original_width/$resized_width; // Kuvasuhde: leveys
        $new_h = $original_height/$resized_height; // Kuvasuhde: korkeus
        if($new_w > $new_h || $new_w == $new_h)
        {
            if($new_w < 1)
            {
                // Jos alkuperainen kuva on pienempi kuin luotava, luodaan alkuperaisen kokoinen kuva
                $new_w = 1;
                }
            // Kaytetaan sita suhdetta, jolla tulee max. asetettu leveys, korkeus on alle max.
            $new_width = $original_width / $new_w;
            $new_height = $original_height / $new_w;
            }
        elseif($new_w < $new_h)
        {
            if($new_h < 1)
            {
                // Jos alkuperainen kuva on pienempi kuin luotava, luodaan alkuperaisen kokoinen kuva
                $new_h = 1;
                }
            // Kaytetaan sita suhdetta, jolla tulee max. asetettu korkeus, leveys on alle max.
            $new_width = $original_width / $new_h;
            $new_height = $original_height / $new_h;
            }
        // Luodaan kuva, joka on maaratyn kokoinen
        $image = imagecreatetruecolor($new_width, $new_height);
        // Resample, luo uuden kuvan tiedostoon
        imagecopyresampled($image, $original_image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);
       
        // Tallennetaan uusi kuva maariteltyyn tiedostoon ja annetaan sopiva tiedostopaate
        if($type == 1) // GIF
        {
            imagegif($image, $destination_file);
            }
        elseif($type == 2) // JPEG
        {
            imagejpeg($image, $destination_file);
            }
        elseif($type == 3) // PNG
        {
            imagepng($image, $destination_file);
            }
    }
    // Poistetaan kuva muistista, ei tuhoa alkuperaista tiedostoa!
    imagedestroy($image);
    // Palauttaa tiedostotyypin onnistuessaan, FALSE jos ei onnistu
    return $type;
    }
    
?>