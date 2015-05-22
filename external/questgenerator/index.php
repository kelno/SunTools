<?php

require('../../dbconfig.php');

try {
    $handler = new PDO("mysql:host=sql31.free-h.org;port=3306; dbname=canardbd", "canardwc42", "barbecue42");
    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo $e->getMessage();
    die();
};

/*
CREATE TABLE `quest_generator` (
  `requests` longtext,
  `time` int(11) NOT NULL
) 
*/
header('Content-Type: text/html; charset=utf-8');

if(isset($_POST['id']))                             $id                             = htmlspecialchars($_POST['id']);
if(isset($_POST['minlvl']))                         $minlvl                         = htmlspecialchars($_POST['minlvl']);
if(isset($_POST['questlvl']))                       $questlvl                       = htmlspecialchars($_POST['questlvl']);
if(isset($_POST['type']))                           $type                           = htmlspecialchars($_POST['type']);
if(isset($_POST['races']))                          $races                          = htmlspecialchars($_POST['races']);
if(isset($_POST['flag_sharable']))                  $flag_sharable                  = htmlspecialchars($_POST['flag_sharable']);
if(isset($_POST['flag_hide_rewards']))              $flag_hide_rewards              = htmlspecialchars($_POST['flag_hide_rewards']);
if(isset($_POST['flag_daily']))                     $flag_daily                     = htmlspecialchars($_POST['flag_daily']);
if(isset($_POST['prevquestid']))                    $prevquestid                    = htmlspecialchars($_POST['prevquestid']);
if(isset($_POST['nextquestid']))                    $nextquestid                    = htmlspecialchars($_POST['nextquestid']);
if(isset($_POST['srcitemid']))                      $srcitemid                      = htmlspecialchars($_POST['srcitemid']);
if(isset($_POST['srcitemcount']))                   $srcitemcount                   = htmlspecialchars($_POST['srcitemcount']);
if(isset($_POST['srcspell']))                       $srcspell                       = htmlspecialchars($_POST['srcspell']);
if(isset($_POST['title']))                          $title                          = htmlspecialchars($_POST['title']);
if(isset($_POST['details']))                        $details                        = htmlspecialchars($_POST['details']);
if(isset($_POST['objectives']))                     $objectives                     = htmlspecialchars($_POST['objectives']);
if(isset($_POST['rewardtext']))                     $rewardtext                     = htmlspecialchars($_POST['rewardtext']);
if(isset($_POST['reqitemstext']))                   $reqitemstext                   = htmlspecialchars($_POST['reqitemstext']);
if(isset($_POST['endtext']))                        $endtext                        = htmlspecialchars($_POST['endtext']);
if(isset($_POST['reqitem1']))                       $reqitem1                       = htmlspecialchars($_POST['reqitem1']);
if(isset($_POST['reqitem1count']))                  $reqitem1count                  = htmlspecialchars($_POST['reqitem1count']);
if(isset($_POST['reqitem2']))                       $reqitem2                       = htmlspecialchars($_POST['reqitem2']);
if(isset($_POST['reqitem2count']))                  $reqitem2count                  = htmlspecialchars($_POST['reqitem2count']);
if(isset($_POST['reqitem3']))                       $reqitem3                       = htmlspecialchars($_POST['reqitem3']);
if(isset($_POST['reqitem3count']))                  $reqitem3count                  = htmlspecialchars($_POST['reqitem3count']);
if(isset($_POST['reqitem4']))                       $reqitem4                       = htmlspecialchars($_POST['reqitem4']);
if(isset($_POST['reqitem4count']))                  $reqitem4count                  = htmlspecialchars($_POST['reqitem4count']);
if(isset($_POST['reqcreature1']))                   $reqcreature1                   = htmlspecialchars($_POST['reqcreature1']);
if(isset($_POST['reqcreature1count']))              $reqcreature1count              = htmlspecialchars($_POST['reqcreature1count']);
if(isset($_POST['reqcreature2']))                   $reqcreature2                   = htmlspecialchars($_POST['reqcreature2']);
if(isset($_POST['reqcreature2count']))              $reqcreature2count              = htmlspecialchars($_POST['reqcreature2count']);
if(isset($_POST['reqcreature3']))                   $reqcreature3                   = htmlspecialchars($_POST['reqcreature3']);
if(isset($_POST['reqcreature3count']))              $reqcreature3count              = htmlspecialchars($_POST['reqcreature3count']);
if(isset($_POST['reqcreature4']))                   $reqcreature4                   = htmlspecialchars($_POST['reqcreature4']);
if(isset($_POST['reqcreature4count']))              $reqcreature4count              = htmlspecialchars($_POST['reqcreature4count']);
if(isset($_POST['rewchoiceitem1']))                 $rewchoiceitem1                 = htmlspecialchars($_POST['rewchoiceitem1']);
if(isset($_POST['rewchoiceitem1count']))            $rewchoiceitem1count            = htmlspecialchars($_POST['rewchoiceitem1count']);
if(isset($_POST['rewchoiceitem2']))                 $rewchoiceitem2                 = htmlspecialchars($_POST['rewchoiceitem2']);
if(isset($_POST['rewchoiceitem2count']))            $rewchoiceitem2count            = htmlspecialchars($_POST['rewchoiceitem2count']);
if(isset($_POST['rewchoiceitem3']))                 $rewchoiceitem3                 = htmlspecialchars($_POST['rewchoiceitem3']);
if(isset($_POST['rewchoiceitem3count']))            $rewchoiceitem3count            = htmlspecialchars($_POST['rewchoiceitem3count']);
if(isset($_POST['rewchoiceitem4']))                 $rewchoiceitem4                 = htmlspecialchars($_POST['rewchoiceitem4']);
if(isset($_POST['rewchoiceitem4count']))            $rewchoiceitem4count            = htmlspecialchars($_POST['rewchoiceitem4count']);
if(isset($_POST['rewchoiceitem5']))                 $rewchoiceitem5                 = htmlspecialchars($_POST['rewchoiceitem5']);
if(isset($_POST['rewchoiceitem5count']))            $rewchoiceitem5count            = htmlspecialchars($_POST['rewchoiceitem5count']);
if(isset($_POST['rewchoiceitem6']))                 $rewchoiceitem6                 = htmlspecialchars($_POST['rewchoiceitem6']);
if(isset($_POST['rewchoiceitem6count']))            $rewchoiceitem6count            = htmlspecialchars($_POST['rewchoiceitem6count']);
if(isset($_POST['rewitem1']))                       $rewitem1                       = htmlspecialchars($_POST['rewitem1']);
if(isset($_POST['rewitem1count']))                  $rewitem1count                  = htmlspecialchars($_POST['rewitem1count']);
if(isset($_POST['rewitem2']))                       $rewitem2                       = htmlspecialchars($_POST['rewitem2']);
if(isset($_POST['rewitem2count']))                  $rewitem2count                  = htmlspecialchars($_POST['rewitem2count']);
if(isset($_POST['rewitem3']))                       $rewitem3                       = htmlspecialchars($_POST['rewitem3']);
if(isset($_POST['rewitem3count']))                  $rewitem3count                  = htmlspecialchars($_POST['rewitem3count']);
if(isset($_POST['rewitem4']))                       $rewitem4                       = htmlspecialchars($_POST['rewitem4']);
if(isset($_POST['rewitem4count']))                  $rewitem4count                  = htmlspecialchars($_POST['rewitem4count']);
if(isset($_POST['rewfaction1']))                    $rewfaction1                    = htmlspecialchars($_POST['rewfaction1']);
if(isset($_POST['rewfactionvalue1']))               $rewfactionvalue1               = htmlspecialchars($_POST['rewfactionvalue1']);
if(isset($_POST['rewfaction2']))                    $rewfaction2                    = htmlspecialchars($_POST['rewfaction2']);
if(isset($_POST['rewfactionvalue2']))               $rewfactionvalue2               = htmlspecialchars($_POST['rewfactionvalue2']);
if(isset($_POST['rewfaction3']))                    $rewfaction3                    = htmlspecialchars($_POST['rewfaction3']);
if(isset($_POST['rewfactionvalue3']))               $rewfactionvalue3               = htmlspecialchars($_POST['rewfactionvalue3']);
if(isset($_POST['rewfaction4']))                    $rewfaction4                    = htmlspecialchars($_POST['rewfaction4']);
if(isset($_POST['rewfactionvalue4']))               $rewfactionvalue4               = htmlspecialchars($_POST['rewfactionvalue4']);
if(isset($_POST['rewfaction5']))                    $rewfaction5                    = htmlspecialchars($_POST['rewfaction5']);
if(isset($_POST['rewfactionvalue5']))               $rewfactionvalue5               = htmlspecialchars($_POST['rewfactionvalue5']);
if(isset($_POST['rewspellcast']))                   $rewspellcast                   = htmlspecialchars($_POST['rewspellcast']);
if(isset($_POST['rewmoney']))                       $rewmoney                       = htmlspecialchars($_POST['rewmoney']);
if(isset($_POST['rewhonorkill']))                   $rewhonorkill                   = htmlspecialchars($_POST['rewhonorkill']);
if(isset($_POST['questgiverid']))                   $questgiverid                   = htmlspecialchars($_POST['questgiverid']);
if(isset($_POST['questgiver_eraseotherquests']))    $questgiver_eraseotherquests    = htmlspecialchars($_POST['questgiver_eraseotherquests']);
if(isset($_POST['questtakerid']))                   $questtakerid                   = htmlspecialchars($_POST['questtakerid']);
if(isset($_POST['questreceiver_eraseotherquests'])) $questreceiver_eraseotherquests = htmlspecialchars($_POST['questreceiver_eraseotherquests']);

if (!isset($id)) {
	//formulaire
	include('qg.php');
} else {
    $flags = 0;
    if($flag_sharable)
        $flags = $flags + 0x08;
    if($flag_hide_rewards)
        $flags = $flags + 0x200;
    if($flag_daily)
        $flags = $flags + 0x1000;

    $money = $rewmoney * 10000 / 2;

    echo "<h1>Resultat :</h1>";
    echo "(oui c'est du code c'est voulu, c'est ce qu'il faut c/c)<br><br>";
    $str = '#'.$title." \n" ;
    $str .= "replace into `quest_template` (`entry`, `Method`, `ZoneOrSort`, `SkillOrClass`, `MinLevel`, `QuestLevel`, `Type`, `RequiredRaces`, `RequiredSkillValue`, `RepObjectiveFaction`, `RepObjectiveValue`, `RequiredMinRepFaction`, `RequiredMinRepValue`, `RequiredMaxRepFaction`, `RequiredMaxRepValue`, `SuggestedPlayers`, `LimitTime`, `QuestFlags`, `SpecialFlags`, `CharTitleId`, `PrevQuestId`, `NextQuestId`, `ExclusiveGroup`, `NextQuestInChain`, `SrcItemId`, `SrcItemCount`, `SrcSpell`, `Title`, `Details`, `Objectives`, `OfferRewardText`, `RequestItemsText`, `EndText`, `ObjectiveText1`, `ObjectiveText2`, `ObjectiveText3`, `ObjectiveText4`, `ReqItemId1`, `ReqItemId2`, `ReqItemId3`, `ReqItemId4`, `ReqItemCount1`, `ReqItemCount2`, `ReqItemCount3`, `ReqItemCount4`, `ReqSourceId1`, `ReqSourceId2`, `ReqSourceId3`, `ReqSourceId4`, `ReqSourceCount1`, `ReqSourceCount2`, `ReqSourceCount3`, `ReqSourceCount4`, `ReqSourceRef1`, `ReqSourceRef2`, `ReqSourceRef3`, `ReqSourceRef4`, `ReqCreatureOrGOId1`, `ReqCreatureOrGOId2`, `ReqCreatureOrGOId3`, `ReqCreatureOrGOId4`, `ReqCreatureOrGOCount1`, `ReqCreatureOrGOCount2`, `ReqCreatureOrGOCount3`, `ReqCreatureOrGOCount4`, `ReqSpellCast1`, `ReqSpellCast2`, `ReqSpellCast3`, `ReqSpellCast4`, `RewChoiceItemId1`, `RewChoiceItemId2`, `RewChoiceItemId3`, `RewChoiceItemId4`, `RewChoiceItemId5`, `RewChoiceItemId6`, `RewChoiceItemCount1`, `RewChoiceItemCount2`, `RewChoiceItemCount3`, `RewChoiceItemCount4`, `RewChoiceItemCount5`, `RewChoiceItemCount6`, `RewItemId1`, `RewItemId2`, `RewItemId3`, `RewItemId4`, `RewItemCount1`, `RewItemCount2`, `RewItemCount3`, `RewItemCount4`, `RewRepFaction1`, `RewRepFaction2`, `RewRepFaction3`, `RewRepFaction4`, `RewRepFaction5`, `RewRepValue1`, `RewRepValue2`, `RewRepValue3`, `RewRepValue4`, `RewRepValue5`, `RewHonorableKills`, `RewOrReqMoney`, `RewMoneyMaxLevel`, `RewSpell`, `RewSpellCast`, `RewMailTemplateId`, `RewMailDelaySecs`, `PointMapId`, `PointX`, `PointY`, `PointOpt`, `DetailsEmote1`, `DetailsEmote2`, `DetailsEmote3`, `DetailsEmote4`, `IncompleteEmote`, `CompleteEmote`, `OfferRewardEmote1`, `OfferRewardEmote2`, `OfferRewardEmote3`, `OfferRewardEmote4`, `StartScript`, `CompleteScript`) values('$id','2','-284','0','$minlvl','$questlvl','$type','$races','0','0','0','0','0','0','0','0','0','$flags','0','0','$prevquestid','$nextquestid','0','$nextquestid','$srcitemid','$srcitemcount','$srcspell','$title','$details','$objectives','$rewardtext','$reqitemstext','$endtext','','','','','$reqitem1','$reqitem2','$reqitem3','$reqitem4','$reqitem1count','$reqitem2count','$reqitem3count','$reqitem4count','','','','','','','','','','','','','$reqcreature1','$reqcreature2','$reqcreature3','$reqcreature4','$reqcreature1count','$reqcreature2count','$reqcreature3count','$reqcreature4count','0','0','0','0','$rewchoiceitem1','$rewchoiceitem2','$rewchoiceitem3','$rewchoiceitem4','$rewchoiceitem5','$rewchoiceitem6','$rewchoiceitem1count','$rewchoiceitem2count','$rewchoiceitem3count','$rewchoiceitem4count','$rewchoiceitem5count','$rewchoiceitem6count','$rewitem1','$rewitem2','$rewitem3','$rewitem4','$rewitem1count','$rewitem2count','$rewitem3count','$rewitem4count','$rewfaction1','$rewfaction2','$rewfaction3','$rewfaction4','$rewfaction5','$rewfactionvalue1','$rewfactionvalue2','$rewfactionvalue3','$rewfactionvalue4','$rewfactionvalue5','$rewhonorkill','$money','0','0','$rewspellcast','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0');";

    if($questgiverid)
    {
        if($questgiver_eraseotherquests)
            $str .= "\ndelete from `creature_questrelation` where id = $questgiverid;";

        $str .= "\nreplace into `creature_questrelation` values ($questgiverid,$id);";
    }
    if($questtakerid)
    {
        if($questreceiver_eraseotherquests)
            $str .= "\ndelete from `creature_involvedrelation` where id = $questtakerid;";

        $str .= "\nreplace into `creature_involvedrelation` values ($questtakerid,$id);";
    }

    $date = new DateTime();
    $query = $handler->prepare("INSERT INTO quest_generator (requests,time) VALUES (:str, :date)");
    $query->bindValue(':str', $str, PDO::PARAM_INT);
    $query->bindValue(':date', $date->getTimestamp(), PDO::PARAM_STR);

    $str = str_replace("\n", "<br>", $str);

    echo '<FONT COLOR="CC00FF">'. $str . '</FONT>';

}