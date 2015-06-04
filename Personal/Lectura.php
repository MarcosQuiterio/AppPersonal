<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");
 $todo=array();
 $i=0; 
$directorio = opendir("../"); //ruta actual
while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
{
    if (is_dir($archivo))//verificamos si es o no un directorio
    {
        //echo "[".$archivo . "]<br />"; //de ser un directorio lo envolvemos entre corchetes 
    }
    else
    {
        chmod($archivo, 0755);//el servidor le da los permisos para que pueda leer los archivos solo leer
   $pos = strpos($archivo, "AppMarcos-0");//lee solo los archivos que empiesen con PAP-E y los demas los omite
   $pos2 = strpos($archivo, ",v");//omite los archivos txt con terminacion  "v"
   $pos3 = strpos($archivo, ".lease");
   if($pos!==false&&$pos2===false&&$pos3===false){
   $campos=explode('%META:FORM{name="MarcosPersonalForm"}%',file_get_contents("../".$archivo));
    $n=count($campos);
   $campo=explode('%META:FIELD{',$campos[$n-1]);

   $Nombre=explode('"',$campo[1]);
   $Apellido=explode('"',$campo[2]);
   $Direccion=explode('"',$campo[3]);
   $Email=explode('"',$campo[4]);
   $Skype=explode('"',$campo[5]);
   $Telefono=explode('"',$campo[6]);
   $Organizacion=explode('"',$campo[7]);

   
	 	$todo[]=array("Nombre"=>utf8_encode ($Nombre[7]), "Apellido"=>utf8_encode ($Apellido[7]),"Direccion"=>utf8_encode ($Direccion[7]),"Email"=>utf8_encode ($Email[7]),"Skype"=>utf8_encode ($Skype[7]),"Telefono"=>utf8_encode ($Telefono[7]), "Organizacion"=> ($Organizacion[7]));
     $i++;
   }
    }
}
echo json_encode($todo);
?>


 