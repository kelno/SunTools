<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Commands</title>
		<link rel="stylesheet" href="../../lib/jquery/css/jquery.dataTables.css">
		<link rel="stylesheet" href="../../lib/bootstrap/css/bootstrap.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="../../lib/jquery/jquery-1.11.2.min.js"></script>
		<script src="../../lib/jquery/jquery.dataTables.js"></script>
	</head>
	<body>
        <div class="fluid-container">
		  <table id="table" class="table table-hover">
		      <thead>
                  <tr>
                      <td width="5%"><strong>Value</strong></td>
                      <td width="21%"><strong>Event</strong></td>
                      <td width="12%"><strong>Param1</strong></td>
                      <td width="12%"><strong>Param2</strong></td>
                      <td width="12%"><strong>Param3</strong></td>
                      <td width="12%"><strong>Param4</strong></td>
                      <td width="26%"><strong>Comment</strong></td>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <td>0</td>
                      <td>EVENT_UPDATE_IC</td>
                      <td>InitialMin</td>
                      <td>InitialMax</td>
                      <td>RepeatMin</td>
                      <td>RepeatMax</td>
                      <td>En combat</td>
                  </tr>
                  <tr>
                      <td>1</td>
                      <td>EVENT_UPDATE_OOC</td>
                      <td>InitialMin</td>
                      <td>InitialMax</td>
                      <td>RepeatMin</td>
                      <td>RepeatMax</td>
                      <td>Hors combat</td>
                  </tr>
                  <tr>
                      <td>2</td>
                      <td>EVENT_HEALT_PCT</td>
                      <td>HPMin%</td>
                      <td>HPMax%</td>
                      <td>RepeatMin</td>
                      <td>RepeatMax</td>
                      <td>Health Percentage</td>
                  </tr>
                  <tr>
                      <td>3</td>
                      <td>EVENT_MANA_PCT</td>
                      <td>ManaMin%</td>
                      <td>ManaMax%</td>
                      <td>RepeatMin</td>
                      <td>RepeatMax</td>
                      <td>Mana Percentage</td>
                  </tr>
                  <tr>
                      <td>4</td>
                      <td>EVENT_AGGRO</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>A l'aggro</td>
                  </tr>
                  <tr>
                      <td>5</td>
                      <td>EVENT_KILL</td>
                      <td>CooldownMin</td>
                      <td>CooldownMax</td>
                      <td>Player only (0/1)</td>
                      <td>Creature ID (si Param3 = 0)</td>
                      <td>Au kill d'une creature</td>
                  </tr>
                  <tr>
                      <td>6</td>
                      <td>EVENT_DEATH</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>A la mort</td>
                  </tr>
                  <tr>
                      <td>7</td>
                      <td>EVENT_EVADE</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>A l'évitement</td>
                  </tr>
                  <tr>
                      <td>8</td>
                      <td>EVENT_SPELLHIT</td>
                      <td>SpellID</td>
                      <td>School</td>
                      <td>CooldownMin</td>
                      <td>CooldownMax</td>
                      <td>Quand touché par un sort</td>
                  </tr>
                  <tr>
                      <td>9</td>
                      <td>EVENT_RANGE</td>
                      <td>MinDist</td>
                      <td>MaxDist</td>
                      <td>RepeatMin</td>
                      <td>RepeatMax</td>
                      <td>Quand la Target est dans la range</td>
                  </tr>
                  <tr>
                      <td>10</td>
                      <td>EVENT_OOC_LOS</td>
                      <td>NoHostile</td>
                      <td>MaxRange</td>
                      <td>CooldownMin</td>
                      <td>CooldownMax</td>
                      <td>Quand la Target est hors combat</td>
                  </tr>
                  <tr>
                      <td>11</td>
                      <td>EVENT_RESPAWN</td>
                      <td>type</td>
                      <td>MapId</td>
                      <td>ZoneId</td>
                      <td></td>
                      <td>Au respawn</td>
                  </tr>
                  <tr>
                      <td>12</td>
                      <td>EVENT_TARGET_HEALTH_PCT</td>
                      <td>HPMin%</td>
                      <td>HPMax%</td>
                      <td>RepeatMin</td>
                      <td>RepeatMax</td>
                      <td>En fonction des HP de la Target</td>
                  </tr>
                  <tr>
                      <td>13</td>
                      <td>EVENT_VICTIM_CASTING</td>
                      <td>RepeatMin</td>
                      <td>RepeatMax</td>
                      <td>Spell id (0 = n'importe)</td>
                      <td></td>
                      <td>Quand TARGET_VICTIM incante un sort</td>
                  </tr>
                  <tr>
                      <td>14</td>
                      <td>EVENT_FRIENDLY_HEALTH</td>
                      <td>HPDeficit</td>
                      <td>Radius</td>
                      <td>RepeatMin</td>
                      <td>RepeatMax</td>
                      <td>En fonction du déficit d'HP d'un allié</td>
                  </tr>
                  <tr>
                      <td>15</td>
                      <td>EVENT_FRIENDLY_IS_CC</td>
                      <td>Radius</td>
                      <td>RepeatMin</td>
                      <td>RepeatMax</td>
                      <td></td>
                      <td>Quand un allié est CC</td>
                  </tr>
                  <tr>
                      <td>16</td>
                      <td>EVENT_FRIENDLY_MISSING_BUFF</td>
                      <td>SpellId</td>
                      <td>Radius</td>
                      <td>RepeatMin</td>
                      <td>RepeatMax</td>
                      <td>Quand il manque un buff à un allié</td>
                  </tr>
                  <tr>
                      <td>17</td>
                      <td>EVENT_SUMMONED_UNIT</td>
                      <td>Creature ID (0 = tous)</td>
                      <td>CooldownMin</td>
                      <td>CooldownMax</td>
                      <td></td>
                      <td>A l'invocation d'une creature</td>
                  </tr>
                  <tr>
                      <td>18</td>
                      <td>EVENT_TARGET_MANA_PCT</td>
                      <td>ManaMin%</td>
                      <td>ManaMax%</td>
                      <td>RepeatMin</td>
                      <td>RepeatMax</td>
                      <td>En fonction du mana de la Target</td>
                  </tr>
                  <tr>
                      <td>19</td>
                      <td>EVENT_ACCEPTED_QUEST</td>
                      <td>QuestID (0 = n'importe)</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>A l'acceptation de quête</td>
                  </tr>
                  <tr>
                      <td>20</td>
                      <td>EVENT_REWARD_QUEST</td>
                      <td>QuestID (0 = n'importe)</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>A la récompense de quête</td>
                  </tr>
                  <tr>
                      <td>21</td>
                      <td>EVENT_REACHED_HOME</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Au retour de son point initial</td>
                  </tr>
                  <tr>
                      <td>22</td>
                      <td>EVENT_RECEIVE_EMOTE</td>
                      <td>Emote ID</td>
                      <td>CooldownMin</td>
                      <td>CooldownMax</td>
                      <td>Condition</td>
                      <td>A la réception d'une emote</td>
                  </tr>
                  <tr>
                      <td>23</td>
                      <td>EVENT_HAS_AURA</td>
                      <td>SpellID</td>
                      <td>Stacks</td>
                      <td>RepeatMin</td>
                      <td>RepeatMax</td>
                      <td>Quand on a l'aura</td>
                  </tr>
                  <tr>
                      <td>24</td>
                      <td>EVENT_TARGET_BUFFED</td>
                      <td>SpellID</td>
                      <td>Stacks</td>
                      <td>RepeatMin</td>
                      <td>RepeatMax</td>
                      <td>Quand la Target est buff par ce spell</td>
                  </tr>
                  <tr>
                      <td>25</td>
                      <td>EVENT_RESET</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>En quittant un combat, au respawn, au spawn</td>
                  </tr>
                  <tr>
                      <td>26</td>
                      <td>EVENT_IC_LOS</td>
                      <td>NoHostile</td>
                      <td>MaxRange</td>
                      <td>CooldownMin</td>
                      <td>CooldownMax</td>
                      <td>Quand la Target dans la MaxRange est en combat</td>
                  </tr>
                  <tr>
                      <td>27</td>
                      <td>EVENT_PASSENGER_BOARDED</td>
                      <td>CooldownMin</td>
                      <td>CooldownMax</td>
                      <td></td>
                      <td></td>
                      <td></td>
                  </tr>
                  <tr>
                      <td>28</td>
                      <td>EVENT_PASSENGER_REMOVED</td>
                      <td>CooldownMin</td>
                      <td>CooldownMax</td>
                      <td></td>
                      <td></td>
                      <td></td>
                  </tr>
                  <tr>
                      <td>29</td>
                      <td>EVENT_CHARMED</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Quand on est charmé</td>
                  </tr>
                  <tr>
                      <td>30</td>
                      <td>EVENT_CHARMED_TARGET</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Quand la Target est charmée</td>
                  </tr>
                  <tr>
                      <td>31</td>
                      <td>EVENT_SPELLHIT_TARGET</td>
                      <td>SpellId</td>
                      <td>School</td>
                      <td>RepeatMin</td>
                      <td>RepeatMax</td>
                      <td>Quand la Target est touchée par le sort</td>
                  </tr>
                  <tr>
                      <td>32</td>
                      <td>EVENT_DAMAGED</td>
                      <td>MinDmg</td>
                      <td>MaxDmg</td>
                      <td>RepeatMin</td>
                      <td>RepeatMax</td>
                      <td>Quand on reçoit des dégâts</td>
                  </tr>
                  <tr>
                      <td>33</td>
                      <td>EVENT_DAMAGED_TARGET</td>
                      <td>MinDmg</td>
                      <td>MaxDmg</td>
                      <td>RepeatMin</td>
                      <td>RepeatMax</td>
                      <td>Quand la Target reçoit des dégâts</td>
                  </tr>
                  <tr>
                      <td>34</td>
                      <td>EVENT_MOVEMENTINFORM</td>
                      <td>MovementType (any)</td>
                      <td>PointID</td>
                      <td></td>
                      <td></td>
                      <td>Au mouvement. Utile quand on veut que la creature fasse quelque chose après avoir bougé à un certain point en utilisant SMART_ACTION_MOVE_TO.</td>
                  </tr>
                  <tr>
                      <td>35</td>
                      <td>EVENT_SUMMON_DESPAWNED</td>
                      <td>Entry</td>
                      <td>CooldownMin</td>
                      <td>CooldownMax</td>
                      <td></td>
                      <td>Quand l'invocation despawn</td>
                  </tr>
                  <tr>
                      <td>36</td>
                      <td>EVENT_CORPSE_REMOVED</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Quand le cadavre disparait</td>
                  </tr>
                  <tr>
                      <td>37</td>
                      <td>EVENT_AI_INIT</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>A l'initialisation de l'AI donc quand la creature spawn (pas quand ça respawn, reset ou évite).</td>
                  </tr>
                  <tr>
                      <td>38</td>
                      <td>EVENT_DATA_SET</td>
                      <td>Field</td>
                      <td>Value</td>
                      <td>CooldownMin</td>
                      <td>CooldownMax</td>
                      <td>Se déclenche dès qu'une SMART_ACTION_SET_DATA est appelée.</td>
                  </tr>
                  <tr>
                      <td>39</td>
                      <td>EVENT_WAYPOINT_START</td>
                      <td>PointId (0 = n'importe)</td>
                      <td>pathId (0 = n'importe)</td>
                      <td></td>
                      <td></td>
                      <td>Au départ du Waypoint ID</td>
                  </tr>
                  <tr>
                      <td>40</td>
                      <td>EVENT_WAYPOINT_REACHED</td>
                      <td>PointId (0 = n'importe)</td>
                      <td>pathId (0 = n'importe)</td>
                      <td></td>
                      <td></td>
                      <td>A l'arrivée du Waypoint ID</td>
                  </tr>
                  <tr>
                      <td>41</td>
                      <td>EVENT_TRANSPORT_ADDPLAYER</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                  </tr>
                  <tr>
                      <td>42</td>
                      <td>EVENT_TRANSPORT_ADDCREATURE</td>
                      <td>Entry (0 any)</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                  </tr>
                  <tr>
                      <td>43</td>
                      <td>EVENT_TRANSPORT_REMOVE_PLAYER</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                  </tr>
                  <tr>
                      <td>44</td>
                      <td>EVENT_TRANSPORT_RELOCATE</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                  </tr>
                  <tr>
                      <td>45</td>
                      <td>EVENT_INSTANCE_PLAYER_ENTER</td>
                      <td>Team (0 any)</td>
                      <td>CooldownMin</td>
                      <td>CooldownMax
</td>
                      <td></td>
                      <td></td>
                  </tr>
                  <tr>
                      <td>46</td>
                      <td>EVENT_AREATRIGGER_ONTRIGGER</td>
                      <td>TriggerId (0 any)</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Au déclenchement de l'Areatrigger</td>
                  </tr>
                  <tr>
                      <td>47</td>
                      <td>EVENT_QUEST_ACCEPTED</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>A l'acceptation de quête</td>
                  </tr>
                  <tr>
                      <td>48</td>
                      <td>EVENT_QUEST_OBJ_COPLETETION</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>A la complétion des objectifs de quête</td>
                  </tr>
                  <tr>
                      <td>49</td>
                      <td>EVENT_QUEST_COMPLETION</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>A la complétion de la quête</td>
                  </tr>
                  <tr>
                      <td>50</td>
                      <td>EVENT_QUEST_REWARDED</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>A la récompense de quête</td>
                  </tr>
                  <tr>
                      <td>51</td>
                      <td>EVENT_QUEST_FAIL</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>A l'échec de quête</td>
                  </tr>
                  <tr>
                      <td>52</td>
                      <td>EVENT_TEXT_OVER</td>
                      <td>GroupId (from creatue_text)</td>
                      <td>CreatureId (0 any)</td>
                      <td></td>
                      <td></td>
                      <td>Déclenché par SMART_ACTION_TALK. Quand la creature dit quelque chose et que ça affiche une bulle. L'event se déclenche quand le ballon disparait et donc que le texte se termine.</td>
                  </tr>
                  <tr>
                      <td>53</td>
                      <td>EVENT_RECEIVE_HEAL</td>
                      <td>Minimum Heal</td>
                      <td>Maximum Heal</td>
                      <td>CooldownMin</td>
                      <td>CooldownMax</td>
                      <td>A la réception d'une certaine quantité de heal </td>
                  </tr>
                  <tr>
                      <td>54</td>
                      <td>EVENT_JUST_SUMMONED</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>A l'invocation de la creature</td>
                  </tr>
                  <tr>
                      <td>55</td>
                      <td>EVENT_WAYPOINT_PAUSED</td>
                      <td>PointId (0 any)</td>
                      <td>pathID (0 any)</td>
                      <td></td>
                      <td></td>
                      <td>A la pause du waypoint</td>
                  </tr>
                  <tr>
                      <td>56</td>
                      <td>EVENT_WAYPOINT_RESUMED</td>
                      <td>PointId (0 any)</td>
                      <td>pathID (0 any)</td>
                      <td></td>
                      <td></td>
                      <td>A la reprise du waypoint</td>
                  </tr>
                  <tr>
                      <td>57</td>
                      <td>EVENT_WAYPOINT_STOPPED</td>
                      <td>PointId (0 any)</td>
                      <td>pathID (0 any)</td>
                      <td></td>
                      <td></td>
                      <td>Au stop du waypoint</td>
                  </tr>
                  <tr>
                      <td>58</td>
                      <td>EVENT_WAYPOINT_ENDED</td>
                      <td>PointId (0 any)</td>
                      <td>pathID (0 any)</td>
                      <td></td>
                      <td></td>
                      <td>A la fin du path</td>
                  </tr>
                  <tr>
                      <td>59</td>
                      <td>EVENT_TIMED_EVENT_TRIGGERED</td>
                      <td>Id</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Appelé quand un event est appelé par SMART_ACTION_CREATE_TIMED_EVENT est déclenché</td>
                  </tr>
                  <tr>
                      <td>60</td>
                      <td>EVENT_UPDATE</td>
                      <td>InitialMin</td>
                      <td>InitialMax</td>
                      <td>RepeatMin</td>
                      <td>RepeatMax</td>
                      <td>A la mise à jour, doit être utilisé comme un timer.
                      Basiquement, fonctionne comme EVENT_UPDATE_IC et EVENT_UPDATE_OOC en un.</td>
                  </tr>
                  <tr>
                      <td>61</td>
                      <td>EVENT_LINK</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Utilisé pour lié plusieurs events ensemble afin de former une chaîne d'events.</td>
                  </tr>
                  <tr>
                      <td>62</td>
                      <td>EVENT_GOSSIP_SELECT</td>
                      <td>Gossip menu id</td>
                      <td>Gossip item id</td>
                      <td></td>
                      <td></td>
                      <td>Déclenché quand on clique sur une option de gossip.
                          Le gossip est texte qui apparait quand on clic droit un PNJ donc une option de gossip c'est par exemple une petite bulle en dessous que le joueur doit cliquer pour avoir la suite de la conversation.</td>
                  </tr>
                  <tr>
                      <td>63</td>
                      <td>EVENT_JUST_CREATED</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Quand un gameobject spawn pour la première fois.</td>
                  </tr>
                  <tr>
                      <td>64</td>
                      <td>EVENT_GOSSIP_HELLO</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>A l'ouverture du gossip menu. Fonctionne aussi pour des gameobjects.</td>
                  </tr>
                  <tr>
                      <td>65</td>
                      <td>EVENT_FOLLOW_COMPLETED</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>A la fin/complétition d'un suivi.</td>
                  </tr>
                  <tr>
                      <td>66</td>
                      <td>EVENT_DUMMY_EFFECT</td>
                      <td>spellId</td>
                      <td>effectIndex</td>
                      <td></td>
                      <td></td>
                      <td></td>
                  </tr>
                  <tr>
                      <td>67</td>
                      <td>EVENT_IS_BEHIND_TARGET</td>
                      <td>CooldownMin</td>
                      <td>CooldownMax</td>
                      <td></td>
                      <td></td>
                      <td>Quand la creature est derrière la Target dans un certain interval.</td>
                  </tr>
                  <tr>
                      <td>68</td>
                      <td>EVENT_GAME_EVENT_START</td>
                      <td>Game event entry</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Au déclenchement du game event</td>
                  </tr>
                  <tr>
                      <td>69</td>
                      <td>EVENT_GAME_EVENT_END</td>
                      <td>Game event entry</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>A la fin du game event</td>
                  </tr>
                  <tr>
                      <td>70</td>
                      <td>EVENT_GO_STATE_CHANGED</td>
                      <td>Gameobject state</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Au changement d'état du gameobject.</td>
                  </tr>
                  <tr>
                      <td>71</td>
                      <td>EVENT_GO_EVENT_INFORM</td>
                      <td>EventId</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Déclenché quand le gameobject devient la Target d'un event en cours comme par exemple un bâtiment endommagé/détruit/reconstruit.</td>
                  </tr>
                  <tr>
                      <td>72</td>
                      <td>EVENT_ACTION_DONE</td>
                      <td>EventId</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Déclenché sur une certaine action id 'done'. Peut n'être appelé que depuis des scripts dans le core (SmartAI::DoAction).</td>
                  </tr>
                  <tr>
                      <td>73</td>
                      <td>EVENT_ON_SPELLCLICK</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Un truc pour une table en db qu'on a pas.</td>
                  </tr>
                  <tr>
                      <td>74</td>
                      <td>EVENT_FRIENDLY_HEALTH_PCT</td>
                      <td>HPMin%</td>
                      <td>HPMax%</td>
                      <td>RepeatMin</td>
                      <td>RepeatMax</td>
                      <td>Se déclenche quand un allié dans la range atteint un certain pourcentage d'HP.</td>
                  </tr>
                  <tr>
                      <td>75</td>
                      <td>EVENT_DISTANCE_CREATURE</td>
                      <td>Guid</td>
                      <td>Entry</td>
                      <td>Distance</td>
                      <td>Repeat Timer</td>
                      <td>Se déclenche quand une creature avec un guid ou entry spécifique entre dans la distance donnée.</td>
                  </tr>
                  <tr>
                      <td>76</td>
                      <td>EVENT_DISTANCE_GAMEOBJECT</td>
                      <td>Guid</td>
                      <td>Entry</td>
                      <td>Distance</td>
                      <td>Repeat Timer</td>
                      <td>Se déclenche quand un gameobject avec un guid ou entry spécifique entre dans la distance donnée.</td>
                  </tr>
                  <tr>
                      <td>100</td>
                      <td>EVENT_FRIENDLY_KILLED</td>
                      <td>maxRange</td>
                      <td>Guid</td>
                      <td>Entry</td>
                      <td></td>
                      <td>Se déclenche quand un allié avec le guid/entry donné meurt dans la maxRange donnée. (ma 60m)</td>
                  </tr>
              </tbody>
            </table>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#table').dataTable( {
                    "scrollY":        "calc(100vh - 68px)",
					"scrollCollapse": false,
					"paging":         false,
					"order": [[ 0, "asc" ]]
				} );
            } );
        </script>
    </body>
</html>
