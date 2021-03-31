<?php

use Latte\Runtime as LR;

/** source: C:\www\aps-react-slim\app\Meta/../templates/slice.latte */
final class Template83f47ab0f4 extends Latte\Runtime\Template
{

	public function main(): array
	{
		extract($this->params);
		echo 'import { createSlice } from \'@reduxjs/toolkit\';
import { useSelector } from \'react-redux\';
import axios from \'axios\';
import moment from \'moment\';

export const ';
		echo LR\Filters::escapeHtmlText($name) /* line 6 */;
		echo 'Slice = createSlice({
  name: \'';
		echo LR\Filters::escapeHtmlText($name) /* line 7 */;
		echo '\',
  initialState: ';
		echo LR\Filters::escapeHtmlText(json_encode($initialState, JSON_PRETTY_PRINT)) /* line 8 */;
		echo ',
  reducers: {
';
		$iterations = 0;
		foreach ($reducers as $reducer => $lines) /* line 10 */ {
			echo '    ';
			echo LR\Filters::escapeHtmlText($reducer) /* line 11 */;
			echo ': (state, action) => {
';
			$iterations = 0;
			foreach ($lines as $line) /* line 12 */ {
				echo '      ';
				echo ($this->filters->replace)($line, '*.', 'state.') /* line 13 */;
				echo "\n";
				$iterations++;
			}
			echo '    },
';
			$iterations++;
		}
		echo '  },
});

export const {
';
		$iterations = 0;
		foreach ($reducers as $reducer => $lines) /* line 21 */ {
			echo '  ';
			echo LR\Filters::escapeHtmlText($reducer) /* line 22 */;
			echo ',
';
			$iterations++;
		}
		echo '} = ';
		echo LR\Filters::escapeHtmlText($name) /* line 24 */;
		echo 'Slice.actions;

';
		$iterations = 0;
		foreach ($ajax as $title => $request) /* line 26 */ {
			echo 'export const ';
			echo LR\Filters::escapeHtmlText($title) /* line 27 */;
			echo ' = param => dispatch => {
    dispatch(';
			echo LR\Filters::escapeHtmlText($request->before) /* line 28 */;
			echo '())
    axios.';
			echo LR\Filters::escapeHtmlText($request->method) /* line 29 */;
			echo '(\'';
			echo LR\Filters::escapeHtmlText($request->url) /* line 29 */;
			echo '\', ';
			if (in_array($request->method, ['post', 'put'])) /* line 29 */ {
				echo 'param, ';
			}
			echo $request->headers /* line 29 */;
			echo ')
      .then(res => {
        dispatch(';
			echo LR\Filters::escapeHtmlText($request->success) /* line 31 */;
			echo '(res.data))
        dispatch(';
			echo LR\Filters::escapeHtmlText($request->after) /* line 32 */;
			echo '())
      })
      .catch(err => {
        dispatch(';
			echo LR\Filters::escapeHtmlText($request->error) /* line 35 */;
			echo '(err))
        dispatch(';
			echo LR\Filters::escapeHtmlText($request->after) /* line 36 */;
			echo '())
      })
};

';
			$iterations++;
		}
		echo "\n";
		$iterations = 0;
		foreach ($selectors as $selector => $expression) /* line 42 */ {
			echo 'export const select';
			echo LR\Filters::escapeHtmlText(($this->filters->firstupper)($selector)) /* line 43 */;
			echo ' = state => ';
			echo ($this->filters->replace)($expression, '*.', 'state.app.') /* line 43 */;
			echo ';
';
			$iterations++;
		}
		echo '
export default ';
		echo LR\Filters::escapeHtmlText($name) /* line 46 */;
		echo 'Slice.reducer;
';
		return get_defined_vars();
	}


	public function prepare(): void
	{
		extract($this->params);
		if (!$this->getReferringTemplate() || $this->getReferenceType() === "extends") {
			foreach (array_intersect_key(['line' => '12', 'reducer' => '10, 21', 'lines' => '10, 21', 'title' => '26', 'request' => '26', 'selector' => '42', 'expression' => '42'], $this->params) as $ʟ_v => $ʟ_l) {
				trigger_error("Variable \$$ʟ_v overwritten in foreach on line $ʟ_l");
			}
		}
		
	}

}
