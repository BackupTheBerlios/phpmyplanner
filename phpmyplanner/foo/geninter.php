<?php

############################################################## 
## Titre :      Intranet Racine
## Auteur :     Tilliette Yvan
## Auteur bis :
## Version :    2.0
## Fichier :    geninter.php
############################################################## 
## Commentaires sur le fichier:
## Génération aléatoire du calendrier d'interventions
##
############################################################## 
## Notes de l'auteur : 
##############################################################
## Historique du fichier : 
## 
##   Commentaire : Aucun
############################################################## 

if( !defined('IN_INTER') )
{
    define('IN_INTER', true);
    define('PAGE', 'planning');
    $int     = './';
    $header  = 'header.php';
    $footer  = 'footer.php';
}

include($int . 'start.php');

$tabinter = array();
$tabagent = array();
$tabmois = array();

//Je récupère le mois et l'année courants
$annee = date("Y");
$mois = date("n");

//Calcul du nombre de jours travaillés dans le mois (jours de semaine)
$nbjours = '0';
for ($i=1;$i<=date("t");$i++)
{
    $day = mktime('','','',$mois,$i,$annee);
    $today = getdate($day);
    if ( $today['wday'] > '0' && $today['wday'] < '6')
    {
        $tabmois[$i]='1';
        $nbjours++;
    }
    else
    {
        $tabmois[$i]='0';
    }
}

//Nb de demi-journées
$nbdemijours = $nbjours*2;

//Je calcule le nombre d'agents intervenants
$sql_getnbagt = "SELECT count(idintervenant) as nb FROM " . AGENT . " WHERE inter='1'";
if( !$getnbagt = $db->query($sql_getnbagt) )
{
    message(ERROR, 'Impossible de lire les informations', __FILE__, __LINE__, $sql_getnbagt);
}

$nb = $db->result($getnbagt,0,'nb');

//Je crée un tableau avec les ids des agents dans la table
$sql_getidagt = "SELECT idintervenant FROM " . AGENT . " WHERE inter='1'";
if( !$getidagt = $db->query($sql_getidagt) )
{
    message(ERROR, 'Impossible de lire les informations', __FILE__, __LINE__, $sql_getidagt);
}

$i = '0';
while ( $idagt = $db->fetch_array($getidagt))
{
    $tabagent[$i] = $idagt['idintervenant'];
    $i++;
}

//J'initialise mon tableau à 0
for ($i=0;$i<$nb;$i++)
{
    $tabinter[$i]='0';
}

//J'affecte le nombre de demi-journées d'inter pour le mois par agent
$modulo = $nbdemijours % $nb;

$nbinter = ($nbdemijours-$modulo) / $nb;

for ($i=0;$i<$nb;$i++)
{
    $tabinter[$i]=$nbinter;
}

while($modulo != '0')
{
    $agent = mt_rand('0',($nb-1));
    $tabinter[$agent]++;
    $modulo--;
}

//Affectation des demi-journées d'inter par agent

//Je veux limiter le nombre d'inters par semaine => je fais un tableau pour compter
$tabsemaine = array();
for ($i=0;$i<$nb;$i++)
{
    $tabsemaine[$i]='0';
}

for ($i=1;$i<=date("t");$i++)
{
    if ($tabmois[$i] == '1' )
    {
        $date = mktime(12, 0, 0, $mois, $i, $annee);
        //Pour un jour, je le fais 2 fois
        for ($j=1;$j<3;$j++)
        {
            if ($tabsemaine[0] > '0' && $tabsemaine[1] > '0' && $tabsemaine[2] > '0' && $tabsemaine[3] > '0')
            {
                for ($cpt=0;$cpt<$nb;$cpt++)
                {
                    $tabsemaine[$cpt]='0';
                }
            }
            $ok = '0';
            if ($j == '1')
            {
                $am = '1';
                $evtidam = '7';
                $pm = '0';
                $evtidpm = '';
            }
            else
            {
                $am = '0';
                $evtidam = '';
                $pm = '1';
                $evtidpm = '7';
            }

            //La manip : je me retrouve avec un tableau contenant le crédit d'inters par agents (ex : $tabinter[11,10,10,11] )
            //A chaque fois que je pioche un id agent, je décrémente son crédit.

            //Ya une couille là => boucle infinie par moment x_x
            while ($ok == '0')
            {
                $agent = mt_rand('0',$nb-1);

                if ($tabsemaine[$agent] < '1')
                {
                    $sql = "SELECT * FROM " . TMPINTER . " WHERE date = '".$date."' AND intervenantid='".$tabagent[$agent]."'";
                    if( !$result = $db->query($sql) )
                    {
                        message(ERROR, 'Impossible de lire les informations', __FILE__, __LINE__, $sql);
                    }
                    $ligne = $db->fetch_array($result);
                    //if ($tabinter[$agent] > '0')
                    //{
                        //Vincent est pas d'inter le matin :p => MCSTN
                        if (!($tabagent[$agent] == '4' && $am == '1'))
                        {
                            if ($db->num_rows($result) == '0')
                            {
                                $ok = '1';
                            }
                            elseif ((($ligne['am'] == '1' && $ligne['evtidam'] != '7') || ($ligne['pm'] == '1' && $ligne['evtidpm'] != '7')) && !($ligne['am'] == '1' && $ligne['pm'] == '1'))
                            {
                                $idinter = $ligne['idtmpintervention'];
                                if ($ligne['am'] == '1')
                                {
                                    $ok = 'pm';
                                }
                                else
                                {
                                    $ok = 'am';
                                }
                            }
                            elseif ($ligne['am'] == '1' && $ligne['pm'] == '1')
                            {
                                $tabsemaine[$agent]++;
                                if ($tabsemaine[0] > '0' && $tabsemaine[1] > '0' && $tabsemaine[2] > '0' && $tabsemaine[3] > '0')
                                {
                                    for ($cpt=0;$cpt<$nb;$cpt++)
                                    {
                                        $tabsemaine[$cpt]='0';
                                    }
                                }
                            }
                        }
                        else
                        {
                            $tabsemaine[$agent]++;
                            if ($tabsemaine[0] > '0' && $tabsemaine[1] > '0' && $tabsemaine[2] > '0' && $tabsemaine[3] > '0')
                            {
                                for ($cpt=0;$cpt<$nb;$cpt++)
                                {
                                    $tabsemaine[$cpt]='0';
                                }
                            }
                        }
                    //}
                }
            }

            $tabinter[$agent]--;
            $tabsemaine[$agent]++;
            if ($ok == '1')
            {
                $sql_insert = "INSERT INTO " . TMPINTER . " (date,am,pm,intervenantid,evtidam,evtidpm) VALUES ('".$date."','".$am."','".$pm."','".$tabagent[$agent]."','".$evtidam."','".$evtidpm."')";
                echo date("d/m/Y",$date).' : '.$sql_insert.'-----'.$tabinter[0].'-'.$tabinter[1].'-'.$tabinter[2].'-'.$tabinter[3].' /// '.$tabsemaine[0].'-'.$tabsemaine[1].'-'.$tabsemaine[2].'-'.$tabsemaine[3].'<br>';
                if( !$result = $db->query($sql_insert) )
                {
                    message(ERROR, 'Impossible d\'insérer dans la base', __FILE__, __LINE__, $sql_insert);
                }
            }
            else
            {
                if ($ok == 'pm')
                {
                    $sql_update = "UPDATE " . TMPINTER . " SET pm='1',evtidpm','".$tabagent[$agent]."','7') WHERE idtmpintervention='".$idinter."'";
                    echo date("d/m/Y",$date).' : '.$sql_update.'<br>';
                }
                else
                {
                    if ($ok == 'am')
                    {
                        $sql_update = "UPDATE " . TMPINTER . " SET am='1',evtidam','".$tabagent[$agent]."','7') WHERE idtmpintervention='".$idinter."'";
                        echo date("d/m/Y",$date).' : '.$sql_update.'<br>';
                    }
                }
            }
        }
    }
    else
    {
        //J'arrive à un week end => je remets mes compteurs semaine à 0
        for ($cpt=0;$cpt<$nb;$cpt++)
        {
            $tabsemaine[$cpt]='0';
        }
    }
}












?>