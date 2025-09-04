<?php

namespace Phx\Atom\Label;

use Phx\Core\Component;
use Phx\Core\Render;

final class Label extends Component
{
	final private function __construct() {}

	final public static function getName(): string
	{ return "atom/label"; }

	final public static function render(LabelProps $props): Render
	{
		$content = $props->content;

		$html = <<<HTML
		<label>{$content}</label>
		HTML;

		$render = new Render(html: $html);

		return $render;
	}
}
