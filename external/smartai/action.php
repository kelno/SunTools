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
                      <td width="2%"><strong>#</strong></td>
                      <td width="20%"><strong>Event</strong></td>
                      <td width="8%"><strong>Param1</strong></td>
                      <td width="8%"><strong>Param2</strong></td>
                      <td width="8%"><strong>Param3</strong></td>
                      <td width="8%"><strong>Param4</strong></td>
                      <td width="8%"><strong>Param5</strong></td>
                      <td width="8%"><strong>Param6</strong></td>
                      <td width="20%"><strong>Comment</strong></td>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <td>0</td>
                      <td>SMART_ACTION_NONE</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Ne fait rien.</td>
                  </tr>
                  <tr>
                      <td>1</td>
                      <td>SMART_ACTION_TALK</td>
                      <td>GroupId</td>
                      <td>Duration</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Dit un texte de GroupId</td>
                  </tr>
                  <tr>
                      <td>2</td>
                      <td>ACTION_SET_FACTION</td>
                      <td>FactionId</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Change la faction de la Target</td>
                  </tr>
                  <tr>
                      <td>3</td>
                      <td>ACTION_MORPH_TO_ENTRY_OR_MODEL</td>
                      <td>Creature entry</td>
                      <td>Creature model</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Morph la creature avec l'entry/model donné.<br />
                          Si les deux paramètres sont 0, la creature va demorph.</td>
                  </tr>
                  <tr>
                      <td>4</td>
                      <td>ACTION_SOUND</td>
                      <td>Sound id</td>
                      <td>Only to self (0/1)</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Joue un son</td>
                  </tr>
                  <tr>
                      <td>5</td>
                      <td>ACTION_PLAY_EMOTE</td>
                      <td>Emote id</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Joue l'emote</td>
                  </tr>
                  <tr>
                      <td>6</td>
                      <td>ACTION_FAIL_QUEST</td>
                      <td>Quest id</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Fait échouer la quête donnée de la Target</td>
                  </tr>
                  <tr>
                      <td>7</td>
                      <td>ACTION_ADD_QUEST</td>
                      <td>Quest id</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Ajoute la quête au journal de quête de la Target</td>
                  </tr>
                  <tr>
                      <td>8</td>
                      <td>ACTION_SET_REACT_STATE</td>
                      <td>React state</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Applique un état de réaction (0 = passif, 1 = défensif, 2 = aggressif)</td>
                  </tr>
                  <tr>
                      <td>9</td>
                      <td>ACTION_ACTIVATE_GOBJECT</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Active la Target gameobject</td>
                  </tr>
                  <tr>
                      <td>10</td>
                      <td>ACTION_RANDOM_EMOTE</td>
                      <td>Emote id 1</td>
                      <td>Emote id 2</td>
                      <td>Emote id 3</td>
                      <td>Emote id 4</td>
                      <td>Emote id 5</td>
                      <td>Emote id 6</td>
                      <td>Joue une emote aléatoire parmi les champs qui n'ont pas la valeur 0.</td>
                  </tr>
                  <tr>
                      <td>11</td>
                      <td>ACTION_CAST</td>
                      <td>Spell ID</td>
                      <td>Cast Flags</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Incante un sort sur la Target</td>
                  </tr>
                  <tr>
                      <td>12</td>
                      <td>ACTION_SUMMON_CREATURE</td>
                      <td>Creature entry</td>
                      <td>Summon type</td>
                      <td>Duration (ms)</td>
                      <td>Attack invoker (0/1)</td>
                      <td>Attack victim (0/1)</td>
                      <td></td>
                      <td>Invoque une creature avec l'entry donnée pour une durée limitée ou non, cela dépend du type de l'invocation.</td>
                  </tr>
                  <tr>
                      <td>13</td>
                      <td>ACTION_THREAT_SINGLE_PCT</td>
                      <td>Augmentation menace %</td>
                      <td>Baisse menace %</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Ajoute ou retire un certain pourcentage de menace à la Target. Un seul des paramètres ne peut être utilisé.</td>
                  </tr>
                  <tr>
                      <td>14</td>
                      <td>ACTION_THREAT_ALL_PCT</td>
                      <td>Augmentation menace %</td>
                      <td>Baisse menace %</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Ajoute ou retire un certain pourcentage de menace à toute la liste de menace.</td>
                  </tr>
                  <tr>
                      <td>15</td>
                      <td>ACTION_CALL_AREAEXPLOREDOREVENTHAPPENS</td>
                      <td>Quest id</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Complète un objectif de quête à la Target.</td>
                  </tr>
                  <tr>
                      <td>16</td>
                      <td>ACTION_UNUSED_16</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Inutilisé.</td>
                  </tr>
                  <tr>
                      <td>17</td>
                      <td>ACTION_SET_EMOTE_STATE</td>
                      <td>Emote id</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Applique un emote state à la Target.</td>
                  </tr>
                  <tr>
                      <td>18</td>
                      <td>ACTION_SET_UNIT_FLAG</td>
                      <td>Unit flags</td>
                      <td>Type (0/1)</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Applique l'unit flag à la Target.</td>
                  </tr>
                  <tr>
                      <td>19</td>
                      <td>ACTION_REMOVE_UNIT_FLAG</td>
                      <td>Unit flags</td>
                      <td>Type (0/1)</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Enlève l'unit flag à la Target.</td>
                  </tr>
                  <tr>
                      <td>20</td>
                      <td>ACTION_AUTO_ATTACK</td>
                      <td>Start or stop (0/1)</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Commence ou arrête d'attaquer la Target.</td>
                  </tr>
                  <tr>
                      <td>21</td>
                      <td>ACTION_ALLOW_COMBAT_MOVEMENT</td>
                      <td>Allow or disallow (0/1)</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Autorise ou non le mouvement quand la creature est en combat.</td>
                  </tr>
                  <tr>
                      <td>22</td>
                      <td>ACTION_SET_EVENT_PHASE</td>
                      <td>Phase index</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Donne une phase à la créature.</td>
                  </tr>
                  <tr>
                      <td>23</td>
                      <td>ACTION_INC_EVENT_PHASE</td>
                      <td>Increment</td>
                      <td>Decrement</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Incrémente ou décrémente la phase de la créature.</td>
                  </tr>
                  <tr>
                      <td>24</td>
                      <td>ACTION_EVADE</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Fait éviter la creature, la faisant arrêter d'attaquer et sortir de combat.</td>
                  </tr>
                  <tr>
                      <td>25</td>
                      <td>ACTION_FLEE_FOR_ASSIST</td>
                      <td>Say flee text (0/1)</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Fait fuire la créature cherchant de l'assitance dans les alliés aux alentours.</td>
                  </tr>
                  <tr>
                      <td>26</td>
                      <td>ACTION_CALL_GROUPEVENTHAPPENS</td>
                      <td>Quest id</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Complète un objectif de quête du joueur Target.</td>
                  </tr>
                  <tr>
                      <td>27</td>
                      <td>ACTION_CALL_CASTEDCREATUREORGO</td>
                      <td>Creature id</td>
                      <td>Spell id</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Complète un objectif de quête du joueur Target. Donne un kill credit pour le spellcast et le kill du monstre.</td>
                  </tr>
                  <tr>
                      <td>28</td>
                      <td>ACTION_REMOVEAURASFROMSPELL</td>
                      <td>Spell id</td>
                      <td>Charges</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Retire une aura de la Target.</td>
                  </tr>
                  <tr>
                      <td>29</td>
                      <td>ACTION_FOLLOW</td>
                      <td>Distance</td>
                      <td>Angle</td>
                      <td>End creature entry</td>
                      <td>Credit creature entry</td>
                      <td>Credit type (0/1)</td>
                      <td></td>
                      <td>La creature suit la Target a sur une distance et un angle donnés.</td>
                  </tr>
                  <tr>
                      <td>30</td>
                      <td>ACTION_RANDOM_PHASE</td>
                      <td>Phase index 1</td>
                      <td>Phase index 2</td>
                      <td>Phase index 3</td>
                      <td>Phase index 4</td>
                      <td>Phase index 5</td>
                      <td>Phase index 6</td>
                      <td>Passe la créature dans une phase aléatoire parmi les phases données.</td>
                  </tr>
                  <tr>
                      <td>31</td>
                      <td>ACTION_RANDOM_PHASE_RANGE</td>
                      <td>Phase index 1</td>
                      <td>Phase index 2</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Roll la phase de la creature entre les deux valeurs données.</td>
                  </tr>
                  <tr>
                      <td>32</td>
                      <td>ACTION_RESET_GOBJECT</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Réinitialise le gameobject, utilisé généralement pour ouvrir/fermer une porte. (calls GameObject::ResetDoorOrButton)</td>
                  </tr>
                  <tr>
                      <td>33</td>
                      <td>ACTION_CALL_KILLEDMONSTER</td>
                      <td>Creature entry</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Donne un kill credit à la Target.</td>
                  </tr>
                  <tr>
                      <td>34</td>
                      <td>ACTION_SET_INST_DATA</td>
                      <td>Field</td>
                      <td>Data</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Applique la valeur spécifiée au champ donné. Reçu et géré dans InstanceScript de l'instance.</td>
                  </tr>
                  <tr>
                      <td>35</td>
                      <td>ACTION_SET_INST_DATA64</td>
                      <td>Field</td>
                      <td>Data</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Applique la valeur spécifiée au champ donné. Reçu et géré dans InstanceScript de l'instance.</td>
                  </tr>
                  <tr>
                      <td>36</td>
                      <td>ACTION_UPDATE_TEMPLATE</td>
                      <td>Creature entry</td>
                      <td>Team</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Mets à jour le template de la creature donnée à un nouveau template, transformant complètement la creature.</td>
                  </tr>
                  <tr>
                      <td>37</td>
                      <td>ACTION_DIE</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Tue la Target.</td>
                  </tr>
                  <tr>
                      <td>38</td>
                      <td>ACTION_SET_IN_COMBAT_WITH_ZONE</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Mets la creature en combat avec sa zone. Utile pour les boss afin de mettre en combat tous les joueurs jusqu'à la fin du combat.</td>
                  </tr>
                  <tr>
                      <td>39</td>
                      <td>ACTION_CALL_FOR_HELP</td>
                      <td>Radius</td>
                      <td>Say text (0/1)</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>La creature appelle à l'aide ce qui aggro les ennemis proches pour venir l'assister.</td>
                  </tr>
                  <tr>
                      <td>40</td>
                      <td>ACTION_SET_SHEATH</td>
                      <td>Sheath state</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Détermine si les armes sont dégainées ou non. Détermine quelle arme est montrée sur le model.</td>
                  </tr>
                  <tr>
                      <td>41</td>
                      <td>ACTION_FORCE_DESPAWN</td>
                      <td>Time to despawn(ms)</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Fais disparaitre la creature ou gameobject au bout du temps donné.</td>
                  </tr>
                  <tr>
                      <td>42</td>
                      <td>ACTION_SET_INVINCIBILITY_HP_LEVEL</td>
                      <td>Flat value</td>
                      <td>% value</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Rend le mob invicible à valeur ou % donné. Seul un des deux paramètres doit être utilisé.</td>
                  </tr>
                  <tr>
                      <td>43</td>
                      <td>ACTION_MOUNT_TO_ENTRY_OR_MODEL</td>
                      <td>Creature entry</td>
                      <td>Creature model</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Applique le model de mount donné dans les paramètres. Seul un des deux paramètres peut être utilisé.</td>
                  </tr>
                  <tr>
                      <td>44</td>
                      <td>ACTION_SET_INGAME_PHASE_MASK</td>
                      <td>Phasemask</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Change le Phasemask de la creature, le réel phasemask pas celui de l'event.</td>
                  </tr>
                  <tr>
                      <td>45</td>
                      <td>ACTION_SET_DATA</td>
                      <td>Field</td>
                      <td>Data</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Appelle SMART_EVENT_DATA_SET avec les deux paramètres donnés, il est donc possible de communiqué entre deux creatures.</td>
                  </tr>
                  <tr>
                      <td>46</td>
                      <td>ACTION_MOVE_FORWARD</td>
                      <td>Distance (m)</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Bouge la creature en avant avec la distance donnée.</td>
                  </tr>
                  <tr>
                      <td>47</td>
                      <td>ACTION_SET_VISIBILITY</td>
                      <td>Visible (0/1)</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Change la visibilité de la creature ou gameobject.</td>
                  </tr>
                  <tr>
                      <td>48</td>
                      <td>ACTION_SET_ACTIVE</td>
                      <td>Active (0/1)</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Définit si la creature ou gameobject sont définits comme actif. Si définit en tant qu'actif, empêche la map où est le mob d'être déchargée.</td>
                  </tr>
                  <tr>
                      <td>49</td>
                      <td>ACTION_ATTACK_START</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Fais attaquer la creature le premier joueur de la Target list.</td>
                  </tr>
                  <tr>
                      <td>50</td>
                      <td>ACTION_SUMMON_GO</td>
                      <td>Gameobject entry</td>
                      <td>Duration (ms)</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Invoque un game object.</td>
                  </tr>
                  <tr>
                      <td>51</td>
                      <td>ACTION_KILL_UNIT</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Tue la cible instantanément.</td>
                  </tr>
                  <tr>
                      <td>52</td>
                      <td>ACTION_ACTIVATE_TAXI</td>
                      <td>Taxi id</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Active un taxi avec l'id donnée sur la cible.</td>
                  </tr>
                  <tr>
                      <td>53</td>
                      <td>ACTION_WP_START</td>
                      <td>Walk/run (0/1)</td>
                      <td>Waypoint entry</td>
                      <td>Repeat path (0/1)</td>
                      <td>Quest id</td>
                      <td>Despawn time after path</td>
                      <td>Reactstate</td>
                      <td>Démarre le waypoint dans la table world.waypoints.</td>
                  </tr>
                  <tr>
                      <td>54</td>
                      <td>ACTION_WP_PAUSE</td>
                      <td>Time (ms)</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Arrête momentanément le waypoint dans la table world.waypoints.</td>
                  </tr>
                  <tr>
                      <td>55</td>
                      <td>ACTION_WP_STOP</td>
                      <td>Despawn time (ms)</td>
                      <td>Quest id</td>
                      <td>Fail quest (0/1)</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Arrête le path que la creature suit. Permet de spécifier un temps de depop à la suite et de marquer une quête comme étant un échec.</td>
                  </tr>
                  <tr>
                      <td>56</td>
                      <td>ACTION_ADD_ITEM</td>
                      <td>Item entry</td>
                      <td>Count</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Ajoute un item donné pour un nombre donné à la cible.</td>
                  </tr>
                  <tr>
                      <td>57</td>
                      <td>ACTION_REMOVE_ITEM</td>
                      <td>Item entry</td>
                      <td>Count</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Retire un item donné pour un nombre donné à la cible.</td>
                  </tr>
                  <tr>
                      <td>58</td>
                      <td>ACTION_INSTALL_AI_TEMPLATE</td>
                      <td>Template entry</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Installe un template SmartAI ce qui est basiquement des scripts prédéfinis utilisés dans beaucoup de cas comme par exemple des casters, passifs, tourelles, etc.</td>
                  </tr>
                  <tr>
                      <td>59</td>
                      <td>ACTION_SET_RUN</td>
                      <td>Off/on (0/1)</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Fais courir ou non la créature.</td>
                  </tr>
                  <tr>
                      <td>60</td>
                      <td>ACTION_SET_FLY</td>
                      <td>Off/on (0/1)</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Fais voler ou non la créature.</td>
                  </tr>
                  <tr>
                      <td>61</td>
                      <td>ACTION_SET_SWIM</td>
                      <td>Off/on (0/1)</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Fais nager ou non la créature.</td>
                  </tr>
                  <tr>
                      <td>62</td>
                      <td>ACTION_TELEPORT</td>
                      <td>Map id</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Téléporte la cible sur la map donnée en utilisant les champs X/Y/Z/O de la cible. Ne pas utiliser SMART_TARGET_POSITION.</td>
                  </tr>
                  <tr>
                      <td>63</td>
                      <td>ACTION_UNUSED_63</td>
                      <td>Variable id</td>
                      <td>Decimal</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Stocke une variable décimale dans la variable id pour stocker l'information pour la creature.</td>
                  </tr>
                  <tr>
                      <td>64</td>
                      <td>ACTION_STORE_TARGET_LIST</td>
                      <td>Variable id</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Stocke la liste des cibles dans la variable id pour être lue plus tard.</td>
                  </tr>
                  <tr>
                      <td>65</td>
                      <td>ACTION_WP_RESUME</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Reprend le waypoint path que la creature suivait précédemment.</td>
                  </tr>
                  <tr>
                      <td>66</td>
                      <td>ACTION_SET_ORIENTATION</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Change l'orientation de la creature avec la valeur donnée. Il faut utiliser SMART_TARGET_POSITION.<br>
                      Pour que la creature soit orientée vers son spawn/home, il faut utiliser SMART_TARGET_SELF et laisser tous les paramètres à 0.</td>
                  </tr>
                  <tr>
                      <td>67</td>
                      <td>ACTION_CREATE_TIMED_EVENT</td>
                      <td>Event id</td>
                      <td>InitialMin</td>
                      <td>InitialMax</td>
                      <td>RepeatMin</td>
                      <td>RepeatMax</td>
                      <td>Chance</td>
                      <td>Appelle SMART_EVENT_UPDATE après un temps spécifique donné dans les paramètres.</td>
                  </tr>
                  <tr>
                      <td>68</td>
                      <td>ACTION_PLAYMOVIE</td>
                      <td>Movie entry</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Lance la video avec l'entry donnée.</td>
                  </tr>
                  <tr>
                      <td>69</td>
                      <td>ACTION_MOVE_TO_POS</td>
                      <td>Point id (0 any)</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Bouge jusqu'à la position donnée en utilisant les champs de coordonnées de la cible avec SMART_TARGET_POSITION. Le premier paramètre est l'id qui peut être lue avec SMART_EVENT_MOVEMENTINFORM.</td>
                  </tr>
                  <tr>
                      <td>70</td>
                      <td>ACTION_RESPAWN_TARGET</td>
                      <td>Respawn time (s)</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Respawn la cible. Ne fonctionne que sur des cibles game object. L'action ne respawn pas vraiment la cible, ça fixe le temps de respawn sur la cible mais c'est comme ça que le respawn de game object est géré.</td>
                  </tr>
                  <tr>
                      <td>71</td>
                      <td>ACTION_EQUIP</td>
                      <td>Equip template entry</td>
                      <td>Slotmask</td>
                      <td>Item entry 1</td>
                      <td>Item entry 2</td>
                      <td>Item entry 3</td>
                      <td></td>
                      <td>Change l'équipement de la creature à l'entry donnée. Si aucune entry n'est donnée, ça va utiliser les 3 items entries données. Le premier est la main droite, le second la main gauche et le 3e relique/arc...<br>
                      Slotmask marche en bits (1,2,4) et permet d'afficher les armes données dans item entry.</td>
                  </tr>
                  <tr>
                      <td>72</td>
                      <td>ACTION_CLOSE_GOSSIP</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Ferme le gossip au joueur.</td>
                  </tr>
                  <tr>
                      <td>73</td>
                      <td>ACTION_TRIGGER_TIMED_EVENT</td>
                      <td>Event id</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Appelle SMART_EVENT_TIMED_EVENT_TRIGGERED avec l'id donnée.</td>
                  </tr>
                  <tr>
                      <td>74</td>
                      <td>ACTION_REMOVE_TIMED_EVENT</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Interrompt le timed event appelé depuis SMART_EVENT_TIMED_EVENT_TRIGGERED.</td>
                  </tr>
                  <tr>
                      <td>75</td>
                      <td>ACTION_ADD_AURA</td>
                      <td>Spell id</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Ajoute l'aura donnée sur la cible.</td>
                  </tr>
                  <tr>
                      <td>76</td>
                      <td>ACTION_OVERRIDE_SCRIPT_BASE_OBJECT</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Ecrase le script actuel de la creature/gameobject à un nouveau utilisant le type de cible. Si plus d'une cible spécifiée, la première sur la liste sera utilisée.</td>
                  </tr>
                  <tr>
                      <td>77</td>
                      <td>ACTION_RESET_SCRIPT_BASE_OBJECT</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Reset le script à son état original. Utile uniquement si ACTION_OVERRIDE_SCRIPT_BASE_OBJECT a été appelé.</td>
                  </tr>
                  <tr>
                      <td>78</td>
                      <td>ACTION_CALL_SCRIPT_RESET</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Appelle SMART_EVENT_RESET.</td>
                  </tr>
                  <tr>
                      <td>79</td>
                      <td>ACTION_SET_RANGED_MOVEMENT</td>
                      <td>Attack distance</td>
                      <td>Attack angle</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Indique la distance d'attaque et l'angle avec lequel la creature va chasser sa cible. La distance donnée désigne la distance minimale entre la creature et le joueur.</td>
                  </tr>
                  <tr>
                      <td>80</td>
                      <td>ACTION_CALL_TIMED_ACTIONLIST</td>
                      <td>Script entry</td>
                      <td>Timer type (0/1/2)</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>Appelle le script avec l'entry donnée.</td>
                  </tr>
                  <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                  </tr>
                  <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                  </tr>
                  <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                  </tr>
                  <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                  </tr>
                  <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                  </tr>
                  <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                  </tr>
                  <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                  </tr>
                  <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                  </tr>
                  <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                  </tr>
                  <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                  </tr>
                  <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                  </tr>
                  <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                  </tr>
                  <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                  </tr>
                  <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                  </tr>
                  <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                  </tr>
                  <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                  </tr>
                  <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                  </tr>
                  <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                  </tr>
                  <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                  </tr>
                  <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                  </tr>
                  <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                  </tr>
                  <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                  </tr>
                  <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
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
