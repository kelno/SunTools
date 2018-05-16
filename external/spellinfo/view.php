<?php

class View
{
	function __construct($baseSpellInfo, $overrideSpellInfo, $rankInfo, $procInfo)
	{
		$this->_baseSpellInfo = $baseSpellInfo;
		$this->_overrideSpellInfo = $overrideSpellInfo;
		$this->_rankInfo = $rankInfo;
		$this->_procInfo = $procInfo;
	}
	
	function duration()
	{
		$str = "Duration: ";
		return $str . $this->generic_value("durationIndex", "", 'getDuration');
	}
	
	function casting_time()
	{
		$str = "Cast time: ";
		return $str . $this->generic_value("castingTimeIndex", "", 'getCastingTime');
	}
	
	function range()
	{
		$str = "Range: ";
		return $str . $this->generic_value("rangeIndex", "", 'getRange');
	}
	
	function procFlags()
	{
		global $ProcFlags;
		
		$str = "ProcFlags: ";
		$str .= $this->generic_value("procFlags", "", 'View::getHexPrint');
		$baseVal = null;
		$overrideVal = null;
		$this->getSpellField("procFlags", $baseVal, $overrideVal);
		$useVal = $overrideVal ? $overrideVal : $baseVal;
		if($useVal)
			$str .= $this->getFlagsTable($useVal, $ProcFlags);
		
		return $str;
	}
	
	function procEntry()
	{
		if(!$this->_procInfo)
			return '<span class="novalue">(No spell_proc entry)</span>';
		
		$str = '<table border=1 style="width:100%">';
		
		$str .= '<caption>spell_proc entry summary (' . $this->_procInfo->SpellId. ')</caption>';
		$str .= "<tr><th>SchoolMask</th><th>SpellFamilyName</th><th>SpellFamilyMask</th><th>ProcFlags</th><th>SpellTypeMask</th><th>SpellPhaseMask</th><th>HitMask</th><th>AttributesMask</th><th>ProcsPerMinute</th><th>Chance</th><th>Cooldown</th><th>Charges</th></tr>";
		$str .= '<tr>';
		$str .= '<td>' . $this->getHexPrint($this->_procInfo->SchoolMask) . '</td>';
		$str .= '<td>' . getFamilyName($this->_procInfo->SpellFamilyName) . '</td>';
		$str .= '<td>' . $this->getHexPrint($this->_procInfo->SpellFamilyMask) . '</td>';
		$str .= '<td>' . $this->getHexPrint($this->_procInfo->ProcFlags) . '</td>';
		$str .= '<td>' . $this->getHexPrint($this->_procInfo->SpellTypeMask) . '</td>';
		$str .= '<td>' . $this->getHexPrint($this->_procInfo->SpellPhaseMask) . '</td>';
		$str .= '<td>' . $this->getHexPrint($this->_procInfo->HitMask) . '</td>';
		$str .= '<td>' . $this->getHexPrint($this->_procInfo->AttributesMask) . '</td>';
		$str .= '<td>' . $this->_procInfo->ProcsPerMinute . '</td>';
		$str .= '<td>' . $this->_procInfo->Chance . '</td>';
		$str .= '<td>' . $this->_procInfo->Cooldown . '</td>';
		$str .= '<td>' . $this->_procInfo->Charges . '</td>';
		$str .= '</tr>';
		$str .= "</table>";
		$str .= $this->SpellProcFlags();
		$str .= $this->SpellProcTypeMask();
		$str .= $this->SpellProcPhaseMask();
		$str .= $this->SpellProcHitMask();
		$str .= $this->SpellProcAttributesMask();
		return $str;
	}
	
	function getFlagsTable($flags, $enum, $caption = null)
	{
		$str = '<table style="width:100%">';
		if($caption)
			$str .= '<caption>'.$caption.'</caption>';
		
		if(!$flags)
			$str .= '<tr><td>'. $enum[0] .'</td></tr>';
		else
			foreach ($enum as $key => $value)
			{
				if($flags & $key)
				{
					$str .= '<tr>';
					$str .= '<td>' . $this->getHexPrint($key) . '</td><td>' . $value . '</td>';
					$str .= '</tr>';
				}
			}
		
		$str .= "</table>";
		return $str;
	}
	
	function SpellProcFlags()
	{
		global $ProcFlags;
		return $this->getFlagsTable($this->_procInfo->ProcFlags, $ProcFlags, "ProcFlags");
	}
	
	function SpellProcTypeMask()
	{
		global $ProcFlagsSpellType;
		return $this->getFlagsTable($this->_procInfo->SpellTypeMask, $ProcFlagsSpellType, "SpellType");
	}
	
	function SpellProcPhaseMask()
	{
		global $ProcFlagsSpellPhase;
		return $this->getFlagsTable($this->_procInfo->SpellPhaseMask, $ProcFlagsSpellPhase, "SpellPhase");
	}
	
	function SpellProcHitMask()
	{
		global $ProcFlagsHit;
		return $this->getFlagsTable($this->_procInfo->HitMask, $ProcFlagsHit, "ProcFlagsHit");
	}
	
	function SpellProcAttributesMask()
	{
		global $ProcAttributes;
		return $this->getFlagsTable($this->_procInfo->AttributesMask, $ProcAttributes, "Attributes");
	}
	
	function spellFamily()
	{
		$str = 'SpellFamilyName: ' . $this->generic_value("spellFamilyName", "", 'getFamilyName');
		$str .= ' | SpellFamilyFlags: ' . $this->generic_value("spellFamilyFlags", "", 'View::getHexPrint');
		
		return $str;
	}
	
	function get_attribute_table()
	{
		$str = '';
		for ($a = 0; $a <= 6; $a++)
		{
			$overriden = false;
			$baseAttribute = $this->_baseSpellInfo->spellAttributes[$a];
			$attribute = $this->get_attribute($a, $overriden);
			
			if($overriden)
				$str .= "<b>" . getAttributeCategoryName($a) . ' = <span class="overriden" title="0x'.dechex($baseAttribute).'">0x' . dechex($attribute) . "</span></b>";
			else
				$str .= "<b>" . getAttributeCategoryName($a) . ' = 0x' . dechex($attribute) . "</b>";
			
			$str .= '<table>';
			for ($i = 0; $i < 32; $i += 1)
			{
				if ($attribute & pow(2, $i))
					$str .= $this->attribute_row($a, $i);
			}
			$str .= '</table>';
		}
		return $str;
	}
	
	function get_attribute($i, &$overriden)
	{
		if($this->_overrideSpellInfo && $this->_overrideSpellInfo->spellAttributes[$i])
		{
			$overriden = true;
			return $this->_overrideSpellInfo->spellAttributes[$i];
		} else {
			$overriden = false;
			return $this->_baseSpellInfo->spellAttributes[$i];
		}
	}
	
	function attribute_row($a, $j)
	{
		return '<tr>' .
			   '<td width="120">0x' .dechex(pow(2, $j)). '</td>' .
		       '<td>'. getAttributeName($a, $j). '</td>' .
		       '</tr>';
	}
	
	function get_whole_effect($i)
	{
		$str = '';
		$overriden = false;
		$effect = $this->get_effect_index($i, $overriden);
		$baseEffect = $this->_baseSpellInfo->effects[$i];
		if($effect)
		{
			$str .= '<div>';
			if($overriden)
				$str .= $effect . ' - <span class="overriden" title="'.$baseEffect.' - '. getSpellEffectName($baseEffect) .'">' . getSpellEffectName($effect) . "</span>";
			else
				$str .= $effect . ' - ' . getSpellEffectName($effect);
			$str .= '</div>';
			$str .= '<div>' . $this->effectBasePoints($i) . '</div>';
			$str .= '<div>' . $this->effectApplyAuraName($i). '</div>';
			$str .= '<div>' . $this->effectAmplitude($i). '</div>';
			$str .= '<div>' . $this->effectItemType($i). '</div>';
			$str .= '<div>' . $this->effectMiscValue($i). '</div>';
			$str .= '<div>' . $this->effectTriggerSpell($i). '</div>';
			$str .= '<div>' . $this->effectImplicitTargetA($i). '</div>';
			$str .= '<div>' . $this->effectImplicitTargetB($i). '</div>';
			$str .= '<div>' . $this->effectRadiusIndex($i). '</div>';
		}
		return $str;
	}
	
	function get_effect_index($i, &$overriden)
	{
		if($this->_overrideSpellInfo && $this->_overrideSpellInfo->effects[$i])
		{
			$overriden = true;
			return $this->_overrideSpellInfo->effects[$i];
		} else {
			$overriden = false;
			return $this->_baseSpellInfo->effects[$i];
		}
	}
	
	function _generic_value($baseValue, $overrideValue, $name, $value_transform_func = null)
	{
		$class = '';
		$title = '';
		$printValue = '';
		if(!$baseValue && !$overrideValue)
			$class = 'novalue';
		
		$baseValuePrint = $value_transform_func ? call_user_func_array($value_transform_func, array($baseValue)) : $baseValue;
		$overrideValuePrint = $value_transform_func ? call_user_func_array($value_transform_func, array($overrideValue)) : $overrideValue;
		
		$str = '';
		if($name)
			$str .= $name.': ';
		if($overrideValue != 0 && $baseValue != $overrideValue)
		{
			$class .= ' overriden';
			$title = $baseValuePrint;
			$printValue = $overrideValuePrint;
		} else
			$printValue = $baseValuePrint;
		
		$str .= "<span class=\"$class\" title=\"".$baseValuePrint.'">'.$printValue.'</span>';
		
		return $str;
	}
	
	function generic_value($fieldName, $name, $value_transform_func = null)
	{
		$baseValue = null;
		$overrideValue = null;
		$this->getSpellField($fieldName, $baseValue, $overrideValue);
		return $this->_generic_value($baseValue, $overrideValue, $name, $value_transform_func);
	}
	
	function generic_value_i($fieldName, $i, $name, $value_transform_func = null)
	{
		$baseValue = null;
		$overrideValue = null;
		$this->getSpellFieldI($fieldName, $i, $baseValue, $overrideValue);
		return $this->_generic_value($baseValue, $overrideValue, $name, $value_transform_func);
	}
	
	function effectBasePoints($i)
	{
		return $this->generic_value_i("effectBasePoints", $i, "Base points");
	}
	
	function effectApplyAuraName($i)
	{
		return $this->generic_value_i("applyAuraNames", $i, "Aura type", "getAura");
	}
	
	function effectAmplitude($i)
	{
		return $this->generic_value_i("effectAmplitude", $i, "Amplitude");
	}
	
	function effectItemType($i)
	{
		return $this->generic_value_i("effectItemType", $i, "Item type", "View::toHexString");
	}
	
	function effectMiscValueTransform($auraName, $baseValue)
	{
		switch($auraName)
		{
		case 107: // SPELL_AURA_ADD_FLAT_MODIFIER
		case 108: // SPELL_AURA_ADD_PCT_MODIFIER
			return getSpellModOp($baseValue);
			break;
		case 18: // SPELL_AURA_MOD_INVISIBILITY
		case 19: // SPELL_AURA_MOD_INVISIBILITY_DETECTION
			//TODO
		case 36: // SPELL_AURA_MOD_SHAPESHIFT
			//TODO
		default:
			return $baseValue;
		}
	}
	
	function effectMiscValue($i)
	{
		$baseValue = null;
		$overrideValue = null;
		$this->getSpellFieldI("effectMiscValue", $i, $baseValue, $overrideValue);
		
		$baseAuraName = null;
		$overrideAuraName = null;
		$this->getSpellFieldI("applyAuraNames", $i, $baseAuraName, $overrideAuraName);
		
		$baseShownMisc = $this->effectMiscValueTransform($baseAuraName, $baseValue);
		$overrideShownMisc = $this->effectMiscValueTransform($overrideAuraName, $overrideValue);
		
		return $this->_generic_value($baseShownMisc, $overrideShownMisc, "Misc value");
	}
	
	function effectTriggerSpell($i)
	{
		return $this->generic_value_i("effectTriggerSpell", $i, "Trigger Spell");
	}
	
	function effectImplicitTargetA($i)
	{
		return $this->generic_value_i("effectImplicitTargetA", $i, "ImplicitTargetA", "getTarget");
	}
	
	function effectImplicitTargetB($i)
	{
		return $this->generic_value_i("effectImplicitTargetB", $i, "ImplicitTargetB", "getTarget");
	}
	
	function effectRadiusIndex($i)
	{
		return $this->generic_value_i("effectRadiusIndex", $i, "Radius", "getRadius");
	}
	
	static function toHexString($integer)
	{
		return '0x' . dechex($integer);
	}
	
	function getSpellField($fieldName, &$baseVal, &$override_val)
	{
		$baseVal = $this->_baseSpellInfo->$fieldName;
		$override_val = null;
		if($this->_overrideSpellInfo)
			$override_val = $this->_overrideSpellInfo->$fieldName;
	}
	
	function getSpellFieldI($fieldName, $i, &$baseVal, &$override_val)
	{
		$baseVal = $this->_baseSpellInfo->$fieldName[$i];
		$override_val = null;
		if($this->_overrideSpellInfo)
			$override_val = $this->_overrideSpellInfo->$fieldName[$i];
	}
	
	function rank()
	{
		if($this->_rankInfo)
		{
			$uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
			$url = 'http://' . $_SERVER['HTTP_HOST'] . $uri_parts[0];
			return 'Rank: ' . $this->_rankInfo->rank ." (Chain <a href=\"$url?id=". $this->_rankInfo->first_spell_id . "\">" . $this->_rankInfo->first_spell_id . '</a>)';
		} else
			return '(No rank)';
	}
	
	function overriden()
	{
		if($this->_overrideSpellInfo)
			return '<span class="overriden">Has overriden data (mouseover to get original values)</span>';
		else
			return '(no overriden data)';
	}
	
	function getHexPrint($value)
	{
		return '0x'.dechex($value);
	}
	
	public $_baseSpellInfo;
	public $_overrideSpellInfo;
	public $_rankInfo;
	public $_procInfo;
};