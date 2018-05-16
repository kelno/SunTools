<?php

$ProcFlags = array(
	0x00000000 => "PROC_FLAG_NONE", 

	0x00000001 => "PROC_FLAG_KILLED",     // 00 Killed by agressor - not sure about this flag
	0x00000002 => "PROC_FLAG_KILL",     // 01 Kill target (in most cases need XP/Honor reward)

	0x00000004 => "PROC_FLAG_DONE_MELEE_AUTO_ATTACK",     // 02 Done melee auto attack
	0x00000008 => "PROC_FLAG_TAKEN_MELEE_AUTO_ATTACK",     // 03 Taken melee auto attack

	0x00000010 => "PROC_FLAG_DONE_SPELL_MELEE_DMG_CLASS",     // 04 Done attack by Spell that has dmg class melee
	0x00000020 => "PROC_FLAG_TAKEN_SPELL_MELEE_DMG_CLASS",     // 05 Taken attack by Spell that has dmg class melee

	0x00000040 => "PROC_FLAG_DONE_RANGED_AUTO_ATTACK",     // 06 Done ranged auto attack
	0x00000080 => "PROC_FLAG_TAKEN_RANGED_AUTO_ATTACK",     // 07 Taken ranged auto attack

	0x00000100 => "PROC_FLAG_DONE_SPELL_RANGED_DMG_CLASS",     // 08 Done attack by Spell that has dmg class ranged
	0x00000200 => "PROC_FLAG_TAKEN_SPELL_RANGED_DMG_CLASS",     // 09 Taken attack by Spell that has dmg class ranged

	0x00000400 => "PROC_FLAG_DONE_SPELL_NONE_DMG_CLASS_POS",     // 10 Done positive spell that has dmg class none
	0x00000800 => "PROC_FLAG_TAKEN_SPELL_NONE_DMG_CLASS_POS",     // 11 Taken positive spell that has dmg class none

	0x00001000 => "PROC_FLAG_DONE_SPELL_NONE_DMG_CLASS_NEG",     // 12 Done negative spell that has dmg class none
	0x00002000 => "PROC_FLAG_TAKEN_SPELL_NONE_DMG_CLASS_NEG",     // 13 Taken negative spell that has dmg class none

	0x00004000 => "PROC_FLAG_DONE_SPELL_MAGIC_DMG_CLASS_POS",     // 14 Done positive spell that has dmg class magic
	0x00008000 => "PROC_FLAG_TAKEN_SPELL_MAGIC_DMG_CLASS_POS",     // 15 Taken positive spell that has dmg class magic

	0x00010000 => "PROC_FLAG_DONE_SPELL_MAGIC_DMG_CLASS_NEG",     // 16 Done negative spell that has dmg class magic
	0x00020000 => "PROC_FLAG_TAKEN_SPELL_MAGIC_DMG_CLASS_NEG",     // 17 Taken negative spell that has dmg class magic

	0x00040000 => "PROC_FLAG_DONE_PERIODIC",     // 18 Successful do periodic (damage / healing)
	0x00080000 => "PROC_FLAG_TAKEN_PERIODIC",     // 19 Taken spell periodic (damage / healing)

	0x00100000 => "PROC_FLAG_TAKEN_DAMAGE",     // 20 Taken any damage
	0x00200000 => "PROC_FLAG_DONE_TRAP_ACTIVATION",     // 21 On trap activation (possibly needs name change to ON_GAMEOBJECT_CAST or USE)

	0x00400000 => "PROC_FLAG_DONE_MAINHAND_ATTACK",     // 22 Done main-hand melee attacks (spell and autoattack)
	0x00800000 => "PROC_FLAG_DONE_OFFHAND_ATTACK",     // 23 Done off-hand melee attacks (spell and autoattack)

	0x01000000 => "PROC_FLAG_DEATH",     // 24 Died in any way
);

$ProcFlagsSpellType = array(
	 0x0000000 => "PROC_SPELL_TYPE_NONE",
     0x0000001 => "PROC_SPELL_TYPE_DAMAGE", // damage type of spell
     0x0000002 => "PROC_SPELL_TYPE_HEAL", // heal type of spell
     0x0000004 => "PROC_SPELL_TYPE_NO_DMG_HEAL", // other spells
);

$ProcFlagsSpellPhase = array(
	0x0000000 => "PROC_SPELL_PHASE_NONE",    
	0x0000001 => "PROC_SPELL_PHASE_CAST",    
	0x0000002 => "PROC_SPELL_PHASE_HIT",     
	0x0000004 => "PROC_SPELL_PHASE_FINISH",  
);

$ProcAttributes = array(
	0x0000000 => "NONE",
	0x0000001 => "PROC_ATTR_REQ_EXP_OR_HONOR", // requires proc target to give exp or honor for aura proc
    0x0000002 => "PROC_ATTR_TRIGGERED_CAN_PROC", // aura can proc even with triggered spells
    0x0000004 => "PROC_ATTR_REQ_MANA_COST", // requires triggering spell to have a mana cost for aura proc
    0x0000008 => "PROC_ATTR_REQ_SPELLMOD", // requires triggering spell to be affected by proccing aura to drop charges
    0x0000010 => "PROC_ATTR_DISABLE_EFF_0", // explicitly disables aura proc from effects, USE ONLY IF 100% SURE AURA SHOULDN'T PROC
    0x0000020 => "PROC_ATTR_DISABLE_EFF_1", /// used to avoid a console error if the spell has invalid trigger spell and handled elsewhere
    0x0000040 => "PROC_ATTR_DISABLE_EFF_2", /// or handling not needed
    0x0000080 => "PROC_ATTR_REDUCE_PROC_60", // aura should have a reduced chance to proc if level of proc Actor > 60
);

$ProcFlagsHit = array(
    0x0000000 => "PROC_HIT_NONE", // no value - PROC_HIT_NORMAL | PROC_HIT_CRITICAL for TAKEN proc type, PROC_HIT_NORMAL | PROC_HIT_CRITICAL | PROC_HIT_ABSORB for DONE
    0x0000001 => "PROC_HIT_NORMAL", // non-critical hits
    0x0000002 => "PROC_HIT_CRITICAL",
    0x0000004 => "PROC_HIT_MISS",
    0x0000008 => "PROC_HIT_FULL_RESIST",
    0x0000010 => "PROC_HIT_DODGE",
    0x0000020 => "PROC_HIT_PARRY",
    0x0000040 => "PROC_HIT_BLOCK", // partial or full block
    0x0000080 => "PROC_HIT_EVADE",
    0x0000100 => "PROC_HIT_IMMUNE",
    0x0000200 => "PROC_HIT_DEFLECT",
    0x0000400 => "PROC_HIT_ABSORB", // partial or full absorb
    0x0000800 => "PROC_HIT_REFLECT",
    0x0001000 => "PROC_HIT_INTERRUPT",
    0x0002000 => "PROC_HIT_FULL_BLOCK",
);