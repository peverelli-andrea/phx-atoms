<?php

namespace Phx\Atom\Label;

use Phx\Core\Component;
use Phx\Core\Render;
use Phx\Core\TypographyRole;

final class Label extends Component
{
	final private function __construct() {}

	final public static function getName(): string
	{ return "atom/label"; }

	final public static function render(LabelProps $props): Render
	{
		$content = $props->content;
		$sub_role = $props->sub_role;

		$typography_css = self::getTypographyCss(
			role: TypographyRole::LABEL,
			sub_role: $sub_role,
		);
		$typography_classes = $typography_css->classes;
		$class_keys = array_keys($typography_classes);

		$common_props = $props->common;
		$attributes = self::makeAttributes(
			props: $common_props,
			classes: $class_keys,
		);

		$html = <<<HTML
		<label$attributes>$content</label>
		HTML;

		$typos = $typography_css->fonts;
		$classes = [...$typography_classes];

		$render = new Render(
			html: $html,
			typos: $typos,
			classes: $classes,
		);

		return $render;
	}
}
