<?php
/**
 * Auto-generated code below aims at helping you parse
 * the standard input according to the problem statement.
 **/


class Heap extends SplHeap
{
    /**
     * We modify the abstract method compare so we can sort our
     * rankings using the values of a given array
     */
    public function compare($array1, $array2)
    {
        $values1 = array_values($array1);
        $values2 = array_values($array2);
        if ($values1[0] === $values2[0]) return 0;
        return $values1[0] < $values2[0] ? -1 : 1;
    }
}


fscanf(STDIN, "%d %d %d",
    $N, // the total number of nodes in the level, including the gateways
    $L, // the number of links
    $E // the number of exit gateways
);

/**
 * Conclusion le 08/05/2018
 */

$voisinsTables=[];
$getways=[];

for ($i = 0; $i < $L; $i++)
{
    fscanf(STDIN, "%d %d",
        $N1, // N1 and N2 defines a link between these nodes
        $N2
    );
    $voisinsTables[$N1][]=$N2;
    $voisinsTables[$N2][]=$N1;
}
for ($i = 0; $i < $E; $i++)
{
    fscanf(STDIN, "%d",
        $EI // the index of a gateway node
    );
    $getways[]=$EI;
}





$servedGetways=[];
$parents=[];

$dist=[];

for($i=0; $i<$N ; $i++){
    $dist[$i]=-1;
}

while (TRUE) {
    fscanf(STDIN, "%d",
        $SI
    );
    $heap=new Heap();


        $dist[$SI] = 100;
        $viseted[] = $SI;
        $heap->insert([100, $SI]);

        $i=true;
        while (!$heap->isEmpty() && $i) {


            $test = $heap->extract();
            $current = $test[1];

            error_log(var_export('Currunt : ' . $current . ' dist : ' . $test[0], true));


            if (isset($parents[$current]) &&
                in_array($current, $getways) &&
                !in_array($current . $parents[$current], $servedGetways)) {
                $servedGetways[] = $current . $parents[$current];
                $dist[$parents[$current]]-=$N;
                echo "$parents[$current] $current\n";
                $i=false;
            }
            //  error_log(var_export('Currunt : '.$current. ' dist : '.$test[0], true));
            error_log(var_export('served : ', true));
            //error_log(var_export($servedGetways, true));
            //error_log(var_export('Currunt : '.$current. ' dist : '.$test[0], true));


            foreach ($voisinsTables[$current] as $voisin) {

                if (!in_array($voisin, $viseted) &&
                    !in_array($voisin . $current, $servedGetways)
                ) {
                    if (in_array($voisin, $getways)) {
                        $dist[$voisin]=$N;
                    }else{
                       $dist[$voisin]+=$voisin;
                    }
                    $viseted[] = $voisin;
                    $parents[$voisin] = $current;

                    $heap->insert([$dist[$voisin], $voisin]);
                }
                if ($current == 6) {
                    //error_log(var_export('finie les voisons :', true));
                    //error_log(var_export('finie les voisons : ', true));
                    //error_log(var_export($heap->top(), true));
                }

            }
            // if($current==6){
            //  error_log(var_export('sortie de la boucle forech :', true));

            //}
    }

    $viseted =null;
    $heap = null;
    $dist[$SI]=-1;
}


    //  error_log(var_export($SI, true));}
?>

/**

if ($stack->isEmpty()) {
foreach ($voisinsTables[$SI] as $voisin) {
if (in_array($voisin, $getways)) {
$stack->push($voisin);
echo("$SI  $voisin \n");

}
}
echo ("3 4 \n");
error_log(var_export($stack, true));
} else {
$getwayVoison = $stack->pop();
echo("$SI  $getwayVoison \n");
error_log(var_export($stack, true));

}
*/

/**
* Parcours en profondeur

$parents=[];
$visited=[];
$stack=new SplStack();
$stack->push($SI);
$visited[]=$SI;
while(!$stack->isEmpty()){

error_log(var_export("stack : ", true));
error_log(var_export($stack->serialize(), true));
$current=$stack->pop();

if(isset($parents[$current]) && in_array($current, $getways)){
$servedGetways[]=$current;
echo "$parents[$current] $current \n";
}
error_log(var_export("current : $current", true));
error_log(var_export("array_visted", true));
error_log(var_export( $visited, true));

foreach ($voisinsTables[$current] as $voisin){
if(!in_array($voisin, $visited, true)  && ! in_array($voisin, $servedGetways, true) ){
error_log(var_export( "ajoute: ".$voisin, true));
$stack->push($voisin);
$visited[]=$voisin;
$parents[$voisin]=$current;
}
}
}
$stack=null;
$visited=null;
$parents=null;
*/
