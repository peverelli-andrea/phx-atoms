<?php

namespace Phx\Atom\Paragraph;

use Phx\Core\Component;
use Phx\Core\Render;

final class Paragraph extends Component
{
	final private function __construct() {}

	final public static function getName(): string
	{ return "atom/paragraph"; }

	final public static function render(ParagraphProps $props): Render
	{
		$content = $props->content;

		$html = <<<HTML
		<p>{$content}</p>
		HTML;

		$render = new Render(html: $html);

		return $render;
	}
}
