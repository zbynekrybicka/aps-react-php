<?php

use Latte\Runtime as LR;

/** source: C:\www\aps-react-slim\app\Meta/../templates/component.latte */
final class Template54125b92b9 extends Latte\Runtime\Template
{

	public function main(): array
	{
		extract($this->params);
		echo 'import React from \'react\';
import { useSelector, useDispatch } from \'react-redux\';
import {
';
		$iterations = 0;
		foreach ($slices as $slice) /* line 4 */ {
			echo '  ';
			echo LR\Filters::escapeHtmlText($slice) /* line 5 */;
			echo ',
';
			$iterations++;
		}
		echo '} from \'../appSlice\';
';
		$iterations = 0;
		foreach ($subComponents as $subComponent) /* line 8 */ {
			echo 'import ';
			echo LR\Filters::escapeHtmlText(($this->filters->firstupper)($subComponent)) /* line 9 */;
			echo ' from \'./';
			echo LR\Filters::escapeHtmlText(($this->filters->firstupper)($subComponent)) /* line 9 */;
			echo '\';
';
			$iterations++;
		}
		echo '
export default function ';
		echo LR\Filters::escapeHtmlText(($this->filters->firstupper)($title)) /* line 12 */;
		echo '(props) {
  const dispatch = useDispatch();
';
		$iterations = 0;
		foreach ($selectors as $selector) /* line 14 */ {
			echo '  const ';
			echo LR\Filters::escapeHtmlText($selector) /* line 15 */;
			echo ' = useSelector(select';
			echo LR\Filters::escapeHtmlText(($this->filters->firstupper)($selector)) /* line 15 */;
			echo ');
';
			$iterations++;
		}
		if ($initAjax) /* line 17 */ {
			echo '    dispatch(';
			echo LR\Filters::escapeHtmlText($initAjax) /* line 18 */;
			echo ');
';
		}
		echo '
  return <div className={\'';
		echo LR\Filters::escapeHtmlAttrUnquoted(($this->filters->firstupper)($title)) /* line 21 */;
		echo '\'}>
';
		$iterations = 0;
		foreach ($content as $component) /* line 22 */ {
			echo '      ';
			echo $component /* line 23 */;
			echo "\n";
			$iterations++;
		}
		echo '    </div>;
}
';
		return get_defined_vars();
	}


	public function prepare(): void
	{
		extract($this->params);
		if (!$this->getReferringTemplate() || $this->getReferenceType() === "extends") {
			foreach (array_intersect_key(['slice' => '4', 'subComponent' => '8', 'selector' => '14', 'component' => '22'], $this->params) as $ʟ_v => $ʟ_l) {
				trigger_error("Variable \$$ʟ_v overwritten in foreach on line $ʟ_l");
			}
		}
		
	}

}
