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
		return $str . $this->generic_value("durationIndex", "", "getDuration");
	}
	
	function casting_time()
	{
		$str = "Cast time: ";
		return $str . $this->generic_value("castingTimeIndex", "", "getCastingTime");
	}
	
	function range()
	{
		$str = "Range: ";
		return $str . $this->generic_value("rangeIndex", "", "getRange");
	}
	
	function procFlags()
	{
		$str = "ProcFlags: ";
		return $str . $this->generic_value("procFlags", "", 'View::getHexPrint');
	}
	
	function procFlags_spell_proc()
	{
		if($this->_procInfo)
			return 'Has spell_proc entry (' . $this->_procInfo->SpellId. ')';
		else
			return '(No spell_proc entry)';
	}
	
	function spellFamily()
	{
		$str = 'SpellFamilyName: ' . $this->generic_value("spellFamilyName", "", "getFamilyName");
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
		if(!$baseValue && !$overrideValue)
			return '';
		
		$baseValuePrint = $value_transform_func ? call_user_func_array($value_transform_func, array($baseValue)) : $baseValue;
		$overrideValuePrint = $value_transform_func ? call_user_func_array($value_transform_func, array($overrideValue)) : $overrideValue;
		
		$str = '';
		if($name)
			$str .= $name.': ';
		if($overrideValue != 0 && $baseValue != $overrideValue)
			$str .= '<span class="overriden" title="'.$baseValuePrint.'">'.$overrideValuePrint.'</span>';
		else
			$str .= $baseValuePrint;
		
		return $str;
	}
	
	function generic_value($fieldName, $name, $value_transform_func = null)
	{
		$baseValue = $this->_baseSpellInfo->$fieldName;
		if($this->_overrideSpellInfo)
			$overrideValue = $this->_overrideSpellInfo->$fieldName;
		else
			$overrideValue = null;
		return $this->_generic_value($baseValue, $overrideValue, $name, $value_transform_func);
	}
	
	function generic_value_i($fieldName, $i, $name, $value_transform_func = null)
	{
		$baseValue = $this->_baseSpellInfo->$fieldName[$i];
		if($this->_overrideSpellInfo)
			$overrideValue = $this->_overrideSpellInfo->$fieldName[$i];
		else
			$overrideValue = null;
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
		return $this->generic_value_i("effectItemType", $i, "Item type");
	}
	
	function effectMiscValue($i)
	{
		return $this->generic_value_i("effectMiscValue", $i, "Misc Value");
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