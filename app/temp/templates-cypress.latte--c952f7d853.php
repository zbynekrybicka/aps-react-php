<?php

use Latte\Runtime as LR;

/** source: C:\www\aps-react-slim\app\Meta/../templates/cypress.latte */
final class Templatec952f7d853 extends Latte\Runtime\Template
{
	protected const BLOCKS = [
		['steps' => 'blockSteps'],
	];


	public function main(): array
	{
		extract($this->params);
		echo 'it(\'';
		echo LR\Filters::escapeHtmlText($identifier) /* line 1 */;
		echo '\', () => {
    cy.visit(\'';
		echo LR\Filters::escapeHtmlText($url) /* line 2 */;
		echo '\');
';
		if ($this->getParentName()) {
			return get_defined_vars();
		}
		$this->renderBlock('steps', get_defined_vars()) /* line 3 */;
		echo '
});';
		return get_defined_vars();
	}


	public function prepare(): void
	{
		extract($this->params);
		if (!$this->getReferringTemplate() || $this->getReferenceType() === "extends") {
			foreach (array_intersect_key(['step' => '7'], $this->params) as $ʟ_v => $ʟ_l) {
				trigger_error("Variable \$$ʟ_v overwritten in foreach on line $ʟ_l");
			}
		}
		
	}


	/** {block steps} on line 3 */
	public function blockSteps(array $ʟ_args): void
	{
		extract($this->params);
		extract($ʟ_args);
		unset($ʟ_args);
		if ($before) /* line 4 */ {
			$this->renderBlock($ʟ_nm = 'steps', ['steps' => $before->getSteps(), 'before' => $before->getBefore()] + get_defined_vars(), 'html') /* line 5 */;
		}
		$iterations = 0;
		foreach ($steps as $step) /* line 7 */ {
			if ($step->step === 'type') /* line 8 */ {
				echo '    cy.get(\'';
				echo LR\Filters::escapeHtmlText($step->element) /* line 9 */;
				echo '\').should(\'have.length\', 1).and(\'be.visible\').type(\'';
				echo LR\Filters::escapeHtmlText($step->param) /* line 9 */;
				echo '\');
';
			}
			elseif ($step->step === 'click') /* line 10 */ {
				echo '    cy.get(\'';
				echo LR\Filters::escapeHtmlText($step->element) /* line 11 */;
				echo '\').should(\'have.length\', 1).and(\'be.visible\').click();
';
			}
			elseif ($step->step === 'check') /* line 12 */ {
				echo '    cy.get(\'';
				echo LR\Filters::escapeHtmlText($step->element) /* line 13 */;
				echo '\').should(\'have.length\', ';
				echo LR\Filters::escapeHtmlText($step->param) /* line 13 */;
				echo ').and(\'be.visible\');
';
			}
			elseif ($step->step === 'checkNot') /* line 14 */ {
				echo '    cy.get(\'';
				echo LR\Filters::escapeHtmlText($step->element) /* line 15 */;
				echo '\').should(\'be.not.visible\');
';
			}
			elseif ($step->step === 'screenshot') /* line 16 */ {
				echo '    cy.screenshot(\'';
				echo LR\Filters::escapeHtmlText(($this->filters->replace)($step->param, '\\', '/')) /* line 17 */;
				echo '\');
';
			}
			$iterations++;
		}
		
	}

}
