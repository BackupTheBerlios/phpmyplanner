<?php

############################################################## 
## Titre :      Intranet Racine
## Auteur :     Damie  Mickael
## Auteur bis :
## Version :    2.0
## Fichier :    index.php
############################################################## 
## Commentaires sur le fichier:
## Page d'accueil
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

$vararray = array('submit');

foreach( $vararray AS $varname )
{
    $$varname = ( isset($_POST[$varname]) ) ? true : false; 
}

$vararray = array('lstevent','lstagent','date','am','id','mode');

foreach( $vararray AS $varname )
{
    $$varname = ( !empty($_POST[$varname]) ) ? trim($_POST[$varname]) : ( ( !empty($_GET[$varname]) ) ? trim($_GET[$varname]) : '' );
}

include($int . 'start.php');

switch($mode)
{

case 'insert':

    if( $submit )
    {

        $tab1 = explode('/', $date );
        $date = mktime(12, 0, 0, $tab1[1], $tab1[0], $tab1[2]);

        if($am == 'am')
        {
          $am = 1;
          $pm = 0;
          $evtam = $lstevent;
          $evtpm = '';
        }
        elseif($am == 'pm')
        {
          $am = 0;
          $pm = 1;
          $evtam = '';
          $evtpm = $lstevent;
        }
        elseif($am == 'both')
        {
          $am = 1;
          $pm = 1;
          $evtam = $lstevent;
          $evtpm = $lstevent;
        }

        $sql = "SELECT idtmpintervention FROM " . TMPINTER . " WHERE date = '".$date."' AND am ='".$am."' AND pm ='".$pm."' AND intervenantid = '".$lstagent."' AND evtidam = '".$evtam."' AND evtidpm = '".$evtpm."'";
        if( !$result = $db->query($sql))
        {
            message(ERROR, 'Impossible de verifier les doublons', __FILE__, __LINE__, $sql);
        }

        if(!$db->num_rows($result))
        {
          $sql = "INSERT INTO " . TMPINTER . " (date,am,pm,intervenantid,evtidam,evtidpm) VALUES ('".$date."','".$am."','".$pm."', '".$lstagent."','".$evtam."','".$evtpm."')";

          if( !$db->query($sql) )
          {
             message(ERROR, 'Impossible de mettre à jour la base de données', __FILE__, __LINE__, $sql);
          }
                
          $meta = '<meta http-equiv="Refresh" content="5;url='.$_SERVER["PHP_SELF"].'?mode=insert">';
                
          $message  = 'Evénement planning ajouté avec succès';
          $message .= '<br /><br />' . sprintf($lang['insert']['retour'], '<a href="'.$_SERVER["PHP_SELF"].'?mode=insert">', '</a>');
          message(INFO, $message);
        }
        else
        {
          $meta = '<meta http-equiv="Refresh" content="2;url='.$_SERVER["PHP_SELF"].'?mode=insert">';
                
          $message  = 'L\'événement planning existe déjà, enregistrement refusé';
          $message .= '<br /><br />' . sprintf($lang['insert']['retour'], '<a href="'.$_SERVER["PHP_SELF"].'?mode=insert">', '</a>');
          message(INFO, $message);
        }
    }
    
    include($header);

    //mode affichage du formulaire
    $template -> set_filenames(array(
                'body' => 'insert_pla_body.tpl'
                )); 

    //selection des categories
    $preselectionne=array($id);

    $template -> assign_vars(array(
                'L_ENTETE'       => 'Ajouter un événement planning',
                'L_EXPLAIN'      => 'Tous les champs suivis d\'une étoile sont obligatoires',
                'L_AJOUT'        => $lang['Button']['insert'],
                'L_RESET'        => $lang['Button']['reset'],

                'L_DATE'         => $lang['insert']['date2'],
                'L_AMPM'         => $lang['insert']['ampm'],
                'L_AGENT'        => $lang['insert']['agent'],
                'L_EVENT'        => $lang['insert']['event'],

                'LSTAGENT'       => create_list("lstagent",AGENT,'idintervenant','nom','prenom',$_SESSION['idres'],'code'),
                'LSTEVENT'       => create_list("lstevent",EVENT,'idevenement','libevent','','','libevent'),
                'TRAITCHECK'     => 'checked',
                'F_ACTION'       => $_SERVER["PHP_SELF"].'?mode=insert',
                'F_ENCTYPE'      => 'enctype="multipart/form-data"'
                )); 

break;

default:

   echo 'place au calendrier';

break;

case 'update':

    if( $submit )
    {
        $tab1 = explode('/', $date );
        $date = mktime(12, 0, 0, $tab1[1], $tab1[0], $tab1[2]);

        if($am == 'am')
        {
          $am = 1;
          $pm = 0;
          $evtam = $lstevent;
          $evtpm = '';
        }
        elseif($am == 'pm')
        {
          $am = 0;
          $pm = 1;
          $evtam = '';
          $evtpm = $lstevent;
        }
        elseif($am == 'both')
        {
          $am = 1;
          $pm = 1;
          $evtam = $lstevent;
          $evtpm = $lstevent;
        }

        $sql = "UPDATE  " . TMPINTER . " SET date = '".$date."' , am = '".$am."' , pm = '".$pm."' , intervenantid = '".$lstagent."',evtidam = '".$evtam."',evtidpm = '".$evtpm."' WHERE idtmpintervention='".$id."'";

        if( !$db->query($sql) )
        {
             message(ERROR, 'Impossible de mettre à jour la base de données', __FILE__, __LINE__, $sql);
        }

        $meta = '<meta http-equiv="Refresh" content="2;url='.$_SERVER["PHP_SELF"].'">';
                
        $message  = 'Evénement planning modifié avec succès';
        $message .= '<br /><br />' . sprintf($lang['update']['retour'], '<a href="'.$_SERVER["PHP_SELF"].'">', '</a>');
        message(INFO, $message);
    }

    include($header);

    //mode affichage du formulaire
    $template -> set_filenames(array(
                'body' => 'insert_pla_body.tpl'
                )); 

    // Sélection de l'enregistrement
    $sql = "SELECT * FROM " . TMPINTER . "," . EVENT . "," . AGENT . "  WHERE " . AGENT . ".idintervenant = ". TMPINTER . ".intervenantid AND " . EVENT . ".idevenement = " . TMPINTER . ".evenementid AND idtmpintervention = '".$id."' ";

    if( !($result = $db->query($sql)) )
    {
        message(ERROR, 'Impossible de selectionner les dates d\'interventions', __FILE__, __LINE__, $sql);
    }

    if($db->num_rows($result))
    {
       $row = $db->fetch_array($result);

       //selection des categories
       $check = ($row['am'] == '1' && $row['pm'] == '0') ? 'checked' : '';
       $nockeck = ($row['pm'] == '1' && $row['am'] == '0')? 'checked': '';
       $nockeck2 = ($row['pm'] == '1' && $row['am'] == '1')? 'checked': '';

       $template -> assign_vars(array(
                'L_ENTETE'       => 'Modifier un événement planning',
                'L_EXPLAIN'      => 'Tous les champs suivis d\'une étoile sont obligatoires',
                'L_AJOUT'        => $lang['Button']['update'],
                'L_RESET'        => $lang['Button']['reset2'],

                'L_DATE'         => $lang['insert']['date2'],
                'L_AMPM'         => $lang['insert']['ampm'],
                'L_AGENT'        => $lang['insert']['agent'],
                'L_EVENT'        => $lang['insert']['event'],

                'LSTAGENT'       => create_list("lstagent",AGENT,'idintervenant','nom','prenom',$row['intervenantid'],'code'),
                'LSTEVENT'       => create_list("lstevent",EVENT,'idevenement','libevent','',$row['evenementid'],'libevent'),
                
                'DATE'           => make_date($row['date'],'date'),

                'TRAITCHECK'     => $check,
                'TRAITNOCHECK'   => $nockeck,
                'TRAITNOCHECK2'   => $nockeck2,

                'F_ACTION'       => $_SERVER["PHP_SELF"].'?mode=update&id='.$id,
                'F_ENCTYPE'      => 'enctype="multipart/form-data"',
                ));
    }
break;



}


$template->pparse('body');

include($footer);

$db -> free_result();
$db -> close_connexion();

?>