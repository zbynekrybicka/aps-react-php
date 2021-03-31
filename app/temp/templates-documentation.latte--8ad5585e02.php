<?php

use Latte\Runtime as LR;

/** source: C:\www\aps-react-slim\app\Meta/../templates/documentation.latte */
final class Template8ad5585e02 extends Latte\Runtime\Template
{
	protected const BLOCKS = [
		['componentList' => 'blockComponentList'],
	];


	public function main(): array
	{
		extract($this->params);
		echo '<div style="display: table-cell">
';
		$iterations = 0;
		foreach ($tests as $identifier => $steps) /* line 2 */ {
			echo '        <b>';
			echo LR\Filters::escapeHtmlText($identifier) /* line 3 */;
			echo '</b>
        <ul>
';
			$iterations = 0;
			foreach ($steps as $step) /* line 5 */ {
				echo '            <li><b>';
				echo LR\Filters::escapeHtmlText(($this->filters->upper)($step->step)) /* line 5 */;
				echo '</b> &ndash; ';
				echo LR\Filters::escapeHtmlText($step->element) /* line 5 */;
				echo ' <i>(';
				echo LR\Filters::escapeHtmlText($step->param ?? '') /* line 5 */;
				echo ')</i></li>
';
				$iterations++;
			}
			echo '        </ul>
';
			$iterations++;
		}
		echo '</div>
<div style="display: table-cell">
';
		$noNext = false /* line 10 */;
		echo '<ul>
    <li>App
';
		if ($this->getParentName()) {
			return get_defined_vars();
		}
		$this->renderBlock('componentList', get_defined_vars()) /* line 13 */;
		echo '
    </li>
</ul>
</div>

<pre>';
		echo LR\Filters::escapeHtmlText(json_encode($state, JSON_PRETTY_PRINT)) /* line 30 */;
		echo '</pre>';
		return get_defined_vars();
	}


	public function prepare(): void
	{
		extract($this->params);
		if (!$this->getReferringTemplate() || $this->getReferenceType() === "extends") {
			foreach (array_intersect_key(['step' => '5', 'identifier' => '2', 'steps' => '2', 'component' => '15'], $this->params) as $ʟ_v => $ʟ_l) {
				trigger_error("Variable \$$ʟ_v overwritten in foreach on line $ʟ_l");
			}
		}
		
	}


	/** {block componentList} on line 13 */
	public function blockComponentList(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		echo '            <ul>
';
		$iterations = 0;
		foreach ($iterator = $ʟ_it = new LR\CachingIterator($components, $ʟ_it ?? null) as $component) /* line 15 */ {
			if ($component->parent === $parentComponent && !$noNext) /* line 16 */ {
				if ($iterator->nextValue->title === $component->title) /* line 17 */ {
					$noNext = true /* line 17 */;
				}
				echo '
                <li>';
				echo LR\Filters::escapeHtmlText(($this->filters->firstupper)($component->title)) /* line 18 */;
				echo ' ';
				if ($component->condition) /* line 18 */ {
					echo '(';
					echo LR\Filters::escapeHtmlText($component->condition) /* line 18 */;
					echo ')';
				}
				echo "\n";
				$this->renderBlock($ʟ_nm = 'componentList', ['parentComponent' => $component->title] + get_defined_vars(), 'html') /* line 19 */;
				echo '                </li>
';
			}
			else /* line 21 */ {
				$noNext = false /* line 21 */;
				echo "\n";
			}
			$iterations++;
		}
		$iterator = $ʟ_it = $ʟ_it->getParent();
		echo '            </ul>
';
	}

}
