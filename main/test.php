<?php
$lien_url = "";
$lien_target = "_self";
$selecteur = 1;
$annee = $_GET['annee'];
$mois  = $_GET['mois'];
if (($annee == "") || ($mois == ""))
{
$annee = date("Y");
$mois = date("n");
}

//nb jour dans le mois ok
$nbrejoursmois = date("t",mktime(12,0,0,$mois,1,$annee));

$premierjour = date("w",mktime(12,0,0,$mois,1,$annee));
//echo $premierjour;
$nummois = date("m",mktime(0,0,0,$mois,$jour,$annee));
//echo $nummois;
$numjour = date("d",mktime(0,0,0,$mois,$jour,$annee));
//echo $numjour;

if ($premierjour == 0) {
$premierjour = 7;
}
$date = "$numjour-$nummois-$annee";

$joursemaine = array(0 => "Dim",1 => "Lun", 2 => "Mar", 3 => "Mer", 4 => "Jeu", 5 => "Ven", 6 => "Sam" );
$moislettres=array(1 => "Janvier", 2 => "Février", 3 => "Mars", 4 => "Avril", 5 => "Mai", 6 => "Juin", 7 => "Juillet", 8 => "Août", 9 => "Septembre", 10 => "Octobre", 11 => "Novembre", 12 => "Décembre");

$jourmod = 0;
$jourAuj=date("d");
$moisAuj=$moislettres[date('n')];
$anneeAuj=date("Y");
$aujourdhui="$jourAuj $moisAuj $anneeAuj";
$nbcol =($nbrejoursmois*2)+1;

echo "<TABLE width='100%' border=1 align='center' cellpadding=0 cellspacing=0 bgcolor=#FFFFCC>\n";
echo "<TR><TD align=center colspan=$nbcol width='100%'><B><font size=+1>$moislettres[$mois] $annee</font></B></TD></TR>\n";
echo "<TR><TD width='10'>AGENT</TD>\n";

$nbjoursemaine = count($joursemaine);

for($i = 1; $i <= $nbrejoursmois ; $i++)
{
  $numjour = date("w",mktime(12,0,0,$mois,$i,$annee));
  $libjoursem = $joursemaine[$numjour];

  echo"<TD colspan='2' width='10' align=center ><font size=-1><font color=#0000ff>$libjoursem <BR /> $i</font></font></TD>\n";
}

$host = '';
$user = '';
$pass = '';
$base = '';

$link = mysql_connect($host,$user,$pass);

mysql_select_db($base,$link);


$sql = 'select * from intervenant order by code';

$u = 0;

$result = mysql_query($sql);

while($row = mysql_fetch_array($result))
{

     $color = ($u == 0)? '#FFC0C0':'#C0FFC0';

     echo "</TR><TR bgcolor='".$color."'><TD width='1%' nowrap><font size=-1>".$row['nom']." ".$row['prenom']."</font></TD>\n";

     for($i = 1; $i <= $nbrejoursmois ; $i++)0
     {
            $numjour = date("w",mktime(12,0,0,$mois,$i,$annee));
            $date = mktime(12, 0, 0, $mois,$i,$annee);
            $sql2 = 'select evtam.codehex as hexam,evtpm.codehex as hexpm,am,pm from tmp_intervention,evenement as evtam,evenement as evtpm  WHERE tmp_intervention.evtidam=evtam.idevenement AND tmp_intervention.evtidpm=evtpm.idevenement AND date = "'.$date.'" AND intervenantid ="'.$row['idintervenant'].'" ORDER BY am DESC';

            $result2 = mysql_query($sql2);

            if($numjour == '0' || $numjour == '6')
            {
                        echo"<TD bgcolor='gray' colspan='2' width='10' align=center >&nbsp;</TD>\n";
            }
            else
            {
                          if(mysql_num_rows($result2))
                          {
                              while($row2 = mysql_fetch_array($result2))
                              {
                              //AM
                                  if( $row2['am'] == 1 && $row2['pm'] == 0)
                                  {
                                      echo"<TD width='10' bgcolor = '".$row2['hexam']."' align=center >&nbsp;</TD>\n";
                                      echo"<TD width='10' align=center >&nbsp;</TD>\n";
                                  }
                                  elseif( $row2['pm'] == 1 && $row2['am'] == 0) //PM
                                  {
                                      echo"<TD width='10' align=center >&nbsp;</TD>\n";
                                      echo"<TD width='10' bgcolor = '".$row2['hexpm']."' align=center >&nbsp;</TD>\n";
                                  }
                                  elseif( $row2['pm'] == 1 && $row2['am'] == 1) //AM && PM
                                  {
                                      echo"<TD width='10' bgcolor = '".$row2['hexam']."' align=center >&nbsp;</TD>\n";
                                      echo"<TD width='10' bgcolor = '".$row2['hexpm']."' align=center >&nbsp;</TD>\n";
                                  }
                                  else
                                  {
                                      echo"<TD width='10' align=center >&nbsp;</TD>\n";
                                      echo"<TD width='10' align=center >&nbsp;</TD>\n";
                                  }
                              }
                           }
                           else
                           {
                               echo"<TD width='10' align=center >&nbsp;</TD>\n";
                               echo"<TD width='10' align=center >&nbsp;</TD>\n";
                           }


            }
     }

     if($u == 0)
     {
       $u = $u + 1;
     }
     else
     {
       $u = 0;
     }

     echo "</TR>\n";
}

if ($selecteur) {
if ($mois == 1) {
$anneeprec = $annee - 1;
$moisprec = 12;
} else {
$anneeprec = $annee;
$moisprec = $mois - 1;
}

if ($mois == 12) {
$anneesuiv = $annee + 1;
$moissuiv = 1;
} else {
$anneesuiv = $annee;
$moissuiv = $mois + 1;
}
$annee = date("Y");
$mois = date("n");
$jour = date("j");
}
echo "</TR></TABLE>\n";
echo "<CENTER><A HREF=\"$lien_url?annee=$anneeprec&mois=$moisprec\" TARGET=\"$lien_target\">mois précédent</A> | <A HREF=\"$lien_url?annee=$annee&mois=$mois\" TARGET=\"$lien_target\">mois courant</A> | <A HREF=\"$lien_url?annee=$anneesuiv&mois=$moissuiv\" TARGET=\"$lien_target\">mois suivant</A></CENTER>\n";

?>

